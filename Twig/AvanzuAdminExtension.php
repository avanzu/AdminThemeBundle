<?php
/**
 * WidgetExtension.php
 * avanzu-admin
 * Date: 17.03.14
 */

namespace Avanzu\AdminThemeBundle\Twig;


use Twig_Environment;

class AvanzuAdminExtension extends \Twig_Extension {


    protected $options;
    protected $env;

    /**
     * AvanzuAdminExtension constructor.
     */
    public function __construct($options, $env)
    {
        $this->options = $options;
        $this->env      = $env;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('admin_style_path' , [$this, 'getStylePath']),
            new \Twig_SimpleFunction('admin_script_path', [$this, 'getScriptPath']),
        );
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('body_class', [$this, 'bodyClass']),
        );
    }

    public function getStylePath($stylesheet = null)
    {
        $stylesheet = $stylesheet?: $this->options['default_stylesheet'];
        return sprintf('bundles/avanzuadmintheme/static/%s/styles/%s', $this->env, $stylesheet);
    }

    public function getScriptPath($script = null)
    {
        $script = $script?: $this->options['default_script'];
        return sprintf('bundles/avanzuadmintheme/static/%s/scripts/%s', $this->env, $script);
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
