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
     * @Route("/", name="snwcp_site_project_index")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $project = $em->getRepository('SnowcapSiteBundle:Project')->findOneBy(array(
            'highlighted' => true,
            'published' => true
        ));
        return array('project' => $project);
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
    public function listAction($limit = 1000, $highlighted = null, $availableOnList = true)
    {
		$em = $this->getDoctrine()->getEntityManager();
        $projects = $em->getRepository('SnowcapSiteBundle:Project')->getList($limit, $highlighted, $availableOnList);
        return array(
            'projects' => $projects,
            'format'=> 'thumb'
        );
	}
}