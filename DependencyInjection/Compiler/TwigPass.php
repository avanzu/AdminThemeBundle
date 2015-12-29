<?php
/**
 * TwigPass.php
 * avanzu-admin-2
 * Date: 29.12.15
 */

namespace Avanzu\AdminThemeBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TwigPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');
        if( true !== $container->getParameter('avanzu_admin_theme.use_twig') ) return;
        if (! isset($bundles['TwigBundle']) ) return;

        $param = $container->getParameter('twig.form.resources');
        if( ! is_array($param) ) $param = array();
        array_push($param, 'AvanzuAdminThemeBundle:layout:form-theme.html.twig');
        $container->setParameter('twig.form.resources', $param);

        /*
        $container->getParameter(
            'twig',
            array(
                'form_themes'    => array(

                ),
                'globals' => array(
                    'admin_theme' => '@avanzu_admin_theme.theme_manager',
                    'theme_options' => $container->getParameter('avanzu_admin_theme.options')
                )
            )
        );
        */
    }
}