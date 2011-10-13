<?php
namespace Snowcap\SiteBundle\Admin;
use Snowcap\AdminBundle\Admin\Content;

class Post extends Content {
    public function getEntityName()
    {
        return 'Snowcap\SiteBundle\Entity\Post';
    }
    public function getContentName()
    {
        return 'Post';
    }
    public function getGridFields()
    {
        return array(
            'id' => array(
                'label' => 'Id'
            ),
            'title' => array(
                'callback' => function($entity){return strtoupper($entity->getTitle());},
                'label' => 'Title'
            ),
        );
    }
}