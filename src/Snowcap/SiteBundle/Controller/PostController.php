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

        $post_result = null;

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $akismet = $this->container->get('ornicar_akismet');

                $logger = $this->get('logger');
                $logger->debug('Akismet call client IP used : ' . $this->getRequest()->getClientIp(true));

                try {
                    $isSpam = $akismet->isSpam(array(
                        'comment_author'  => $comment->getName(),
                        'comment_author_email' => $comment->getEmail(),
                        'comment_content' => $comment->getBody(),
                        'user_ip' => $this->getRequest()->getClientIp(true),
                    ));
                } catch(\Exception $e) {
                    $isSpam = null;
                }

                if($isSpam === true) {
                    $comment->setPublished(0);
                    $post_result = "blog.comments.result.unpublished";
                } else {
                    $post_result = "blog.comments.result.published";
                }

                $em->persist($comment);
                $em->flush();
                if (!$isSpam) {
                    $message = \Swift_Message::newInstance()
                            ->setSubject('New comment on a Snowcap post')
                            ->setFrom('website@snowcap.be','Snowcap ' . $this->get('kernel')->getEnvironment() .  ' website')
                            ->setTo($this->container->getParameter('mailer_to'))
                            ->setBody($this->renderView('SnowcapSiteBundle:Email:newcomment.txt.twig', array('comment' => $comment, 'isSpam' => $isSpam)))
                            ->addPart($this->renderView('SnowcapSiteBundle:Email:newcomment.html.twig', array('comment' => $comment, 'isSpam' => $isSpam)), 'text/html')
                        ;
                    try {
                        $this->get('mailer')->send($message);
                    }
                    catch(\Exception $e){}
                }

            }
        }

        return array('form' => $form->createView(), 'post' => $post, 'post_result' => $post_result);
    }


}