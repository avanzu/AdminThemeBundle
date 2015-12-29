<?php

namespace Avanzu\AdminThemeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Dump\Container;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AvanzuAdminThemeExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $container->setParameter('avanzu_admin_theme.bower_bin', $config['bower_bin']);
        $container->setParameter('avanzu_admin_theme.use_assetic', $config['use_assetic']);
        $container->setParameter('avanzu_admin_theme.use_twig', $config['use_twig']);
        $container->setParameter('avanzu_admin_theme.options', $config['theme']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        if( $config['enable_demo']) {
            $loader->load('demo/demo.xml');
        }

    }


    protected function prependAsseticConfiguration(ContainerBuilder $builder, $bundles)
    {
        if( true !== $builder->getParameter('avanzu_admin_theme.use_assetic') ) return;
        if( ! isset($bundles['AsseticBundle']) ) return;
        $assets = include(dirname(__FILE__).'/../Resources/config/assets.php');

        $builder->prependExtensionConfig(
            'assetic',
            array(
                'assets'  => $assets,
                'bundles' => array(
                    'AvanzuAdminThemeBundle'
                )
            )
        );
    }

    protected function prependTwigConfiguration(ContainerBuilder $builder, $bundles)
    {

        if( true !== $builder->getParameter('avanzu_admin_theme.use_twig') ) return;
        if (! isset($bundles['TwigBundle']) ) return;

        $builder->prependExtensionConfig(
            'twig',
            array(
                'form_themes'    => array(
                    'AvanzuAdminThemeBundle:layout:form-theme.html.twig'
                ),
                'globals' => array(
                    'admin_theme' => '@avanzu_admin_theme.theme_manager'
                )
            )
        );

    }

    /**
     * Allow an extension to prepend the extension configurations.
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        /*
        $bundles = $container->getParameter('kernel.bundles');
        $this->prependTwigConfiguration($container, $bundles);
        $this->prependAsseticConfiguration($container, $bundles);
        */
    }
}
