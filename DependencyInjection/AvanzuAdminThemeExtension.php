<?php

namespace Avanzu\AdminThemeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AvanzuAdminThemeExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);
        $config['theme']['knp_menu'] = $config['knp_menu'];
        

        $container->setParameter('avanzu_admin_theme.use_twig', $config['use_twig']);
        $container->setParameter('avanzu_admin_theme.use_knp_menu', $config['knp_menu']['enable']);
        $container->setParameter('avanzu_admin_theme.options', $config['theme']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        if( $config['knp_menu']['enable'] ) {
            $loader->load('container/knp-menu.yml');
        }

        if( $config['enable_demo']) {
            $loader->load('demo/demo.yml');
        }
    }

}
