<?php

declare(strict_types=1);

namespace RZ\InterventionRequestBundle\DependencyInjection;

use Intervention\Image\Interfaces\DriverInterface;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @see http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class RZInterventionRequestExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yml');

        $container->setParameter('rz_intervention_request.driver', $config['driver']);
        $container->setParameter('rz_intervention_request.cache_path', $config['cache_path']);
        $container->setParameter('rz_intervention_request.default_quality', $config['default_quality']);
        $container->setParameter('rz_intervention_request.use_passthrough_cache', $config['use_passthrough_cache']);
        $container->setParameter('rz_intervention_request.max_pixel_size', $config['max_pixel_size']);
        $container->setParameter('rz_intervention_request.files_path', $config['files_path']);
        $container->setParameter('rz_intervention_request.jpegoptim_path', $config['jpegoptim_path']);
        $container->setParameter('rz_intervention_request.pngquant_path', $config['pngquant_path']);

        $driverDefinition = new Definition(DriverInterface::class);
        $driverDefinition->setClass(('imagick' === $config['driver']) ? \Intervention\Image\Drivers\Imagick\Driver::class : \Intervention\Image\Drivers\Gd\Driver::class);
        $container->setDefinition(DriverInterface::class, $driverDefinition);

        $this->loadSubscribers($container, $config);
    }

    protected function loadSubscribers(ContainerBuilder $container, array $config): void
    {
        $subscribers = [];
        if (!\is_iterable($config['subscribers'])) {
            $container->setParameter('rz_intervention_request.subscribers', $subscribers);

            return;
        }
        /**
         * @var array<string, mixed> $subscriberConfig
         */
        foreach ($config['subscribers'] as $subscriberConfig) {
            /**
             * @var class-string|null $class
             */
            $class = $subscriberConfig['class'];
            if (!\is_string($class)) {
                continue;
            }
            $constructArgs = $subscriberConfig['args'];
            if (!\is_array($constructArgs)) {
                $constructArgs = [];
            }
            $refClass = new \ReflectionClass($class);
            if (!$refClass->implementsInterface(EventSubscriberInterface::class)) {
                throw new InvalidConfigurationException($refClass->getName().'must implement '.EventSubscriberInterface::class);
            }
            $subscribers[] = $refClass->newInstanceArgs($constructArgs);
        }
        $container->setParameter('rz_intervention_request.subscribers', $subscribers);
    }
}
