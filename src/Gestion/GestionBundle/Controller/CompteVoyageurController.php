<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\GestionBundle\Entity\CompteVoyageur;
use Gestion\GestionBundle\Form\CompteVoyageurType;

/**
 * CompteVoyageur controller.
 *
 */
class CompteVoyageurController extends Controller
{
    /**
     * Lists all CompteVoyageur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $compteVoyageurs = $em->getRepository('GestionBundle:CompteVoyageur')->findByCompagnie($this->getUser()->getCompagnie());

        return $this->render('@Gestion/comptevoyageur/index.html.twig', array(
            'compteVoyageurs' => $compteVoyageurs,
        ));
    }

    /**
     * Creates a new CompteVoyageur entity.
     *
     */
    public function newAction(Request $request)
    {
        $compteVoyageur = new CompteVoyageur();
        $form = $this->createForm('Gestion\GestionBundle\Form\CompteVoyageurType', $compteVoyageur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($this->getUser()->getCompagnie()!=null){
                $compteVoyageur->setCompagnie($this->getUser()->getCompagnie());
            }
            $em->persist($compteVoyageur);
            $em->flush();

            return $this->redirectToRoute('comptevoyageur_show', array('id' => $compteVoyageur->getId()));
        }

        return $this->render('@Gestion/comptevoyageur/new.html.twig', array(
            'compteVoyageur' => $compteVoyageur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CompteVoyageur entity.
     *
     */
    public function showAction(CompteVoyageur $compteVoyageur)
    {
        $deleteForm = $this->createDeleteForm($compteVoyageur);

        return $this->render('@Gestion/comptevoyageur/show.html.twig', array(
            'compteVoyageur' => $compteVoyageur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CompteVoyageur entity.
     *
     */
    public function editAction(Request $request, CompteVoyageur $compteVoyageur)
    {
        $deleteForm = $this->createDeleteForm($compteVoyageur);
        $editForm = $this->createForm('Gestion\GestionBundle\Form\CompteVoyageurType', $compteVoyageur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($compteVoyageur);
            $em->flush();

            return $this->redirectToRoute('comptevoyageur_edit', array('id' => $compteVoyageur->getId()));
        }

        return $this->render('@Gestion/comptevoyageur/edit.html.twig', array(
            'compteVoyageur' => $compteVoyageur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CompteVoyageur entity.
     *
     */
    public function deleteAction(Request $request, CompteVoyageur $compteVoyageur)
    {
        $form = $this->createDeleteForm($compteVoyageur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($compteVoyageur);
            $em->flush();
        }

        return $this->redirectToRoute('comptevoyageur_index');
    }

    /**
     * Creates a form to delete a CompteVoyageur entity.
     *
     * @param CompteVoyageur $compteVoyageur The CompteVoyageur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CompteVoyageur $compteVoyageur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comptevoyageur_delete', array('id' => $compteVoyageur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
