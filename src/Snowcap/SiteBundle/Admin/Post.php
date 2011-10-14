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
    public function getFormFields()
    {
        return array(
            'title' => array(),
            'slug' => array(),
            'body' => array(
                'type' => 'textarea',
            ),
            'published_at' => array(
                'type' => 'datetime',
                'options' => array(
                    'input' => 'datetime',
				    'widget' => 'single_text',
                ),
            ),
        );
    }
}