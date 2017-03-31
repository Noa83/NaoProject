<?php

namespace AppBundle\Form\Type;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


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
            ->add('specie', TextType::class)
            ->add('latLong', TextType::class)
            ->add('observationMsg', TextType::class)
            ->add('image', ImageType::class)
            ->add('idUser', HiddenType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Model\ObservationModel'
        ));
    }
}