<?php
/**
 * KnpMenuPass.php
 * symfony3
 * Date: 12.06.16
 */

namespace Avanzu\AdminThemeBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Reference;

class KnpMenuPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if ( false === $container->getParameter('avanzu_admin_theme.use_knp_menu')) {
            return;
        }

        if ( ! array_key_exists('KnpMenuBundle', $container->getParameter('kernel.bundles')) ){
            throw new RuntimeException(implode(PHP_EOL, [
                        'The "KnpMenuBundle" is not installed or enabled in your kernel.',
                        'Please install and/or enable the missing bundle or set "use_knp_menu" to FALSE in your configuration file'
                    ]
            ));
        }

        $definition = new Definition(
            $container->getParameter('avanzu_admin_theme.knp_menu_builder.class'), [
            new Reference('knp_menu.factory'),
            new Reference('request_stack'),
            new Reference('event_dispatcher')
        ]);

        $definition->addTag('knp_menu.menu_builder', [
            'method' => "createMainMenu",
            'alias' => "main"
        ]);

        $container->setDefinition('avanzu_admin_theme.knp_menu_builder', $definition);

        if( $container->hasDefinition('avanzu_admin_theme.setup_menu_listener') ) {
            $container->getDefinition('avanzu_admin_theme.setup_menu_listener')
                      ->setClass('%avanzu_admin_theme.setup_knp_menu_listener.class%');
        }

    }
}