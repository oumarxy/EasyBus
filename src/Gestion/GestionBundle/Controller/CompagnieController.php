<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\GestionBundle\Entity\Compagnie;
use Gestion\GestionBundle\Form\CompagnieType;
use UsersBundle\Entity\Utilisateur;
use UsersBundle\Form\UtilisateurGerantType;
use UsersBundle\MyService\PasswordGenerator;

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
     public function gerantAction(Request $request) {

        $utilisateur = new Utilisateur();
        $form = $this->createForm('UsersBundle\Form\UtilisateurGerantType', $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $role1 = "ROLE_COMPA";
            $role2 = "ROLE_ADMIN_COMPA";
            $userManager = $this->container->get('fos_user.user_manager');

            $utilisateur->addRole($role1);
            $utilisateur->addRole($role2);
            $passwordGenerateur = new PasswordGenerator();
            $password = $passwordGenerateur->passwordCreate();
            $utilisateur->setPlainPassword($password); $utilisateur->setPlainPassword("1234567"); // a supprimer
            $userManager->updateUser($utilisateur);

            //envoi E-mail
            $mailer = $this->get('utilisateur_mailer');
            $mailer->userMailConfirm($utilisateur, $password);


            return $this->redirectToRoute('utilisateur_show', array('id' => $utilisateur->getId()));
        }

        return $this->render('@Gestion/gerant/new.html.twig', array(
                    'utilisateur' => $utilisateur,
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
