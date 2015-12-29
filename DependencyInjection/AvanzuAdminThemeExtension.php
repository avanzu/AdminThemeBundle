<?php

namespace Avanzu\AdminThemeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
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

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

    }

    /**
     * Allow an extension to prepend the extension configurations.
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['TwigBundle'])) {
            $container->prependExtensionConfig(
                'twig',
                array(
                    'form_theme'    => array(
                        'AvanzuAdminThemeBundle:layout:form-theme.html.twig'
                    ),
                    'globals' => array(
                        'admin_theme' => '@avanzu_admin_theme.theme_manager'
                    )
                )
            );
        }

        if (isset($bundles['AsseticBundle'])) {

            $assets = include(dirname(__FILE__).'/../Resources/config/assets.php');

            $container->prependExtensionConfig(
                'assetic',
                array(
                    'assets'  => $assets,
                    'bundles' => array(
                        'AvanzuAdminThemeBundle'
                    )

                )
            );

        }
    }
}
