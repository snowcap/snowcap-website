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
     * @Route("/", name="front_projects")
     * @Template()
     */
    public function listAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $projects = $em->getRepository('SnowcapSiteBundle:Project')->findAll();
        
        return array('projects' => $projects);
    }

    /**
     * Finds and displays a Post entity.
     *
     * @Route("/{id}", name="front_project")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SnowcapSiteBundle:Project')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }
        return array(
            'entity' => $entity,
        );
    }

    /**
     * @Template()
     */
    public function LatestAction($limit)
    {
		$em = $this->getDoctrine()->getEntityManager();
        $latestProjects = $em->getRepository('SnowcapSiteBundle:Project')->getLatest($limit);
        return array('latestProjects' => $latestProjects);
	}
}