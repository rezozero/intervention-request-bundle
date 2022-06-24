<?php

declare(strict_types=1);

namespace RZ\InterventionRequestBundle\Controller;

use AM\InterventionRequest\ShortUrlExpander;
use RZ\InterventionRequestBundle\InterventionRequest\InterventionRequest;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class DefaultController
{
    private InterventionRequest $interventionRequest;
    private string $cachePath;

    /**
     * @param InterventionRequest $interventionRequest
     * @param string $cachePath
     */
    public function __construct(InterventionRequest $interventionRequest, string $cachePath)
    {
        $this->interventionRequest = $interventionRequest;
        $this->cachePath = $cachePath;
    }

    /**
     * @param Request $request
     * @param string $queryString
     * @param string $filename
     * @return Response
     */
    public function assetsAction(Request $request, string $queryString, string $filename): Response
    {
        try {
            $expander = new ShortUrlExpander($request);
            $expander->setIgnorePath($this->cachePath);
            $expander->injectParamsToRequest($queryString, $filename);
            $this->interventionRequest->handleRequest($request);
            return $this->interventionRequest->getResponse($request);
        } catch (\ReflectionException $e) {
            $message = '[Configuration] ' . $e->getMessage();
            return new Response(
                $message,
                Response::HTTP_INTERNAL_SERVER_ERROR,
                ['content-type' => 'text/plain']
            );
        } catch (\Exception $e) {
            return new Response(
                $e->getMessage(),
                Response::HTTP_NOT_FOUND,
                ['content-type' => 'text/plain']
            );
        }
    }

    /**
     * @return JsonResponse
     */
    public function clearCacheAction(): JsonResponse
    {
        $fs = new Filesystem();
        $finder = new Finder();
        $cachePath = realpath($this->cachePath);

        if ($cachePath && $fs->exists($cachePath)) {
            $finder->in($cachePath);
            $fs->remove($finder);
            return new JsonResponse([
                'message' => 'Intervention request image cache has been purged.'
            ]);
        }

        throw new BadRequestHttpException('Cache dir does not exists.');
    }
}
