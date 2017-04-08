<?php

namespace AppBundle\Form\Type;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


/**
 * ObservationType
 */

class ObservationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class)
            ->add('bird', ChoiceType::class, [
                'choices' => $options['birdList']
            ])
            ->add('lat', NumberType::class,[
                'scale' => 6,
                'invalid_message' => 'Vous devez saisir une lattitude géographique.'
            ])
            ->add('long', NumberType::class,[
                'scale' => 6,
                'invalid_message' => 'Vous devez saisir une longitude géographique.'
            ])
            ->add('comment', TextareaType::class)
            ->add('image', FileType::class, [
                'required' => false
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Model\ObservationModel',
            'birdList' => null
        ]);
    }
}