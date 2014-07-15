<?php

namespace Schmechel\WebsiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Schmechel\WebsiteBundle\Entity\SkillCategory;
use Schmechel\WebsiteBundle\Form\SkillCategoryType;

/**
 * SkillCategory controller.
 *
 * @Route("admin/skillcategory")
 */
class SkillCategoryController extends Controller
{

    /**
     * Lists all SkillCategory entities.
     *
     * @Route("/", name="skillcategory")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SchmechelWebsiteBundle:SkillCategory')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new SkillCategory entity.
     *
     * @Route("/", name="skillcategory_create")
     * @Method("POST")
     * @Template("SchmechelWebsiteBundle:SkillCategory:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new SkillCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('skillcategory_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a SkillCategory entity.
     *
     * @param SkillCategory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkillCategory $entity)
    {
        $form = $this->createForm(new SkillCategoryType(), $entity, array(
            'action' => $this->generateUrl('skillcategory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkillCategory entity.
     *
     * @Route("/new", name="skillcategory_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SkillCategory();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a SkillCategory entity.
     *
     * @Route("/{id}", name="skillcategory_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SchmechelWebsiteBundle:SkillCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkillCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SkillCategory entity.
     *
     * @Route("/{id}/edit", name="skillcategory_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SchmechelWebsiteBundle:SkillCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkillCategory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a SkillCategory entity.
    *
    * @param SkillCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkillCategory $entity)
    {
        $form = $this->createForm(new SkillCategoryType(), $entity, array(
            'action' => $this->generateUrl('skillcategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkillCategory entity.
     *
     * @Route("/{id}", name="skillcategory_update")
     * @Method("PUT")
     * @Template("SchmechelWebsiteBundle:SkillCategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SchmechelWebsiteBundle:SkillCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkillCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('skillcategory_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a SkillCategory entity.
     *
     * @Route("/{id}", name="skillcategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SchmechelWebsiteBundle:SkillCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkillCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('skillcategory'));
    }

    /**
     * Creates a form to delete a SkillCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('skillcategory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
