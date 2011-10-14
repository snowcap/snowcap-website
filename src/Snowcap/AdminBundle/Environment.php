<?php

namespace Snowcap\AdminBundle;
/**
 * Environment admin service
 *
 */
class Environment {
    /**
     * Content admin configuration
     *
     * @var array
     */
    private $content = array();
    /**
     * Class constructor
     *
     * @param array $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }
    /**
     * Get the content admin instance for the provided type
     *
     * @throws \Exception
     * @param string $type
     * @return \Snowcap\AdminBundle\Admin\Content
     */
    public function getAdmin($type)
    {
        if(!array_key_exists($type, $this->content)){
            throw new \Exception('Invalid type');
        }
        $adminParams = $this->content[$type];
        $adminClassName = $adminParams['admin_class'];
        $adminInstance = new $adminClassName($adminParams['label'], $adminParams['model_class']);
        return $adminInstance;
    }
    /**
     * Build a param array for navigation purposes
     *
     * @return array
     */
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