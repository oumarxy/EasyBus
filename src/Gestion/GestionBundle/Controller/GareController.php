<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\GestionBundle\Entity\Gare;
use Gestion\GestionBundle\Form\GareType;

/**
 * Gare controller.
 *
 */
class GareController extends Controller
{
    /**
     * Lists all Gare entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villes = $em->getRepository('GestionBundle:Ville')->findByCompagnie($this->getUser()->getCompagnie());

        $gares = $em->getRepository('GestionBundle:Gare')->findByCompagnie($this->getUser()->getCompagnie());

        return $this->render('@Gestion/ville_gare_index.html.twig', array(
            'gares' => $gares,
            'villes' => $villes,
        ));
    }

    /**
     * Creates a new Gare entity.
     *
     */
    public function newAction(Request $request)
    {
        $gare = new Gare();
        $form = $this->createForm('Gestion\GestionBundle\Form\GareType', $gare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($this->getUser()->getCompagnie()!=null){
                $gare->setCompagnie($this->getUser()->getCompagnie());
            }
            $em->persist($gare);
            $em->flush();

            return $this->redirectToRoute('gare_show', array('id' => $gare->getId()));
        }

        return $this->render('@Gestion/gare/new.html.twig', array(
            'gare' => $gare,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Gare entity.
     *
     */
    public function showAction(Gare $gare)
    {
        $deleteForm = $this->createDeleteForm($gare);

        return $this->render('@Gestion/gare/show.html.twig', array(
            'gare' => $gare,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Gare entity.
     *
     */
    public function editAction(Request $request, Gare $gare)
    {
        $deleteForm = $this->createDeleteForm($gare);
        $editForm = $this->createForm('Gestion\GestionBundle\Form\GareType', $gare);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gare);
            $em->flush();

            return $this->redirectToRoute('gare_show', array('id' => $gare->getId()));
        }

        return $this->render('@Gestion/gare/edit.html.twig', array(
            'gare' => $gare,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Gare entity.
     *
     */
    public function deleteAction(Request $request, Gare $gare)
    {
        $form = $this->createDeleteForm($gare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gare);
            $em->flush();
        }

        return $this->redirectToRoute('gare_index');
    }

    /**
     * Creates a form to delete a Gare entity.
     *
     * @param Gare $gare The Gare entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Gare $gare)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gare_delete', array('id' => $gare->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
