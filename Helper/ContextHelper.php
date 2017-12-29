<?php
/**
 * ContextHelper class
 *
 * Instead of fully relying on blocks and includes, this class that support
 * the twig global named avanzu_admin_context to store and retrieve particular
 * values throughout the page rendering.
 *
 * This is basically a parameter bag "on-page" with some pre-defined values
 * based on the bundle configuration.
 *
 * The implemenation relies in a ArrayObject native PHP object, so it recieves
 * all the changes via avanzu_admin_context.options to store the new modified
 * values in the internal storage of ArrayObject, which is accessible via the
 * getter and setter in option attribute class.
 */

namespace Avanzu\AdminThemeBundle\Helper;

use Avanzu\AdminThemeBundle\Routing\RouteAliasCollection;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;

class ContextHelper extends \ArrayObject
{
    /**
     * @var RouteAliasCollection
     */
    private $router;

    /**
     * ContextHelper constructor.
     *
     * @param array                $config The data under avanzu_admin_theme.options config
     * @param RouteAliasCollection $router avanzu_admin_theme.admin_route class route service
     */
    public function __construct(array $config, RouteAliasCollection $router)
    {
        $this->initialize($config);
        $this->router = $router;
    }

    /**
     * Create a OptionResolver with default parameters and overwrite the context
     * with the default options in avanzu_admin_theme.options
     *
     * @param array $config The data under avanzu_admin_theme.options config
     */
    protected function initialize(array $config = [])
    {
        // Create a resolve and configure the defaults
        $resolver = new OptionsResolver();
        $this->configureDefaults($resolver);

        try
        {
            // Parse the config in avanzu_admin_theme.options as array object in avanzu_admin_context.options
            $newConfig = $resolver->resolve($config);
            // Change the internal storage array in the ArrayObject
            $this->exchangeArray($newConfig);
        }
        catch(UndefinedOptionsException $e)
        {
            echo $e->getMessage() . PHP_EOL;
            print_r($config, TRUE);
        }
    }

    /**
     * Get attribute method for options. It uses a interal copy array of the
     * storage in the ArrayObject
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->getArrayCopy();
    }

    /**
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function setOption($name, $value)
    {
        $this->offsetSet($name, $value);

        return $this;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasOption($name)
    {
        return $this->offsetExists($name);
    }

    /**
     * @param      $name
     * @param null $default
     *
     * @return mixed|null
     */
    public function getOption($name, $default = null)
    {
        return $this->offsetExists($name) ? $this->offsetGet($name) : $default;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasAlias($name)
    {
        return $this->router->hasAlias($name);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function fromAlias($name)
    {
        return $this->router->getRouteByAlias($name);
    }

    /**
     * @param OptionsResolver $resolver
     */
    protected function configureDefaults(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'use_twig' => true,
            'use_assetic' => true,
            'options' => [],
            'skin' => 'skin-blue',
            'fixed_layout' => false,
            'boxed_layout' => false,
            'collapsed_sidebar' => false,
            'mini_sidebar' => false,
            'control_sidebar' => true,
            'default_avatar' => 'bundles/avanzuadmintheme/img/avatar.png',
            'widget' => [
                'collapsible_title' => 'Collapse',
                'removable_title' => 'Remove',
                'type' => 'primary',
                'bordered' => true,
                'collapsible' => true,
                'solid' => false,
                'removable' => false,
                'use_footer' => true,
            ],
            'button' => [
                'type' => 'primary',
                'size' => false,
            ],
            'knp_menu' => [
                'enable' => false,
                'main_menu' => 'avanzu_main',
                'breadcrumb_menu' => false,
            ],
        ]);
    }
}
