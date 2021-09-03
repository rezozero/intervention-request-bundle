<?php

namespace RZ\InterventionRequestBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class RZInterventionRequestExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('rz_intervention_request.driver', $config['driver']);
        $container->setParameter('rz_intervention_request.cache_path', $config['cache_path']);
        $container->setParameter('rz_intervention_request.default_quality', $config['default_quality']);
        $container->setParameter('rz_intervention_request.use_passthrough_cache', $config['use_passthrough_cache']);
        $container->setParameter('rz_intervention_request.max_pixel_size', $config['max_pixel_size']);
        $container->setParameter('rz_intervention_request.files_path', $config['files_path']);
        $container->setParameter('rz_intervention_request.jpegoptim_path', $config['jpegoptim_path']);
        $container->setParameter('rz_intervention_request.pngquant_path', $config['pngquant_path']);

        $this->loadSubscribers($container, $config);
    }

    protected function loadSubscribers(ContainerBuilder $container, array $config)
    {
        $subscribers = [];
        foreach ($config['subscribers'] as $subscriberConfig) {
            $class = $subscriberConfig['class'];
            $constructArgs = $subscriberConfig['args'];
            $refClass = new \ReflectionClass($class);
            if (!$refClass->implementsInterface(EventSubscriberInterface::class)) {
                throw new InvalidConfigurationException($refClass->getName() . 'must implement ' . EventSubscriberInterface::class);
            }
            $subscribers[] = $refClass->newInstanceArgs($constructArgs);
        }
        $container->setParameter('rz_intervention_request.subscribers', $subscribers);
    }
}
