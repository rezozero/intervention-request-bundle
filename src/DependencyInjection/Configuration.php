<?php

declare(strict_types=1);

namespace RZ\InterventionRequestBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('rz_intervention_request');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')
                    ->defaultValue('gd')
                ->end()
                ->scalarNode('default_quality')
                    ->defaultValue(90)
                ->end()
                ->scalarNode('max_pixel_size')
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
                    ->defaultValue('%kernel.project_dir%/web/files')
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
