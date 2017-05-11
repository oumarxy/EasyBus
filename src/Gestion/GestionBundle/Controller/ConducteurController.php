<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\GestionBundle\Entity\Conducteur;
use Gestion\GestionBundle\Form\ConducteurType;

/**
 * Conducteur controller.
 *
 */
class ConducteurController extends Controller
{
    /**
     * Lists all Conducteur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $conducteurs = $em->getRepository('GestionBundle:Conducteur')->findByCompagnie($this->getUser()->getCompagnie());

        $vehicules = $em->getRepository('GestionBundle:Vehicule')->findByCompagnie($this->getUser()->getCompagnie());


        return $this->render('@Gestion/conduct_vehicul_index.html.twig', array(
            'conducteurs' => $conducteurs,
            'vehicules'=>$vehicules
        ));
    }

    /**
     * Creates a new Conducteur entity.
     *
     */
    public function newAction(Request $request)
    {
        $conducteur = new Conducteur();
        $form = $this->createForm('Gestion\GestionBundle\Form\ConducteurType', $conducteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $conducteur->setCreated(new \DateTime(date("Y-m-d H:i:s")));
            if($this->getUser()->getCompagnie()!=null){
                $conducteur->setCompagnie($this->getUser()->getCompagnie());
            }
            $em->persist($conducteur);
            $em->flush();

            return $this->redirectToRoute('conducteur_show', array('id' => $conducteur->getId()));
        }

        return $this->render('@Gestion/conducteur/new.html.twig', array(
            'conducteur' => $conducteur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Conducteur entity.
     *
     */
    public function showAction(Conducteur $conducteur)
    {
        $deleteForm = $this->createDeleteForm($conducteur);

        return $this->render('@Gestion/conducteur/show.html.twig', array(
            'conducteur' => $conducteur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Conducteur entity.
     *
     */
    public function editAction(Request $request, Conducteur $conducteur)
    {
        $deleteForm = $this->createDeleteForm($conducteur);
        $editForm = $this->createForm('Gestion\GestionBundle\Form\ConducteurType', $conducteur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($conducteur);
            $em->flush();

            return $this->redirectToRoute('conducteur_show', array('id' => $conducteur->getId()));
        }

        return $this->render('@Gestion/conducteur/edit.html.twig', array(
            'conducteur' => $conducteur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Conducteur entity.
     *
     */
    public function deleteAction(Request $request, Conducteur $conducteur)
    {
        $form = $this->createDeleteForm($conducteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($conducteur);
            $em->flush();
        }

        return $this->redirectToRoute('conducteur_index');
    }

    /**
     * Creates a form to delete a Conducteur entity.
     *
     * @param Conducteur $conducteur The Conducteur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Conducteur $conducteur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('conducteur_delete', array('id' => $conducteur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
