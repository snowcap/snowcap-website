<?php

namespace Snowcap\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * Get the navigation for the content
     * 
     * @Template()
     */
    public function navigationAction() {
        $navigation = $this->get('snowcap_admin')->getNavigation();
        
        return array('navigation' => $navigation);
    }
}
