<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'choices' =>[
                    'Male'=>'Male',
                    'Female'=>'Female',
                ]
            ])
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('current_location', TextType::class)
            ->add('address', TextType::class)
            ->add('country', TextType::class)
            ->add('nationality', TextType::class)
            ->add('birthdate', TextType::class)
            ->add('birthplace')
            ->add('passport')
            ->add('passport_file')
            ->add('curriculum_vitae')
            ->add('profil_picture')
            ->add('availability')
            ->add('short_description', TextareaType::class)
            // ->add('created_at')
            // ->add('updated_at')
            // ->add('user')
            ->add('job_category')
            ->add('experience')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
