<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'choices' =>[
                    'Male'=>'Male',
                    'Female'=>'Female',
                ],
                'required' => false
            ])
            ->add('firstname', TextType::class,[
                "required"=>false
            ])
            ->add('lastname', TextType::class,[
                "required"=>false
            ])
            ->add('current_location', TextType::class,[
                "required"=>false
            ])
            ->add('address', TextType::class,[
                "required"=>false
            ])
            ->add('country', TextType::class,[
                "required"=>false
            ])
            ->add('nationality', TextType::class,[
                "required"=>false
            ])
            ->add('birthdate', TextType::class,[
                "required"=>false,
                "mapped"=>false
            ])
            ->add('birthplace', TextType::class,[
                "required"=>false
            ])
            ->add('profil_picture', FileType::class,[
                "required"=>false,
                "mapped"=>false,
                "constraints" => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/jpg',
                            'application/msword',
                            'image/gif',
                            'image/jpeg',
                            'image/png',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
            ->add('passport', CheckboxType::class,[
                "required"=>false
            ])
            ->add('passport_file', FileType::class,[
                "required"=>false,
                "mapped"=>false,
                "constraints" => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/jpg',
                            'application/msword',
                            'image/gif',
                            'image/jpeg',
                            'image/png',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
            ->add('curriculum_vitae', FileType::class,[
                "required"=>false,
                "mapped"=>false,
                "constraints" => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/jpg',
                            'application/msword',
                            'image/gif',
                            'image/jpeg',
                            'image/png',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
            // ->add('availability',[
            //     "required"=>false
            // ])
            ->add('short_description', TextareaType::class,[
                "required"=>false
            ])
            // ->add('created_at')
            // ->add('updated_at')
            // ->add('user')
            // ->add('job_category')
            // ->add('experience')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
