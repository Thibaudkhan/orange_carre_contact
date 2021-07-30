<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName',TextType::class, [
                'label' => 'Full name',
            ])
            ->add('email',EmailType::class, [
                'label' => 'E-mail'
            ])
            ->add('phone',TextType::class, [
                'label' => 'Phone',
            ])
            ->add('subject',TextType::class, [
                'label' => 'Subject',
            ])
            ->add('reason',ChoiceType::class, [
                'choices'=>[
                    'Contact'=> 'contact',
                    'Issue'=> 'issue',
                    'Other'=> 'other',
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['rows' => 5],
            ])
        ;
    }


}