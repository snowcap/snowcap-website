<?php

namespace Snowcap\SiteBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("", name="admin_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

}
