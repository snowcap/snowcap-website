<?php

namespace Snowcap\SiteBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Snowcap\SiteBundle\Controller\BaseController;
use Snowcap\SiteBundle\Entity\Post;
use Snowcap\SiteBundle\Form\PostType;

class PostController extends BaseController
{	
	public function init()
    {
        
    }
    /**
     * Post management
     *
     * @Route("/posts", name="admin_posts")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository('SnowcapSiteBundle:Post')->findAll();
        return array('entities' => $entities);
    }
	
	/**
     * Finds and displays a Post entity.
     *
     * @Route("/posts/show/{id}", name="admin_posts_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SnowcapSiteBundle:Post')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }
	
	/**
     * Displays a form to create a new Post entity.
     *
     * @Route("/posts/new", name="admin_posts_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Post();
        $form = $this->createForm(new PostType(), $entity);
        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }
	
	/**
     * Creates a new Post entity.
     *
     * @Route("/posts/create", name="admin_posts_create")
     * @Method("post")
     * @Template("SnowcapSiteBundle:Admin/Post:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Post();
        $request = $this->getRequest();
        $form    = $this->createForm(new PostType(), $entity);
        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('admin_posts_show', array('id' => $entity->getId())));
            }
        }
        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }
	
	/**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/posts/edit/{id}", name="admin_posts_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SnowcapSiteBundle:Post')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        $editForm = $this->createForm(new PostType(), $entity);
        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        );
    }
	
	/**
     * Edits an existing Post entity.
     *
     * @Route("/posts/update/{id}", name="admin_posts_update")
     * @Method("post")
     * @Template("SnowcapSiteBundle:Admin:Post:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SnowcapSiteBundle:Post')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        $editForm   = $this->createForm(new PostType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $request = $this->getRequest();
        if ('POST' === $request->getMethod()) {
            $editForm->bindRequest($request);
            if ($editForm->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('admin_posts_show', array('id' => $id)));
            }
        }
        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
	
	/**
     * Deletes a Post entity.
     *
     * @Route("/posts/delete/{id}", name="admin_posts_delete")
     * @Method("get")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SnowcapSiteBundle:Post')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        $em->remove($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_posts'));
    }

	private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
	