<?php
namespace Snowcap\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Snowcap\SiteBundle\Controller\BaseController;

/**
 * Post controller.
 *
 * @Route("/blog")
 */
class PostController extends BaseController
{
    /**
     * @Route("/feed.rss", name="snwcp_site_post_feed", defaults={"_format"="rss"})
     * @Template()
     * @return array
     */
    public function feedAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $posts = $em->getRepository('SnowcapSiteBundle:Post')->getLatest(10);

        return array('posts' => $posts);
    }

    /**
     *
     * @Route("/{category_slug}", name="snwcp_site_post_list", defaults={"category_slug"=null})
     * @Template()
     */
    public function listAction($category_slug = null)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $posts = $em->getRepository('SnowcapSiteBundle:Post')->getLatest(50, $category_slug);
        return array(
            'posts' => $posts,
            'current_category' => $category_slug
        );
    }

    /**
     * Finds and displays a Post entity.
     *
     * @Route("/post/{slug}", name="snwcp_site_post_show")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $post = $em->getRepository('SnowcapSiteBundle:Post')->findOneBySlug($slug);
        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        return array('post' => $post);
    }

    /**
     * @Template()
     */
    public function widgetAction($limit)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $latestPosts = $em->getRepository('SnowcapSiteBundle:Post')->getLatest($limit);

        return array('latestPosts' => $latestPosts);
    }
}