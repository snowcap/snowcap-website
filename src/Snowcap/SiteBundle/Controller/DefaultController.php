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
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
		$em = $this->getDoctrine()->getEntityManager();
        $latestPosts = $em->getRepository('SnowcapSiteBundle:Post')->getLatest(2);
        return array('latestPosts' => $latestPosts);    
	}
}
