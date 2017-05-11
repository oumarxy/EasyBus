<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Home controller.
 *
 */
class HomeController extends Controller {

    /**
     * Home
     *
     */
    public function indexAction() {
        $form = $this->rechercheForm();
        return $this->render('@Gestion/home/index.html.twig', array(
                    'rechercheForm' => $form->createView(),
        ));
    }

     /**
     * page
     *
     */
    public function pageAction($page) {
        
        return $this->render('@Gestion/pages/page.html.twig', array(
                    'page' => $page,
        ));
    }


    /**
     * Admin
     *
     */
    public function homeAdminAction() {
        //$date = new \DateTime("Y-m-d");
        // $transDay = $em->getRepository('GestionBundle:Transaction')->findBy(array("compagnie"=> $this->getUser()->getCompagnie(), created=>$date));
        //var_dump($date);
        // $transMonth = $em->getRepository('GestionBundle:Transaction')->findByCompagnie($this->getUser()->getCompagnie());

        return $this->render('@Gestion/home/admin.html.twig');
    }

    /**
     * 
     * @param rien pr le moment 
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function rechercheForm() {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('gestion_home_recherche'))
                        ->setMethod('POST')
                        ->add('lieuDepart', EntityType::class, array(
                            'label' => 'Départ',
                            'class' => 'GestionBundle:Ville',
                        ))
                        ->add('lieuArrivee', EntityType::class, array(
                            'label' => 'Arrivée',
                            'class' => 'GestionBundle:Ville',
                        ))
                        ->add('jourdepart', null, array(
                            'label' => 'Date de départ',
                        ))
                        ->getForm()
        ;
    }

    /**
     * Creates a recherche.
     *
     */
    public function rechercheAction(Request $request) {
        $form = $this->rechercheForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $jour_dpt = new \DateTime(date('Y-m-d'));
            $lieuDepart = $form->getData()["lieuDepart"]->getId();
            $lieuArrivee = $form->getData()["lieuArrivee"]->getId();
            $jourdepart = $form->getData()["jourdepart"];
            $jour_d = \DateTime::createFromFormat('d/m/Y', $jourdepart);
            if ($jour_d && $jour_d->getTimestamp() >= $jour_dpt->getTimestamp()) {
                $jour_dpt = new \DateTime(date_format($jour_d, 'Y-m-d'));
            }
            return $this->redirectToRoute('voyage_result'
                            , array('jour_dpt' => $jour_dpt->getTimestamp(), 'lieuDepart' => $lieuDepart, 'lieuArrivee' => $lieuArrivee));
        }

        // flash message $passager $depart or $arrivee requis
        $this->get('session')->getFlashBag()->add('error', 'Les lieux de départ et arrivée sont requis.');
        return $this->redirectToRoute('voyage_result');
    }

    /**
     * Finds and send ajax data.
     *
     */
    public function objectsLoaderAction(Request $request, $idelement, $valselected) {

        if ($request->isXmlHttpRequest()) {
            $response = new JsonResponse();
            $em = $this->getDoctrine()->getManager();
            $donnees = array(); //Tableau pour le Return Json
            $donnees['key'] = $idelement;

            if ($idelement === 'villekey') {
                $gares = $em->getRepository('GestionBundle:Gare')->findBy(array('ville' => $valselected));
                foreach ($gares as $g) {
                    $donnees['value'][$g->getId()] = $g->getNomGare();
                }
            } elseif ($idelement === 'vehiculekey') {
                $vehicule = $em->getRepository('GestionBundle:Vehicule')->find($valselected);
                $donnees['value'] = $vehicule->getPlaces();
            } elseif ($idelement === 'villedepartkey') {
                /*
                $voyages = $em->getRepository('GestionBundle:Voyage')->findBy(array('lieuDepart' => $valselected));
                
                foreach ($voyages as $v) {
                    $donnees['value'][$v->getLieuArrivee()->getId()] = $v->getLieuArrivee()->getNomVille();
                }*/
                $villes = $em->getRepository('GestionBundle:Ville')->getVilleArrivee($valselected);
                foreach ($villes as $v) {
                    $donnees['value'][$v->getId()] = $v->getNomVille();
                }
            }else {
                $donnees['key'] = "ok";
            }
            return $response->setData($donnees);
        }
        return null;
    }

}
