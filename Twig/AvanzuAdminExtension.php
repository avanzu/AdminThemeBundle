<?php
/**
 * WidgetExtension.php
 * avanzu-admin
 * Date: 17.03.14
 */

namespace Avanzu\AdminThemeBundle\Twig;

use Avanzu\AdminThemeBundle\Routing\RouteAliasCollection;

class AvanzuAdminExtension extends \Twig_Extension
{
    protected $options;
    protected $env;
    /**
     * @var RouteAliasCollection
     */
    private $aliasRouter;

    /**
     * AvanzuAdminExtension constructor.
     *
     * @param                      $options
     * @param                      $env
     * @param RouteAliasCollection $aliasRouter
     */
    public function __construct($options, $env, RouteAliasCollection $aliasRouter)
    {
        $this->options = $options;
        $this->env = $env;
        $this->aliasRouter = $aliasRouter;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('body_class', [$this, 'bodyClass']),
            new \Twig_SimpleFilter('route_alias', [$this->aliasRouter, 'getRouteByAlias']),
        ];
    }

    public function bodyClass($classes = '')
    {
        $classList = [$classes];
        $options = $this->options;

        if(isset($options['skin'])) $classList[] = $options['skin'];
        if(isset($options['fixed_layout']) && true == $options['fixed_layout']) $classList[] = 'fixed';
        if(isset($options['boxed_layout']) && true == $options['boxed_layout']) $classList[] = 'layout-boxed';
        if(isset($options['collapsed_sidebar']) && true == $options['collapsed_sidebar']) $classList[] = 'sidebar-collapse';
        if(isset($options['mini_sidebar']) && true == $options['mini_sidebar']) $classList[] = 'sidebar-mini';

        return implode(' ', array_filter($classList));
    }

    public function getName()
    {
        return 'avanzu_admin';
    }
}
