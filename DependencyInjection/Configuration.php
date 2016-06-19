<?php

namespace Avanzu\AdminThemeBundle\DependencyInjection;

use Avanzu\AdminThemeBundle\Controller\BreadcrumbController;
use Avanzu\AdminThemeBundle\Controller\NavbarController;
use Avanzu\AdminThemeBundle\Controller\SidebarController;
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
                            ->scalarNode('control_sidebar')->defaultValue(true)->end()
                            ->arrayNode('widget')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('type')->defaultValue('primary')->end()
                                    ->scalarNode('bordered')->defaultValue(true)->end()
                                    ->scalarNode('collapsible')->defaultValue(true)->end()
                                    ->scalarNode('collapsible_title')->defaultValue('Collapse')->end()
                                    ->scalarNode('removable')->defaultValue(true)->end()
                                    ->scalarNode('removable_title')->defaultValue('Remove')->end()
                                    ->scalarNode('solid')->defaultValue(false)->end()
                                    ->scalarNode('use_footer')->defaultValue(true)->end()
                                ->end()
                            ->end()
                            ->arrayNode('button')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('type')->defaultValue('primary')->end()
                                    ->scalarNode('size')->defaultValue('md')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                    ->scalarNode('use_twig')
                        ->defaultValue(true)
                    ->end()
                    ->scalarNode('enable_demo')
                        ->defaultValue(false)
                    ->end()
                    ->arrayNode('knp_menu')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('enable')->defaultValue(false)->end()
                            ->scalarNode('main_menu')->defaultValue('avanzu_main')->end()
                            ->scalarNode('breadcrumb_menu')->defaultValue(false)->end()
                        ->end()
                    ->end()

                ->end()
            ->end();
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
