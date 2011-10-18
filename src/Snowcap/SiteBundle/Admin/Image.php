<?php
namespace Snowcap\SiteBundle\Admin;
use Snowcap\AdminBundle\Admin\Content;

class Image extends Content {
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
            'file' => array('type' => 'file'),
            'name' => array(),
            'alt' => array(),
        );
    }

    public function getContentTitle($content)
    {
        return $content->getName();
    }

}