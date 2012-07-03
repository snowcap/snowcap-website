<?php

namespace Snowcap\SiteAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ImageType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('file', 'snowcap_core_image', array('web_path' => 'path', 'format' => 'admin_thumb'))
            ->add('name')
            ->add('alt');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Snowcap\SiteBundle\Entity\Image'
        );
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'snwcp_admin_agency';
    }

}