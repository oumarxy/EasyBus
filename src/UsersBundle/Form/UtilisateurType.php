<?php

namespace UsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
      //  $this->testtodo = $options['testtodo'];
        $builder
                ->add('nom')
                ->add('prenoms')
                ->add('habitation')
                ->add('tel1')
                ->add('tel2')
                ->add('email')
                ->add('enabled',  \Symfony\Component\Form\Extension\Core\Type\TextType::class,array('label'=>'Activer/Désactiver'))
                ->add('username')
                // ->add('compagnie')
        ;
        /*
          switch ($this->testtodo) {
          case "gpp"://Création d'un gpp
          $builder->
          break;
          case "distri"://Création de distri
          $builder->add('distributeur');
          break;
          default :
          //$builder->add('email');
          break;
          }
         */
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'UsersBundle\Entity\Utilisateur',
           // 'testtodo' => null
        ));
    }

}
