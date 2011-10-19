<?php
namespace Snowcap\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Snowcap\SiteBundle\Controller\BaseController;
use Snowcap\SiteBundle\Entity\Post;

/**
 * Post controller.
 *
 * @Route("/cases")
 */
class ProjectController extends BaseController
{
    /**
     * Display a list of projects
     * 
     * @Route("/", name="snwcp_site_project_list")
     * @Template()
     */
    public function listAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $projects = $em->getRepository('SnowcapSiteBundle:Project')->getLatest(1500);
        
        return array('projects' => $projects);
    }

    /**
     * Finds and displays a Post entity.
     *
     * @Route("/{slug}", name="snwcp_site_project_show")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $project = $em->getRepository('SnowcapSiteBundle:Project')->findOneBySlug($slug);
        if (!$project) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }
        return array(
            'project' => $project,
        );
    }

    /**
     * @Template()
     */
    public function widgetAction($limit)
    {
		$em = $this->getDoctrine()->getEntityManager();
        $latestProjects = $em->getRepository('SnowcapSiteBundle:Project')->getLatest($limit);

        return array('latestProjects' => $latestProjects);
	}

    /**
     * @Template()
     */
    public function highlightedAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $project = $em->getRepository('SnowcapSiteBundle:Project')->findOneByHighlighted(true);

        return array('project' => $project);
    }
}