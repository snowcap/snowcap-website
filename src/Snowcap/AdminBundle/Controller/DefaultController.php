<?php
namespace Snowcap\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Symfony\Component\HttpFoundation\Response;

/**
 * The default admin controller is used as a dashboard for
 * admin users, and provides a few utilities methods for interface purposes
 * 
 */
class DefaultController extends Controller
{
    /**
     * Admin default action
     *
     * @Route("")
     * @Template()
     *
     * @return mixed
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * Get the navigation for content management
     * 
     * @Template()
     *
     * @return mixed
     */
    public function navigationAction() {
        $navigation = $this->get('snowcap_admin')->getNavigation();
        return array('navigation' => $navigation);
    }

    /**
     * @Route("/markdown", name="markdown")
     * @return Response
     */
    public function markdownAction() {
		$content = $this->getRequest()->request->get("content");
		$result = $this->container->get('markdown.parser')->transform($content);
		return new Response($result);
    }

}
