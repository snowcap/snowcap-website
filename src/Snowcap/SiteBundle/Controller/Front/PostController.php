<?php
namespace Snowcap\SiteBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Snowcap\SiteBundle\Entity\Post;

/**
 * Post controller.
 *
 * @Route("/post")
 */
class PostController extends Controller
{
    /**
     * Finds and displays a Post entity.
     *
     * @Route("/post/{id}", name="front_posts_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SnowcapSiteBundle:Post')->find($id);
        if (!$entity){
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        return array(
            'entity' => $entity,
        );
    }
}