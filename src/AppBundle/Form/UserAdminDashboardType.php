<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
        $builder->remove('plainPassword')
            ->add('role',           ChoiceType::class, array(
                'choices'  => array(
                    'Admin' => 'ROLE_ADMIN',
                    'Validateur' => 'ROLE_VALIDATEUR',
                    'Utilisateur' => 'ROLE_USER',
                )))
        ;

    }

    public function getParent()
    {
        return UserModelCompleteType::class;
    }

}
