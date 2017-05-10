<?php

namespace AppBundle\Form\Type;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


/**
 * ObservationType
 */

class ObservationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',  DateType::class, array(
                'widget'    =>  'single_text',
                'format'    =>  'yyyy-MM-dd',
                'attr'      =>  array(
                'class' =>  'date'),
                'required' => false))
            ->add('birdName', TextType::class)
            ->add('birdId', HiddenType::class)
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
                'required' => false,
                'data_class' => null
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Model\ObservationModel'
        ]);
    }
}