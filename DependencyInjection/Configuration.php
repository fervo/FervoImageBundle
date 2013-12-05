<?php

namespace Fervo\ImageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fervo_image');

        $rootNode
            ->children()
                ->scalarNode('imagine_provider')->end()
                ->scalarNode('thumbnail_cache')->end()
                ->scalarNode('thumbnail_reference_resolver')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
