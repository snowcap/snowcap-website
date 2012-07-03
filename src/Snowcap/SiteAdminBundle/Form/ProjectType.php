<?php

namespace Snowcap\SiteAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Snowcap\SiteAdminBundle\Form\CollaborationType;

class ProjectType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slug', 'slug', array('target' => 'title'))
            ->add('introduction', 'textarea')
            ->add('body', 'markdown')
            ->add('published_at', 'datetime', array('widget' => 'single_text'))
            ->add('website', 'url')
            ->add('client')
            ->add('realisation_period')
            ->add('collaborations', 'collection', array(
                'type' => new CollaborationType(),
                'allow_add' => true,
                'by_reference' => false
            ))
            ->add('technologies', 'entity', array(
                'multiple' => true,
                'property' => 'name',
                'class' => 'Snowcap\SiteBundle\Entity\Technology'
            ))
            ->add('thumb_front', 'entity', array(
                'class' => 'Snowcap\SiteBundle\Entity\Image',
                'property' => 'name'
            ))
            ->add('thumb_back', 'entity', array(
                'class' => 'Snowcap\SiteBundle\Entity\Image',
                'property' => 'name'
            ))
            ->add('published')
            ->add('available_on_list')
            ->add('highlighted')
            ->add('meta_title')
            ->add('meta_description')
            ->add('meta_keywords');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Snowcap\SiteBundle\Entity\Project'
        );
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    function getName()
    {
        return 'snwcp_admin_project';
    }

}