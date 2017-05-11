<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\GestionBundle\Entity\Voyageur;
use Gestion\GestionBundle\Form\VoyageurType;

/**
 * Voyageur controller.
 *
 */
class VoyageurController extends Controller
{
    /**
     * Lists all Voyageur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $voyageurs = $em->getRepository('GestionBundle:Voyageur')->findByCompagnie($this->getUser()->getCompagnie());


        return $this->render('@Gestion/voyageur/index.html.twig', array(
            'voyageurs' => $voyageurs,
        ));
    }

    /**
     * Creates a new Voyageur entity.
     *
     */
    public function newAction(Request $request)
    {
        $voyageur = new Voyageur();
        $form = $this->createForm('Gestion\GestionBundle\Form\VoyageurType', $voyageur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($this->getUser()->getCompagnie()!=null){
                $conducteur->setCompagnie($this->getUser()->getCompagnie());
            }
            $em->persist($voyageur);
            $em->flush();

            return $this->redirectToRoute('voyageur_show', array('id' => $voyageur->getId()));
        }

        return $this->render('@Gestion/voyageur/new.html.twig', array(
            'voyageur' => $voyageur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Voyageur entity.
     *
     */
    public function showAction(Voyageur $voyageur)
    {
        $deleteForm = $this->createDeleteForm($voyageur);

        return $this->render('@Gestion/voyageur/show.html.twig', array(
            'voyageur' => $voyageur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Voyageur entity.
     *
     */
    public function editAction(Request $request, Voyageur $voyageur)
    {
        $deleteForm = $this->createDeleteForm($voyageur);
        $editForm = $this->createForm('Gestion\GestionBundle\Form\VoyageurType', $voyageur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($voyageur);
            $em->flush();

            return $this->redirectToRoute('voyageur_edit', array('id' => $voyageur->getId()));
        }

        return $this->render('@Gestion/voyageur/edit.html.twig', array(
            'voyageur' => $voyageur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Voyageur entity.
     *
     */
    public function deleteAction(Request $request, Voyageur $voyageur)
    {
        $form = $this->createDeleteForm($voyageur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($voyageur);
            $em->flush();
        }

        return $this->redirectToRoute('voyageur_index');
    }

    /**
     * Creates a form to delete a Voyageur entity.
     *
     * @param Voyageur $voyageur The Voyageur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Voyageur $voyageur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('voyageur_delete', array('id' => $voyageur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
