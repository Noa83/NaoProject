<?php

namespace AppBundle\Form\Type;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * ResultsType
 */

class ResultsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('birdName', TextType::class, [
                'attr' => [
                    'class' =>  'birdName']
            ])
            ->add('birdId', HiddenType::class, [
                'attr' => [
                    'class' =>  'birdId']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Model\ResultsModel'
        ]);
    }
}