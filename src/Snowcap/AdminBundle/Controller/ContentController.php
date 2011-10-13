<?php

namespace Snowcap\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Snowcap\AdminBundle\Admin\Content as ContentAdmin;
use Snowcap\AdminBundle\Form\ContentType;

class ContentController extends Controller {
    /**
     * @Route("content/{type}", name="content")
     * @Template()
     */
    public function indexAction($type)
    {
        $admin = $this->get('snowcap_admin')->getAdmin($type);
        $em = $this->get('doctrine')->getEntityManager();
        $entities = $em->getRepository($admin->getEntityName())->findAll();
        return array(
            'admin' => $admin,
            'entities' => $entities,
            'type' => $type,
        );
    }

    /**
     * Finds and displays a content entity.
     *
     * @Route("/content/{type}/show/{id}", name="content_show")
     * @Template()
     */
    public function showAction($type, $id)
    {
        $admin = $this->get('snowcap_admin')->getAdmin($type);
        $entity = $this->findEntity($id, $admin);
        return array(
            'entity' => $entity,
            'type' => $type,
        );
    }

    /**
     * Creates a new content entity.
     *
     * @Route("/content/{type}/create", name="content_create")
     * @Template("SnowcapAdminBundle:Content:create.html.twig")
     */
    public function createAction($type)
    {
        $admin = $this->get('snowcap_admin')->getAdmin($type);
        $em = $this->get('doctrine')->getEntityManager();
        $entityName = $admin->getEntityName();
        $entity = new $entityName();
        $request = $this->get('request');
        $form = $this->createForm(new ContentType($type, $admin), $entity);
        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('content_show', array('type' => $type, 'id' => $entity->getId())));
            }
        }
        return array(
            'content_name' => $admin->getContentName(),
            'type' => $type,
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Updates an existing content entity.
     *
     * @Route("/content/{type}/update/{id}", name="content_update")
     * @Template("SnowcapAdminBundle:Content:update.html.twig")
     */
    public function updateAction($type, $id)
    {
        $admin = $this->get('snowcap_admin')->getAdmin($type);
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $this->findEntity($id, $admin);
        $metaData = $em->getClassMetaData($admin->getEntityName());
        $request = $this->get('request');
        $form = $this->createForm(new ContentType($type, $admin), $entity);
        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('content_show', array('type' => $type, 'id' => $id)));
            }
        }
        return array(
            'content_name' => $admin->getContentName(),
            'type' => $type,
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Deletes a content entity.
     *
     * @Route("/content/{type}/delete/{id}", name="content_delete")
     */
    public function deleteAction($type, $id)
    {
        $admin = $this->get('snowcap_admin')->getAdmin($type);
        $entity = $this->findEntity($id, $admin);
        $em = $this->get('doctrine')->getEntityManager();
        $em->remove($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('content', array('type' => $type)));
    }

    private function findEntity($id, ContentAdmin $admin)
    {
        $entity = $this->get('doctrine')->getEntityManager()->getRepository($admin->getEntityName())->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find content entity.');
        }
        return $entity;
    }
}