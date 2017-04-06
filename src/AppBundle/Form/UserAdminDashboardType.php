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
use Symfony\Component\Validator\Constraints\IsTrue;

class UserAdminDashboardType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email',      EmailType::class)
            ->add('username',       TextType::class)
            ->remove('plainPassword')
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
            ->add('role',           TextType::class)
        ;

    }

    public function getParent()
    {
        return UserModelType::class;
    }

}
