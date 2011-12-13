<?php
namespace Snowcap\SiteBundle\Admin;
use Snowcap\AdminBundle\Admin\Content;

class PostCategory extends Content {
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
            'slug' => array(),
        );
    }

    public function getContentTitle($content)
    {
        return $content->getName();
    }

}