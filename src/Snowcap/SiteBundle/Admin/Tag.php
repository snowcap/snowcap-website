<?php
namespace Snowcap\SiteBundle\Admin;
use Snowcap\AdminBundle\Admin\Content;

class Tag extends Content {
    public function getEntityName()
    {
        return 'Snowcap\SiteBundle\Entity\Tag';
    }
    public function getContentName()
    {
        return 'Tag';
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
        );
    }

    public function getContentTitle($content)
    {
        return $content->getName();
    }
}