<?php
namespace Snowcap\SiteBundle\Admin;
use Snowcap\AdminBundle\Admin\Content;
/**
 * Post admin class
 *
 */
class Post extends Content {
    /**
     * @return array
     */
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
    /**
     * @return array
     */
    public function getFormFields()
    {
        return array(
            'title' => array(),
            'slug' => array('type' => 'slug'),
            'tags' => array(
                'type' => 'entity',
                'options' => array(
                    'class' => 'SnowcapSiteBundle:Tag',
                    'property' => 'name',
                    'multiple' => true
                )
            ),
            'summary' => array(
                'type' => 'markdown',
            ),
            'body' => array(
                'type' => 'markdown',
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

    public function getContentTitle($content)
    {
        return $content->getTitle();
    }
}