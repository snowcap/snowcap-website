<?php
namespace Snowcap\SiteBundle\Admin;
use Snowcap\AdminBundle\Admin\Content;
use Snowcap\AdminBundle\Form\ContentType;

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
            'category' => array(
                'type' => 'entity',
                'options' => array(
                    'class' => 'SnowcapSiteBundle:PostCategory',
                    'property' => 'name',
                ),
            ),
            'technologies' => array(
                'type' => 'entity',
                'options' => array(
                    'class' => 'SnowcapSiteBundle:Technology',
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
            'thumb' => array(
                'type' => new ContentType('image', $this->environment->getAdmin('image')),
                'options' => array(
                    'required' => false,
                ),
            ),
            'images' => array(
                'type' => 'collection',
                'options' => array(
                    'type'=> new ContentType('image', $this->environment->getAdmin('image')),
                    'allow_add' => true,
                    'by_reference' => false,
                    'prototype' => true,
                    )
            ),
            'meta_title' => array(),
            'meta_description' => array(),
            'meta_keywords' => array(),
        );
    }

    public function getContentTitle($content)
    {
        return $content->getTitle();
    }
}