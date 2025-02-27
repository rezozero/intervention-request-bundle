<?php

declare(strict_types=1);

namespace RZ\InterventionRequestBundle\Controller;

use AM\InterventionRequest\ShortUrlExpander;
use RZ\InterventionRequestBundle\InterventionRequest\InterventionRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class DefaultController
{
    public function __construct(
        private InterventionRequest $interventionRequest,
        private string $cachePath,
    ) {
    }

    public function assetsAction(Request $request, string $queryString, string $filename): Response
    {
        try {
            $expander = new ShortUrlExpander($request);
            $expander->setIgnorePath($this->cachePath);
            $expander->injectParamsToRequest($queryString, $filename);
            $this->interventionRequest->handleRequest($request);

            return $this->interventionRequest->getResponse($request);
        } catch (\ReflectionException $e) {
            $message = '[Configuration] '.$e->getMessage();

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
}
