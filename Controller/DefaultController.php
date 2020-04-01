<?php
namespace RZ\InterventionRequestBundle\Controller;

use RZ\InterventionRequestBundle\InterventionRequest\InterventionRequest;
use AM\InterventionRequest\ShortUrlExpander;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Kernel;

class DefaultController extends Controller
{
    /**
     * @var InterventionRequest
     */
    private $interventionRequest;

    /**
     * @var string
     */
    private $cachePath;

    /**
     * DefaultController constructor.
     *
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
     * @param $queryString
     * @param $filename
     * @return Response
     */
    public function assetsAction(Request $request, $queryString, $filename)
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
    public function clearCacheAction()
    {
        $fs = new Filesystem();
        $finder = new Finder();
        $cachePath = realpath($this->cachePath);

        if ($fs->exists($cachePath)) {
            $finder->in($cachePath);
            $fs->remove($finder);
            return new JsonResponse([
                'message' => 'Intervention request image cache has been purged.'
            ]);
        }

        throw new BadRequestHttpException('Cache dir does not exists.');
    }
}
