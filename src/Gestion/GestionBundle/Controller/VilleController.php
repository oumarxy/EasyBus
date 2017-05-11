<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\GestionBundle\Entity\Ville;
use Gestion\GestionBundle\Form\VilleType;

/**
 * Ville controller.
 *
 */
class VilleController extends Controller {

    /**
     * Lists all Ville entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $villes = $em->getRepository('GestionBundle:Ville')->findByCompagnie($this->getUser()->getCompagnie());

        $gares = $em->getRepository('GestionBundle:Gare')->findByCompagnie($this->getUser()->getCompagnie());

        return $this->render('@Gestion/ville_gare_index.html.twig', array(
                    'gares' => $gares,
                    'villes' => $villes,
        ));
    }

    /**
     * Creates a new Ville entity.
     *
     */
    public function newAction(Request $request) {
        $ville = new Ville();
        $form = $this->createForm('Gestion\GestionBundle\Form\VilleType', $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($this->getUser()->getCompagnie()!=null){
                $conducteur->setCompagnie($this->getUser()->getCompagnie());
            }
            $em->persist($ville);
            $em->flush();

            return $this->redirectToRoute('ville_show', array('id' => $ville->getId()));
        }

        return $this->render('@Gestion/ville/new.html.twig', array(
                    'ville' => $ville,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Ville entity.
     *
     */
    public function showAction(Ville $ville) {
        $deleteForm = $this->createDeleteForm($ville);

        return $this->render('@Gestion/ville/show.html.twig', array(
                    'ville' => $ville,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ville entity.
     *
     */
    public function editAction(Request $request, Ville $ville) {
        $deleteForm = $this->createDeleteForm($ville);
        $editForm = $this->createForm('Gestion\GestionBundle\Form\VilleType', $ville);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();

            return $this->redirectToRoute('ville_show', array('id' => $ville->getId()));
        }

        return $this->render('@Gestion/ville/edit.html.twig', array(
                    'ville' => $ville,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Ville entity.
     *
     */
    public function deleteAction(Request $request, Ville $ville) {
        $form = $this->createDeleteForm($ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ville);
            $em->flush();
        }

        return $this->redirectToRoute('ville_index');
    }

    /**
     * Creates a form to delete a Ville entity.
     *
     * @param Ville $ville The Ville entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ville $ville) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('ville_delete', array('id' => $ville->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
