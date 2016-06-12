<?php
/**
 * WidgetExtension.php
 * avanzu-admin
 * Date: 17.03.14
 */

namespace Avanzu\AdminThemeBundle\Twig;


use Avanzu\AdminThemeBundle\Routing\RouteAliasCollection;
use Twig_Environment;

class AvanzuAdminExtension extends \Twig_Extension {


    protected $options;
    protected $env;
    /**
     * @var RouteAliasCollection
     */
    private $aliasRouter;

    /**
     * AvanzuAdminExtension constructor.
     *
     * @param             $options
     * @param             $env
     * @param RouteAliasCollection $aliasRouter
     */
    public function __construct($options, $env, RouteAliasCollection $aliasRouter)
    {
        $this->options = $options;
        $this->env      = $env;
        $this->aliasRouter = $aliasRouter;
    }


    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('body_class', [$this, 'bodyClass']),
            new \Twig_SimpleFilter('route_alias', [$this->aliasRouter, 'getRouteByAlias'])
        );
    }

    public function bodyClass($classes = "")
    {
        $classList = [$classes];
        $options   = $this->options;

        $classList[] = $options['skin'];
        if( $options['fixed_layout'] ) $classList[] = 'fixed';
        if( $options['boxed_layout']) $classList[] = 'boxed';
        if( $options['collapsed_sidebar']) $classList[] = 'sidebar-collapse';
        if( $options['mini_sidebar']) $classList[] = 'sidebar-mini';

        return implode(' ', array_filter($classList));

    }

    public function getName()
    {
        return 'avanzu_admin';
    }
}
