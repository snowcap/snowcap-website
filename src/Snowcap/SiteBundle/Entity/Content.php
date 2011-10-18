<?php
namespace Snowcap\SiteBundle\Entity;

use Symfony\Component\DependencyInjection\Container;

/**
 * Abstract content class
 *
 */
abstract class Content
{
    /**
     * @param string $key
     * @return bool
     */
    public function __isset($key)
    {
        return method_exists($this, 'get' . ucfirst(Container::camelize($key)));
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        return call_user_func(array($this, 'get' . ucfirst(Container::camelize($key))));
    }
}