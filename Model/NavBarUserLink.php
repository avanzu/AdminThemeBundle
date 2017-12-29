<?php

namespace Avanzu\AdminThemeBundle\Model;

/**
 * Class NavBarUserLink
 *
 * @package Avanzu\AdminThemeBundle\Model
 */
class NavBarUserLink
{
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $path;
    /**
     * @var array
     */
    protected $parameters;

    /**
     * NavBarUserLink constructor.
     *
     * @param $title
     * @param $path
     * @param $parameters
     */
    public function __construct($title, $path, $parameters = [])
    {
        $this->title = $title;
        $this->path = $path;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }
}
