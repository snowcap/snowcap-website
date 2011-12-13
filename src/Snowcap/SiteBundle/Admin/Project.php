<?php
namespace Snowcap\SiteBundle\Admin;
use Snowcap\AdminBundle\Admin\Content;
use Snowcap\SiteBundle\Entity\Project as ProjectEntity;
use Snowcap\AdminBundle\Form\ContentType;
/**
 * Project admin class
 * 
 */
class Project extends Content {
    /**
     * @return array
     */
    public function getGridFields()
    {
        return array(
            'title' => array(
                'label' => 'Title'
            ),
            'published_at' => array(
                'label' => 'Published',
                'callback' => function(ProjectEntity $project){return $project->getPublishedAt()->format(\DATE_ATOM);},
            ),
            'published' => array(
                'label' => 'Published',
                'callback' => function(ProjectEntity $project) {return $project->isPublished() ? 'Yes' : 'No';},
            ),
            'available_on_list' => array(
                'label' => 'Available on list',
                'callback' => function(ProjectEntity $project) {return $project->isPublished() ? 'Yes' : 'No';},
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
            'introduction' => array('type' => 'markdown'),
            'body' => array('type' => 'markdown'),
            'website' => array(),
            'realisation_period' => array(),
            'published_at' => array(
                'type' => 'datetime',
                'options' => array(
                    'input' => 'datetime',
				    'widget' => 'single_text',
                ),
            ),
            'client' => array(),
            'agency' => array(
                'type' => 'entity',
                'options' => array(
                    'class' => 'SnowcapSiteBundle:Agency',
                    'property' => 'name'
                ),
            ),
            'technologies' => array(
                'type' => 'entity',
                'options' => array(
                    'class' => 'SnowcapSiteBundle:Technology',
                    'property' => 'name',
                    'multiple' => true
                ),
            ),
            'published' => array(
                'type' => 'checkbox',
            ),
            'available_on_list' => array(
                'type' => 'checkbox',
            ),
            'thumb_front' => array(
                'type' => new ContentType('image', $this->environment->getAdmin('image'))
            ),
            'thumb_back' => array(
                'type' => new ContentType('image', $this->environment->getAdmin('image'))
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
        return $content->getName();
    }

}