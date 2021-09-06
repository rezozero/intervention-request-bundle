<?php
namespace RZ\InterventionRequestBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('rz_intervention_request');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->enumNode('driver')
                    ->values(['gd', 'imagick'])
                    ->defaultValue('gd')
                    ->info('GD does not support TIFF and PSD formats, but iMagick must be installed')
                ->end()
                ->integerNode('default_quality')
                    ->min(10)->max(100)
                    ->defaultValue(90)
                ->end()
                ->integerNode('max_pixel_size')
                    ->min(600)
                    ->defaultValue(2500)
                    ->info('Pixel width limit after Roadiz should create a smaller copy')
                ->end()
                ->scalarNode('cache_path')
                    ->defaultValue('%kernel.project_dir%/web/assets')
                ->end()
                ->booleanNode('use_passthrough_cache')->defaultTrue()->end()
                ->scalarNode('jpegoptim_path')->defaultNull()->end()
                ->scalarNode('pngquant_path')->defaultNull()->end()
                ->scalarNode('files_path')
                    ->defaultValue("%kernel.project_dir%/web/files")
                ->end()
                ->arrayNode('subscribers')
                    ->prototype('array')
                    ->children()
                        ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                        ->arrayNode('args')
                            ->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
