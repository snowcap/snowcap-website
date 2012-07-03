<?php

namespace Snowcap\SiteAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TechnologyType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug', 'slug', array('target' => 'name'))
            ->add('shortDescription')
            ->add('description')
            ->add('website')
            ->add('highlight');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Snowcap\SiteBundle\Entity\Technology'
        );
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'snwcp_admin_technology';
    }

}