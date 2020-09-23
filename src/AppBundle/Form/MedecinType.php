<?php

namespace AppBundle\Form;

use AppBundle\AppBundle;
use AppBundle\Entity\Commune;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedecinType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')->add('postnom')->add('prenom')->add('annee')->add('telephone')->add('email')
            ->add('specialites')
            ->add('hopital')->add('universite')
            ->add('commune',EntityType::class,['class'=>Commune::class,'choice_label' => 'commune',
            ])
            ->add('photo',FileType::class,['label'=>'Photo Passeport en JPG -100k','data_class'=>null,'required'=>false]);;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Medecin'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_medecin';
    }


}
