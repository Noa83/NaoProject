<?php

namespace AppBundle\Form\Type;


use AppBundle\Form\Type\PointType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


/**
 * ObservationModel
 *
 * @ORM\MappedSuperClass
 */

class ObservationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class)
            ->add('birds', ChoiceType::class, [
                'choices' => $options['birdList']
            ])
            ->add('latLong', TextType::class)
            ->add('observationMsg', TextType::class)
            ->add('image', FileType::class)
            ->add('idUser', HiddenType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Model\ObservationModel',
            'birdList' => null
        ]);
    }
}