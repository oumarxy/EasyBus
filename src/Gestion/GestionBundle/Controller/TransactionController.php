<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\GestionBundle\Entity\Voyage;
use Gestion\GestionBundle\Entity\Transaction;
use Gestion\GestionBundle\Form\TransactionType;

/**
 * Transaction controller.
 *
 */
class TransactionController extends Controller {

    /**
     * Lists all Transaction entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $transactions = $em->getRepository('GestionBundle:Transaction')->findByCompagnie($this->getUser()->getCompagnie());


        return $this->render('@Gestion/transaction/index.html.twig', array(
                    'transactions' => $transactions,
        ));
    }

    /**
     * Creates a new Transaction entity.
     *
     */
    public function newAction(Request $request, Voyage $voyage, $nbrepay, $op) {
        // test de la validitié des infos
        $nbreTicket = intval($nbrepay);
        $nbredispo = $voyage->getPlacesDispo();
        $date_or_now = $voyage->getDateVoyage();
        $now = new \DateTime(date('Y-m-d'));
        if ($nbreTicket < 1 || $nbreTicket > $nbredispo ) {
            //  || $date_or_now->getTimestamp() <= $now->getTimestamp()
            $this->get('session')->getFlashBag()->add('error', 'Le nombre de places ne correspond plus.');
            return $this->redirectToRoute('voyage_result', array('jour_dpt' => $voyage->getDateVoyage()->getTimestamp(),
                        'lieuDepart' => $voyage->getLieuDepart()->getId(), 'lieuArrivee' => $voyage->getLieuArrivee()->getId()));
        }
        //fin test

        $transaction = new Transaction();
        $form = $this->createForm('Gestion\GestionBundle\Form\TransactionType', $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $transaction->getCompteVoyageur()->setCreated(new \DateTime());
            $transaction->getCreated(new \DateTime());
            $transaction->setVoyage($voyage);
            $transaction->setPlaces($nbreTicket);
            $transaction->setPu($voyage->getPrixVoyage());
            $transaction->setOperateur($op);
            $transaction->setEtat("En cours");
             if($voyage->getCompagnie()!=null){
                $transaction->setCompagnie($voyage->getCompagnie());
            }
            $em->persist($transaction);
            $em->flush();
            return $this->redirectToRoute('transaction_show', array('id' => $transaction->getId()));
        }

        return $this->render('@Gestion/transaction/new.html.twig', array(
                    'transaction' => $transaction,
                    'voyage' => $voyage,
                    'nbreTicket' => $nbreTicket,
                    'form_orange' => $form->createView(),
                    'form_mtn' => $form->createView(),
                    'form_moov' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Transaction entity.
     *
     */
    public function showAction(Transaction $transaction) {
        $deleteForm = $this->createDeleteForm($transaction);

        return $this->render('@Gestion/transaction/show.html.twig', array(
                    'transaction' => $transaction,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Transaction entity.
     *
     */
    public function editAction(Request $request, Transaction $transaction) {
        $deleteForm = $this->createDeleteForm($transaction);
        $editForm = $this->createForm('Gestion\GestionBundle\Form\TransactionType', $transaction);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($transaction);
            $em->flush();

            return $this->redirectToRoute('transaction_edit', array('id' => $transaction->getId()));
        }

        return $this->render('@Gestion/transaction/edit.html.twig', array(
                    'transaction' => $transaction,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Transaction entity.
     *
     */
    public function deleteAction(Request $request, Transaction $transaction) {
        $form = $this->createDeleteForm($transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($transaction);
            $em->flush();
        }

        return $this->redirectToRoute('transaction_index');
    }

    /**
     * Creates a form to delete a Transaction entity.
     *
     * @param Transaction $transaction The Transaction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Transaction $transaction) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('transaction_delete', array('id' => $transaction->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
