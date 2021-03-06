<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserModelCompleteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email',      EmailType::class)
            ->add('username',       TextType::class)
            ->add('plainPassword',  RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Mot de passe répété'),
                'required' => false,
                'invalid_message' => "Mots de passe différents."
                ))
            ->add('prenom',         TextType::class, array(
                'required' => false))
            ->add('dateNaissance',  DateType::class, array(
                'widget'    =>  'single_text',
                'format'    =>  'yyyy-MM-dd',
                'attr'      =>  array(
                    'class' =>  'date'),
                'required' => false))
            ->add('ville',          TextType::class, array(
                'required' => false))
        ;

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Model\UserAccountModel'
        ));
    }

}
