<?php
/**
 * DependencyResolver.php
 * publisher
 * Date: 18.04.14
 */

namespace Avanzu\AdminThemeBundle\Util;


class DependencyResolver implements DependencyResolverInterface
{

    protected $queued     = array();
    protected $registered = array();
    protected $resolved   = array();
    protected $unresolved = array();


    public function register($items)
    {
        $this->registered = $items;
        return $this;
    }

    public function resolveAll()
    {
        $this->resolve(array_keys($this->registered));
        return $this->queued;
    }

    protected function resolve($ids)
    {
        foreach ($ids as $id) {
            if (isset($this->resolved[$id])) {
                continue;
            } // already done
            if (!isset($this->registered[$id])) {
                continue;
            } // unregistered
            if (!$this->hasDependencies($id)) { // standalone
                $this->queued[]      = $this->registered[$id];
                $this->resolved[$id] = true;

                continue;
            }

            $deps = $this->unresolved($this->getDependencies($id));

            $this->resolve($deps);

            $deps = $this->unresolved($this->getDependencies($id));

            if (empty($deps)) {
                $this->queued[]      = $this->registered[$id];
                $this->resolved[$id] = true;

                continue;
            }
        }

    }

    protected function unresolved($deps)
    {
        return array_diff($deps, array_keys($this->resolved));
    }

    protected function hasDependencies($id)
    {
        return (!empty($this->registered[$id]['deps']));
    }

    protected function getDependencies($id)
    {
        return $this->registered[$id]['deps'];
    }

}