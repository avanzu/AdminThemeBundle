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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('avanzu_admin_theme');

        $rootNode->children()
                    ->scalarNode('bower_bin')
                        ->info('Path to bower binary')
                        ->defaultValue('/usr/local/bin/bower')
                    ->end()
                    ->booleanNode('use_assetic')
                        ->defaultTrue()
                        ->info('Enable assets in assetic')
                    ->end()
                    ->booleanNode('use_twig')
                        ->info('Enable the user of avanzu_context_help in twig templates')
                        ->defaultTrue()
                    ->end()
                    ->arrayNode('options')
                        ->info('')
                    ->end()
                    ->arrayNode('knp_menu')
                        ->children()
                            ->scalarNode('enable')
                                ->defaultValue(false)
                                ->info('')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('button')
                        ->children()
                            ->scalarNode('type')
                                ->defaultValue('primary')
                                ->info('')
                            ->end()
                            ->scalarNode('size')
                                ->defaultFalse()
                                ->info('')
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('theme')
                        ->children()
                            ->scalarNode('default_avatar')
                                ->defaultValue('bundles/avanzuadmintheme/img/avatar.png')
                            ->end()
                            ->scalarNode('skin')
                                ->defaultValue('skin-blue')
                                ->info('see skin listing for viable options')
                            ->end()
                            ->booleanNode('fixed_layout')
                                ->defaultFalse()
                            ->end()
                            ->booleanNode('boxed_layout')
                                ->defaultFalse()
                                ->info('these settings relate directly to the "Layout Options"')
                            ->end()
                            ->booleanNode('collapsed_sidebar')
                                ->defaultFalse()
                                ->info('described in the adminlte documentation')
                            ->end()
                            ->booleanNode('mini_sidebar')
                                ->defaultFalse()
                                ->info('')
                            ->end()
                            ->booleanNode('control_sidebar')
                                ->defaultFalse()
                                ->info('controls whether the right hand panel will be rendered')
                            ->end()
                            ->arrayNode('widget')
                                ->children()
                                    ->scalarNode('collapsible_title')
                                        ->defaultValue('Collapse')
                                        ->info('')
                                    ->end()
                                    ->scalarNode('removable_title')
                                        ->defaultValue('Remove')
                                        ->info('')
                                    ->end()
                                    ->scalarNode('type')
                                        ->defaultValue('primary')
                                        ->info('')
                                    ->end()
                                        ->booleanNode('bordered')
                                        ->defaultTrue()
                                        ->info('')
                                    ->end()
                                        ->booleanNode('collapsible')
                                        ->defaultFalse()
                                        ->info('')
                                    ->end()
                                    ->booleanNode('removable')
                                        ->defaultFalse()
                                        ->info('')
                                    ->end()
                                    ->booleanNode('solid')
                                        ->defaultTrue()
                                        ->info('')
                                    ->end()
                                    ->booleanNode('use_footer')
                                        ->defaultFalse()
                                        ->info('')
                                    ->end()
                            ->end()
                        ->end()
                    ->end()
                    
                ->end();
                
        return $treeBuilder;
    }
}
