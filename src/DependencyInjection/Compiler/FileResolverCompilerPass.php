<?php

declare(strict_types=1);

namespace RZ\InterventionRequestBundle\DependencyInjection\Compiler;

use AM\InterventionRequest\FileResolverInterface;
use AM\InterventionRequest\FlysystemFileResolver;
use AM\InterventionRequest\LocalFileResolver;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class FileResolverCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container): void
    {
        /**
         * If an `intervention_request.storage` flysystem storage has been configured, we use it.
         */
        if ($container->hasDefinition('intervention_request.storage')) {
            $container->setDefinition(
                FileResolverInterface::class,
                (new Definition())
                    ->setClass(FlysystemFileResolver::class)
                    ->setPublic(true)
                    ->setArguments([
                        new Reference('intervention_request.storage'),
                        new Reference('logger'),
                        $container->getParameter('rz_intervention_request.files_path')
                    ])
            );
        } else {
            $container->setDefinition(
                FileResolverInterface::class,
                (new Definition())
                    ->setClass(LocalFileResolver::class)
                    ->setPublic(true)
                    ->setArguments([
                        $container->getParameter('rz_intervention_request.files_path')
                    ])
            );
        }
    }
}
