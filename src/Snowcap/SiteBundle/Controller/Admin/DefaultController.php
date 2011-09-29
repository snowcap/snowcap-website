<?php

namespace Snowcap\SiteBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

use Snowcap\SiteBundle\Controller\BaseController;
class DefaultController extends BaseController
{
    /**
     * @Route("", name="admin_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

	/**
	 * @Route("/markdown", name="markdown")
	 */
	public function markdownAction()
	{
		$content = $this->getRequest()->request->get("content");
		$result = $this->container->get('markdown.parser')->transform($content);
		return new Response($result);
	}

}
