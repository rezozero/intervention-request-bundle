<?php

declare(strict_types=1);

namespace RZ\InterventionRequestBundle;

use RZ\InterventionRequestBundle\DependencyInjection\Compiler\FileResolverCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class RZInterventionRequestBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new FileResolverCompilerPass());
    }
}
