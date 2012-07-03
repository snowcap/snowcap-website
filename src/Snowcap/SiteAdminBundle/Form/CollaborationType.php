<?php

namespace Snowcap\SiteAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CollaborationType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('agency', 'entity', array(
                'class' => 'Snowcap\SiteBundle\Entity\Agency',
                'property' => 'name'
            ))
            ->add('field');
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Snowcap\SiteBundle\Entity\Collaboration');
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'snwcp_admin_collaboration';
    }

}