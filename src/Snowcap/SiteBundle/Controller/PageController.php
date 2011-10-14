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
 * @Route("/page")
 */
class PageController extends BaseController
{
    /**
     * Finds and displays a page entity.
     *
     * @Route("/{id}", name="front_page_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SnowcapSiteBundle:Page')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }
        return array(
            'entity' => $entity,
        );
    }

}