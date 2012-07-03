<?php

namespace Snowcap\SiteAdminBundle\Admin;

use Snowcap\AdminBundle\Admin\ContentAdmin;

use Snowcap\SiteAdminBundle\Form\ImageType;

class ImageAdmin extends ContentAdmin {
    /**
     * Return the main admin form for this content
     *
     * @param object $data
     * @return \Symfony\Component\Form\Form
     */
    public function getForm($data = null)
    {
        return $this->createForm(new ImageType(), $data);
    }

    /**
     * Return the main admin list for this content
     *
     * @return \Snowcap\AdminBundle\Datalist\AbstractDatalist
     */
    public function getDatalist()
    {
        return $this->createDatalist('thumbnail', 'image')
            ->add('path', 'image')
            ->add('name', 'label')
            ->paginate(12);
    }

}