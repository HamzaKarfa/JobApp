<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender')
            ->add('firstname')
            ->add('lastname')
            ->add('adress')
            ->add('country')
            ->add('nationality')
            ->add('passport')
            ->add('passport_file')
            ->add('curriculum_vitae')
            ->add('profil_picture')
            ->add('current_location')
            ->add('date_of_birth')
            ->add('place_of_birth')
            ->add('availability')
            ->add('short_description')
            ->add('created_at')
            ->add('updated_at')
            ->add('user')
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
