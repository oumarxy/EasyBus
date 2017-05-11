<?php

namespace Gestion\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ConducteurType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom')
                ->add('prenoms', null, array('label' => 'Prénom'))
                ->add('email', EmailType::class)
                //->add('created', DateType::class)
                ->add('contact')
                ->add('permis', ChoiceType::class, array('choices' => array(
                        'A' => 'A',
                        'AB' => 'AB',
                        'ABC' => 'ABC',
                        'ABCD' => 'ABCD',
            )))
                ->add('lieuDeNaissance')
                ->add('dateNaissance', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy'))
                ->add('path')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\GestionBundle\Entity\Conducteur'
        ));
    }

}
