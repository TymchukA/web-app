<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\DependencyInjection\Tests\Compiler\C;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UserTypeAdmin extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('email', EmailType::class)
            ->add('roles', ChoiceType::class,[
                'multiple'=> true,
                'expanded' => true,
                'choices' => [
                    'РџР°РЅ' => 'ROLE_ADMIN',
                    'РњРѕРґРµСЂР°С‚РѕСЂ' => 'ROLE_MODERATOR',
                    'РљСЂС–РїР°Рє' => 'ROLE_USER'
                ]])
            ->add('submit', SubmitType::class,
                ['attr' => ['class' => 'btn btn-success pull-right']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}