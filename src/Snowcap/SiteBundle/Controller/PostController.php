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
 * @Route("/blog")
 */
class PostController extends BaseController
{
    /**
     *
     * @Route("/", name="front_posts")
     * @Template()
     */
    public function listAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $posts = $em->getRepository('SnowcapSiteBundle:Post')->findAll();

        return array('posts' => $posts);
    }
    /**
     * Finds and displays a Post entity.
     *
     * @Route("/{id}", name="front_post")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SnowcapSiteBundle:Post')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
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
        $latestPosts = $em->getRepository('SnowcapSiteBundle:Post')->getLatest($limit);
        return array('latestPosts' => $latestPosts);
	}
}