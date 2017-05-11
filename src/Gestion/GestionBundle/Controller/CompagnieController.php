<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\GestionBundle\Entity\Compagnie;
use Gestion\GestionBundle\Form\CompagnieType;

/**
 * Compagnie controller.
 *
 */
class CompagnieController extends Controller
{
    /**
     * Lists all Compagnie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $compagnies = $em->getRepository('GestionBundle:Compagnie')->findAll();

        return $this->render('compagnie/index.html.twig', array(
            'compagnies' => $compagnies,
        ));
    }

    /**
     * Creates a new Compagnie entity.
     *
     */
    public function newAction(Request $request)
    {
        $compagnie = new Compagnie();
        $form = $this->createForm('Gestion\GestionBundle\Form\CompagnieType', $compagnie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($compagnie);
            $em->flush();

            return $this->redirectToRoute('compagnie_show', array('id' => $compagnie->getId()));
        }

        return $this->render('compagnie/new.html.twig', array(
            'compagnie' => $compagnie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Compagnie entity.
     *
     */
    public function showAction(Compagnie $compagnie)
    {
        $deleteForm = $this->createDeleteForm($compagnie);

        return $this->render('compagnie/show.html.twig', array(
            'compagnie' => $compagnie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Compagnie entity.
     *
     */
    public function editAction(Request $request, Compagnie $compagnie)
    {
        $deleteForm = $this->createDeleteForm($compagnie);
        $editForm = $this->createForm('Gestion\GestionBundle\Form\CompagnieType', $compagnie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($compagnie);
            $em->flush();

            return $this->redirectToRoute('compagnie_edit', array('id' => $compagnie->getId()));
        }

        return $this->render('compagnie/edit.html.twig', array(
            'compagnie' => $compagnie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Compagnie entity.
     *
     */
    public function deleteAction(Request $request, Compagnie $compagnie)
    {
        $form = $this->createDeleteForm($compagnie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($compagnie);
            $em->flush();
        }

        return $this->redirectToRoute('compagnie_index');
    }

    /**
     * Creates a form to delete a Compagnie entity.
     *
     * @param Compagnie $compagnie The Compagnie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Compagnie $compagnie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('compagnie_delete', array('id' => $compagnie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
