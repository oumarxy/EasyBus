<?php

namespace Gestion\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class VoyageType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('dateVoyage', DateType::class, array(
                    'required' => true,
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy'))
                ->add('heureDepart', TimeType::class, array(
                    'label' => 'Heure Départ',
                    'widget' => 'single_text', 'html5' => false))
                ->add('heureArrivee', TimeType::class, array(
                    'label' => 'Heure arrivée',
                    'widget' => 'single_text', 'html5' => false))
                ->add('gare', null, array(
                    'placeholder' => 'Nom de gare  (ou commune)',
                    'label' => 'Nom de la gare de départ'))
                ->add('lieuDepart', null, array(
                    'placeholder' => 'Départ (ville)',
                    'label' => 'Lieu Départ'))
                ->add('lieuArrivee', null, array(
                    'placeholder' => 'Arrivée (ville)',
                    'label' => 'Lieu arrivée'))
                ->add('placesDispo', null, array(
                    'label' => 'Places disponibles'))
                ->add('prixVoyage', null, array(
                    'label' => 'Prix du voyage (F CFA)'))
                ->add('vehicule', null, array(
                    'placeholder' => 'Choisir un véhicule'))
                ->add('conducteur')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\GestionBundle\Entity\Voyage'
        ));
    }

}
