<?php

namespace Snowcap\AdminBundle;

class Environment {
    private $content = array();
    public function __construct($content)
    {
        $this->content = $content;
    }
    public function getAdmin($type)
    {
        if(!array_key_exists($type, $this->content)){
            throw new \Exception('Invalid type');
        }
        $adminClassName = $this->content[$type]['admin_class'];
        return new $adminClassName;
    }
    public function getNavigation() {
        $navigation = array();
        foreach ($this->content as $type => $config) {
            $navigation[] = array(
                'route' => 'content',
                'type'=> $type
            );
        }
        return $navigation;

    }
}