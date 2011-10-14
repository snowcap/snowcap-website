<?php
namespace Snowcap\SiteBundle\Admin;
use Snowcap\AdminBundle\Admin\Content;
/**
 * Page admin class
 * 
 */
class Page extends Content {
    /**
     * @return array
     */
    public function getGridFields()
    {
        return array(
            'title' => array(
                'callback' => function($entity){return strtoupper($entity->getTitle());},
                'label' => 'Title'
            ),
        );
    }
    /**
     * @return array
     */
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