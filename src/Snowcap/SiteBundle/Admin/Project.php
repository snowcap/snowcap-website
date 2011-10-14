<?php
namespace Snowcap\SiteBundle\Admin;
use Snowcap\AdminBundle\Admin\Content;

class Project extends Content {
    public function getEntityName()
    {
        return 'Snowcap\SiteBundle\Entity\Project';
    }
    public function getContentName()
    {
        return 'Project';
    }
    public function getGridFields()
    {
        return array(
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
            'slug' => array(
                'type' => 'text',
            ),
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