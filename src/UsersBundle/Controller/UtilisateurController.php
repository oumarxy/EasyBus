<?php

namespace UsersBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UsersBundle\Entity\Utilisateur;
use UsersBundle\Form\UtilisateurType;
use UsersBundle\MyService\PasswordGenerator;

/**
 * Utilisateur controller.
 *
 */
class UtilisateurController extends Controller {

    /**
     * Lists all Utilisateur entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        
        $utilisateurs = $em->getRepository('UsersBundle:Utilisateur')->findByCompagnie($this->getUser()->getCompagnie());
        return $this->render('@Users/utilisateur/index.html.twig', array(
                    'utilisateurs' => $utilisateurs,
        ));
    }

    public function pdfAction() {
        $html = $this->renderView('default/test.html.twig', array());
        $html2pdf = $this->get('slik_dompdf');
        $html2pdf->getpdf($html);
        $html2pdf->stream('test.pdf');
        return new Response($html2pdf->output('recu.pdf'), 200, array('Content-Type' => 'application/pdf'));
    }


    /**
     * Creates a new Utilisateur entity.
     *
     */
    public function newAction(Request $request) {

        $utilisateur = new Utilisateur();
        $form = $this->createForm('UsersBundle\Form\UtilisateurType', $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $role = "ROLE_COMPA";
            $userManager = $this->container->get('fos_user.user_manager');
             if($this->getUser()->getCompagnie()!=null){
                $utilisateur->setCompagnie($this->getUser()->getCompagnie());
            }
            $utilisateur->addRole($role);
            $passwordGenerateur = new PasswordGenerator();
            $password = $passwordGenerateur->passwordCreate();
            $utilisateur->setPlainPassword($password); $utilisateur->setPlainPassword("1234567"); // a supprimer
            $userManager->updateUser($utilisateur);

            //envoi E-mail

            $mailer = $this->get('utilisateur_mailer');
            $mailer->userMailConfirm($utilisateur, $password);


            return $this->redirectToRoute('utilisateur_show', array('id' => $utilisateur->getId()));
        }

        return $this->render('@Users/utilisateur/new.html.twig', array(
                    'utilisateur' => $utilisateur,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Utilisateur entity.
     *
     */
    public function showAction(Utilisateur $utilisateur, Request $request) {
        $deleteForm = $this->createDeleteForm($utilisateur);
        if ($request->isMethod('post')) {
            $em = $this->getDoctrine()->getManager();
            $choixroles = $request->request->get('choixrole');
            $roleTable = array('ROLE_COMPA','ROLE_ADMIN_COMPA', 'ROLE_ADMIN');
            foreach ($roleTable as $role) {
                $utilisateur->removeRole($role);
            }
            if ($choixroles) {
                foreach ($choixroles as $choixrole) {
                    if (in_array($choixrole, $roleTable)) {
                        $utilisateur->addRole($choixrole);
                    }
                }
            }
            $em->flush();

            //die;

            return $this->redirectToRoute('utilisateur_index');
        }

        return $this->render('@Users/utilisateur/show.html.twig', array(
                    'utilisateur' => $utilisateur,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Utilisateur entity.
     *
     */
    public function editAction(Request $request, Utilisateur $utilisateur) {

        $deleteForm = $this->createDeleteForm($utilisateur);
        $editForm = $this->createForm('UsersBundle\Form\UtilisateurType', $utilisateur);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();
            return $this->redirectToRoute('utilisateur_index');
        }
        return $this->render('@Users/utilisateur/edit.html.twig', array(
                    'utilisateur' => $utilisateur,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Utilisateur entity.
     *
     */
    public function deleteAction(Request $request, Utilisateur $utilisateur) {
        $form = $this->createDeleteForm($utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($utilisateur);
            $em->flush();
        }

        return $this->redirectToRoute('utilisateur_index');
    }

    /**
     * Creates a form to delete a Utilisateur entity.
     *
     * @param Utilisateur $utilisateur The Utilisateur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Utilisateur $utilisateur) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('utilisateur_delete', array('id' => $utilisateur->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
