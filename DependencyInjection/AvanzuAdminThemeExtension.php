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
        // Load the configuration from files
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if(array_key_exists("options",$configs) == false)
        {
            $config["options"] = array(
                "skin" => "skin-blue-light"
            );
        }

        // Set the parameters from config files
        $container->setParameter('avanzu_admin_theme.bower_bin', (string) $config['bower_bin']);
        $container->setParameter('avanzu_admin_theme.use_twig', (bool) $config['use_twig']);
        $container->setParameter('avanzu_admin_theme.options', (array) $config['options']);

        // Load the services (with parameters loaded), since twig require theme_manager service
        try
        {
            $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('services.xml');
        }
        catch(\Exception $e) // Symfony 3.3 and 4.x are based in YAML
        { // old exception FileLocatorFileNotFoundException
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('services.yml');
        }
    }

    /**
     * Allow an extension to prepend the extension configurations.
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        // Load the configuration from files
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        if(array_key_exists("options",$configs) == false)
        {
            $config["options"] = array(
                "skin" => "skin-blue-light"
            );
        }

        // Set the parameters from config files
        $container->setParameter('avanzu_admin_theme.bower_bin', (string) $config['bower_bin']);
        $container->setParameter('avanzu_admin_theme.use_twig', (bool) $config['use_twig']);
        $container->setParameter('avanzu_admin_theme.options', (array) $config['options']);

        // Load the services (with parameters loaded), since twig require theme_manager service
        try
        {
            $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('services.xml');
        }
        catch(\Exception $e) // Symfony 3.3 and 4.x are based in YAML
        {// old exception FileLocatorFileNotFoundException
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('services.yml');
        }

        $bundles = $container->getParameter('kernel.bundles');

        // Inject in twig global config the theme_manager service
        if ($config['use_twig'] && isset($bundles['TwigBundle'])) {
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
