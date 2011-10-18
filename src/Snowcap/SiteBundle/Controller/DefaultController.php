<?php
namespace Snowcap\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Snowcap\SiteBundle\Entity\Post;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="snwcp_site_default_index")
     * @Template()
     */
    public function indexAction()
    {
		$em = $this->getDoctrine()->getEntityManager();
        $latestPosts = $em->getRepository('SnowcapSiteBundle:Post')->getLatest(2);
        return array('latestPosts' => $latestPosts);    
	}

    /**
     * @Route("/company", name="snwcp_site_default_company")
     * @Template()
     */
    public function companyAction() {

        return array();
    }

    /**
     * @Route("/method", name="snwcp_site_default_method")
     * @Template()
     */
    public function methodAction() {

        return array();
    }
    /**
     * @Route("/team", name="snwcp_site_default_team")
     * @Template()
     */
    public function teamAction() {

        return array();
    }

    /**
     * @Route("/contact", name="snwcp_site_default_contact")
     * @Template()
     */
    public function contactAction() {

        return array();
    }
}
