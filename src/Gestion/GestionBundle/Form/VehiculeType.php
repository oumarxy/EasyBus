<?php

namespace Gestion\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VehiculeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque')
            ->add('immatriculation')
            ->add('places')
            ->add('climatisation', ChoiceType::class, array('choices' => array(
                        'NON' => 'NON',
                        'OUI' => 'OUI',
            )))
            ->add('tele', ChoiceType::class, array('label'=>'télévision', 'choices' => array(
                        'NON' => 'NON',
                        'OUI' => 'OUI',
            )))
            ->add('path')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\GestionBundle\Entity\Vehicule'
        ));
    }
}
