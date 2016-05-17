<?php

namespace Avanzu\AdminThemeBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('avanzu_admin_theme');

        $rootNode->children()
                    ->arrayNode('theme')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('default_avatar')->defaultValue('bundles/avanzuadmintheme/img/avatar.png')->end()
                            ->scalarNode('skin')->defaultValue('skin-blue')->end()
                            ->scalarNode('fixed_layout')->defaultValue(false)->end()
                            ->scalarNode('boxed_layout')->defaultValue(false)->end()
                            ->scalarNode('collapsed_sidebar')->defaultValue(false)->end()
                            ->scalarNode('mini_sidebar')->defaultValue(false)->end()
                            ->scalarNode('default_stylesheet')->defaultValue('admin-lte-base.css')->end()
                            ->scalarNode('default_script')->defaultValue('admin-lte-base.js')->end()
                        ->end()
                    ->end()
                    ->scalarNode('bower_bin')
                        ->defaultValue('/usr/local/bin/bower')
                    ->end()
                    ->scalarNode('use_assetic')
                        ->defaultValue(false)
                    ->end()
                    ->scalarNode('use_twig')
                        ->defaultValue(true)
                    ->end()
                    ->scalarNode('enable_demo')
                        ->defaultValue(false)
                    ->end()
                ->end();
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
