<?php
namespace RZ\InterventionRequestBundle\Controller;

use AM\InterventionRequest\InterventionRequest;
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
     * @param Request $request
     * @param $queryString
     * @param $filename
     * @return Response
     */
    public function assetsAction(Request $request, $queryString, $filename)
    {
        try {
            $expander = new ShortUrlExpander($request);
            $expander->setIgnorePath($this->getParameter('rz_intervention_request.cache_path'));
            $expander->injectParamsToRequest($queryString, $filename);

            /** @var InterventionRequest $intervention */
            $intervention = $this->get('rz_intervention_request');

            //foreach ($this->get('intervention_request_subscribers') as $subscriber) {
            //    $intervention->addSubscriber($subscriber);
            //}

            $intervention->handleRequest($request);
            return $intervention->getResponse($request);
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
        /** @var Kernel $kernel */
        $kernel = $this->get('kernel');
        $cachePath = realpath($kernel->getProjectDir() . '/web' . $this->getParameter('rz_intervention_request.cache_path'));

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
