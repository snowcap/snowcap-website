<?php
namespace Snowcap\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Post controller.
 *
 * @Route("/technologies")
 */
class TechnologyController extends Controller
{
    /**
     * @Route("/{slug}", name="snwcp_site_technology_show")
     * @Template()
     */
    public function showAction($slug) {
        $em = $this->getDoctrine()->getEntityManager();
        $technology = $em->getRepository('SnowcapSiteBundle:Technology')->findOneBySlug($slug);
        if (!$technology) {
            throw $this->createNotFoundException('Unable to find that technology.');
        }
        return array(
            'technology' => $technology,
        );
    }

    /**
     * Action used to render the technologies used in Snowcap
     *
     * @Template()
     */
    public function widgetAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $technologies = $em->getRepository('SnowcapSiteBundle:Technology')->findAll();
        return array('technologies' => $technologies);
    }


}
