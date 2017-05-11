<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\GestionBundle\Entity\Voyage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Gestion\GestionBundle\Form\VoyageType;

/**
 * Voyage controller.
 *
 */
class VoyageController extends Controller {

    /**
     * Lists all Voyage entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $voyages = $em->getRepository('GestionBundle:Voyage')->findByCompagnie($this->getUser()->getCompagnie());


        return $this->render('@Gestion/voyage/index.html.twig', array(
                    'voyages' => $voyages,
        ));
    }

    /**
     * Creates a new Voyage entity.
     *
     */
    public function newAction(Request $request) {
        $voyage = new Voyage();
        $form = $this->createForm('Gestion\GestionBundle\Form\VoyageType', $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $created = new \DateTime(date('Y-m-d'));
            $voyage->setCreated($created);
            if($this->getUser()->getCompagnie()!=null){
                $conducteur->setCompagnie($this->getUser()->getCompagnie());
            }
            $em->persist($voyage);
            $em->flush();

            return $this->redirectToRoute('voyage_show', array('id' => $voyage->getId()));
        }

        return $this->render('@Gestion/voyage/new.html.twig', array(
                    'voyage' => $voyage,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Voyage entity.
     *
     */
    public function showAction(Request $request, Voyage $voyage) {
        $deleteForm = $this->createDeleteForm($voyage);

        return $this->render('@Gestion/voyage/show.html.twig', array(
                    'voyage' => $voyage,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    public function showajaxAction(Request $request, Voyage $voyage) {

        if ($request->isXmlHttpRequest()) {
            $response = new JsonResponse();
            $em = $this->getDoctrine()->getManager();
            //$voyage = $em->getRepository('GestionBundle:Voyage')->find($id);
            $voyageJ = array(); //Tableau pour le Return Json

            if ($voyage) {
                $voyageJ['places'] = $voyage->getPlacesDispo();
                $voyageJ['pu'] = $voyage->getPrixVoyage();
            } else {
                $voyageJ['places'] = "Voyage invalide";
            }
            return $response->setData($voyageJ);
        }

        return null;
    }

    /**
     * recherche sur voyage en fonction des param ci-dessous
     * @param \DateTime $jour_dpt
     * @param type $passager
     * @param type $lieuDepart
     * @param type $lieuArrivee
     * @return type
     */
    public function resultAction($jour_dpt, $lieuDepart, $lieuArrivee) {
        $state = 0; //Fail
        $form = $this->rechercheForm();
        $em = $this->getDoctrine()->getManager();
        $now = new \DateTime(date('Y-m-d'));
        $date_or_now = new \DateTime(date('Y-m-d', intval($jour_dpt)));
        $lieuArriveeid = intval($lieuArrivee);
        $lieuDepartid = intval($lieuDepart);
        $voyages = null;
        $depart = $em->getRepository('GestionBundle:Ville')->find($lieuDepartid);
        $arrivee = $em->getRepository('GestionBundle:Ville')->find($lieuArriveeid);

        if ($depart && $arrivee && $date_or_now && $date_or_now->getTimestamp() >= $now->getTimestamp()) {
            $voyages = $em->getRepository('GestionBundle:Voyage')->findBy(
                    array('lieuDepart' => $depart, 'lieuArrivee' => $arrivee, 'dateVoyage' => $date_or_now), array('heureDepart' => 'DESC'));
            if (count($voyages) >= 1) {
                $state = 1;
            }
        }
        if ($depart && $arrivee && count($voyages) < 1) {
            $voyages = $em->getRepository('GestionBundle:Voyage')->findBy(
                    array('lieuDepart' => $depart, 'lieuArrivee' => $arrivee, 'dateVoyage' => $now), array('heureDepart' => 'DESC'));
        }
        if ($depart && count($voyages) < 1) {
            $voyages = $em->getRepository('GestionBundle:Voyage')->findBy(
                    array('lieuDepart' => $depart, 'dateVoyage' => $now), array('heureDepart' => 'DESC'));
        }

        //Affichage de tous les voyages actuel
        if (count($voyages) < 1) {
            $voyages = $em->getRepository('GestionBundle:Voyage')->findBy(
                    array('dateVoyage' => $now), array('heureDepart' => 'DESC'));

            //For Test Mode
            if (count($voyages) < 1) {
                $state = 3;
                $voyages = $em->getRepository('GestionBundle:Voyage')->findAll();
            }
        }
        if ($state == 1) {
            $this->get('session')->getFlashBag()->add('info', 'Les résultats trouvés');
        } elseif ($state == 3) {
            $this->get('session')->getFlashBag()->add('info', 'Mode Test');
        }
        return $this->render('@Gestion/voyage/liste_voyage.html.twig', array(
                    'voyages' => $voyages,
                    'depart' => $depart,
                    'arrivee' => $arrivee,
                    'rechercheForm' => $form->createView(),
                    'state' => $state,
        ));
    }

    private function rechercheForm() {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('gestion_home_recherche'))
                        ->setMethod('POST')
                        ->add('lieuDepart', EntityType::class, array(
                            'class' => 'GestionBundle:Ville',
                        ))
                        ->add('lieuArrivee', EntityType::class, array(
                            'class' => 'GestionBundle:Ville',
                        ))
                        ->add('jourdepart')
                        ->getForm()
        ;
    }

    /**
     * Displays a form to edit an existing Voyage entity.
     *
     */
    public function editAction(Request $request, Voyage $voyage) {
        $deleteForm = $this->createDeleteForm($voyage);
        $editForm = $this->createForm('Gestion\GestionBundle\Form\VoyageType', $voyage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($voyage);
            $em->flush();

            return $this->redirectToRoute('voyage_show', array('id' => $voyage->getId()));
        }


        return $this->render('@Gestion/voyage/edit.html.twig', array(
                    'voyage' => $voyage,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Voyage entity.
     *
     */
    public function deleteAction(Request $request, Voyage $voyage) {
        $form = $this->createDeleteForm($voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($voyage);
            $em->flush();
        }

        return $this->redirectToRoute('voyage_index');
    }

    /**
     * Creates a form to delete a Voyage entity.
     *
     * @param Voyage $voyage The Voyage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Voyage $voyage) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('voyage_delete', array('id' => $voyage->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
