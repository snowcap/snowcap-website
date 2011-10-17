<?php
namespace Snowcap\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Snowcap\AdminBundle\Admin\Content as ContentAdmin;
use Snowcap\AdminBundle\Form\ContentType;

/**
 * This controller provides basic CRUD capabilities for content models
 *
 */
class ContentController extends Controller
{
    /**
     * Content homepage (listing)
     *
     * @Route("content/{type}", name="content")
     * @Template()
     *
     * @param string $type
     * @return mixed
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
     * Create a new content entity
     *
     * @Route("/content/{type}/create", name="content_create")
     * @Template("SnowcapAdminBundle:Content:create.html.twig")
     *
     * @param string $type
     * @return mixed
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
                return $this->redirect($this->generateUrl('content', array('type' => $type)));
            }
        }
        return array(
            'admin' => $admin,
            'type' => $type,
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Update an existing content entity
     *
     * @Route("/content/{type}/update/{id}", name="content_update")
     * @Template("SnowcapAdminBundle:Content:update.html.twig")
     *
     * @param string $type
     * @param int $id
     * @return mixed
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
                return $this->redirect($this->generateUrl('content', array('type' => $type)));
            }
        }
        return array(
            'admin' => $admin,
            'type' => $type,
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Deletes a content entity.
     *
     * @Route("/content/{type}/delete/{id}", name="content_delete")
     *
     * @param string $type
     * @param int $id
     * @return mixed
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

    /**
     * Find an entity managed by the provided admin class
     *
     * @throws \Symfony\Bundle\FrameworkBundle\Controller\NotFoundHttpException
     * @param int $id
     * @param \Snowcap\AdminBundle\Admin\Content $admin
     * @return \Object
     */
    private function findEntity($id, ContentAdmin $admin)
    {
        $entity = $this->get('doctrine')->getEntityManager()->getRepository($admin->getEntityName())->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find content entity.');
        }
        return $entity;
    }
}