<?php
namespace Snowcap\SiteBundle\Admin;
use Snowcap\AdminBundle\Admin\Content;

class Technology extends Content {
    public function getGridFields()
    {
        return array(
            'name' => array(
                'callback' => function($entity){return strtoupper($entity->getName());},
                'label' => 'Name'
            ),
        );
    }

    public function getFormFields()
    {
        return array(
            'name' => array(),
            'description' => array(
               'type' => 'markdown'
            ),
        );
    }

    public function getContentTitle($content)
    {
        return $content->getName();
    }

}