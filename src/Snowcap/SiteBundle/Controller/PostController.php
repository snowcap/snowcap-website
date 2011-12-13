<?php
namespace Snowcap\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Snowcap\SiteBundle\Controller\BaseController;
use Snowcap\SiteBundle\Entity\Comment;
use Snowcap\SiteBundle\Form\CommentType;

/**
 * Post controller.
 *
 * @Route("/blog")
 */
class PostController extends BaseController
{
    /**
     *
     * @Route("/", name="snwcp_site_post_list")
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $posts = $em->getRepository('SnowcapSiteBundle:Post')->getLatest(50);

        return array('posts' => $posts);
    }

    /**
     * Finds and displays a Post entity.
     *
     * @Route("/{slug}", name="snwcp_site_post_show")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SnowcapSiteBundle:Post')->findOneBySlug($slug);
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
    public function widgetAction($limit)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $latestPosts = $em->getRepository('SnowcapSiteBundle:Post')->getLatest($limit);
        return array('latestPosts' => $latestPosts);
    }

    /**
     * @Route("/comment/{slug}", name="snwcp_site_post_comment")
     * @Template()
     *
     * @param int $post_id
     * @return array
     */
    public function commentAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();

        $post = $em->getRepository('SnowcapSiteBundle:Post')->findOneBySlug($slug);

        $comment = new Comment();
        $comment->setPost($post);

        $form = $this->createForm(new CommentType(), $comment);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                // perform some action, such as saving the task to the database
                $em->persist($comment);
                $em->flush();
            }
        }


        return array('form' => $form->createView(), 'post' => $post);
    }
}