<?php
namespace Snowcap\SiteBundle\Admin;
use Snowcap\AdminBundle\Admin\Content;

class Agency extends Content {
    public function getEntityName()
    {
        return 'Snowcap\SiteBundle\Entity\Agency';
    }
    public function getContentName()
    {
        return 'Agency';
    }
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
            'website' => array(),
        );
    }

    public function getContentTitle($content)
    {
        return $content->getName();
    }

}