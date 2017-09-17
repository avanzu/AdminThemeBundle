<?php

namespace Avanzu\AdminThemeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\Exception\FileLocatorFileNotFoundException;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AvanzuAdminThemeExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('avanzu_admin_theme.bower_bin', $config['bower_bin']);

        try 
        {
            $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('services.xml');
        }
        catch(FileLocatorFileNotFoundException $e) // Symfony 3.3 and 4.x are based in YAML
        {
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('services.yaml');
        }
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
                [
                    'form_theme' => [
                        'AvanzuAdminThemeBundle:layout:form-theme.html.twig',
                    ],
                    'globals' => [
                        'admin_theme' => '@avanzu_admin_theme.theme_manager',
                    ],
                ]
            );
        }

        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        if ($config['use_assetic'] && isset($bundles['AsseticBundle'])) {
            $assets = include dirname(__FILE__) . '/../Resources/config/assets.php';

            $container->prependExtensionConfig(
                'assetic',
                [
                    'assets' => $assets,
                    'bundles' => [
                        'AvanzuAdminThemeBundle',
                    ],
                ]
            );
        }
    }
}
