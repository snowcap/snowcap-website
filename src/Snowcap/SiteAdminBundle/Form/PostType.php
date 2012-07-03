<?php

namespace Snowcap\SiteAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PostType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slug', 'slug', array('target' => 'title'))
            ->add('category', 'entity', array(
                'class' => 'Snowcap\SiteBundle\Entity\PostCategory',
                'property' => 'name'
            ))
            ->add('summary', 'textarea')
            ->add('body', 'markdown')
            ->add('published_at', 'datetime', array('widget' => 'single_text'))
            ->add('technologies', 'entity', array(
                'multiple' => true,
                'property' => 'name',
                'class' => 'Snowcap\SiteBundle\Entity\Technology'
            ))
            ->add('thumb', 'entity', array(
                'class' => 'Snowcap\SiteBundle\Entity\Image',
                'property' => 'name'
            ))
            ->add('published')
            ->add('meta_title')
            ->add('meta_description')
            ->add('meta_keywords');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Snowcap\SiteBundle\Entity\Post'
        );
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'snwcp_admin_post';
    }

}