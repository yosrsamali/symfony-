<?php

namespace App\Form;




use App\Entity\Coach; // Change this to your actual Coach entity
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoachType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cin', TextType::class, [
                'label' => 'CIN',
                'attr' => ['placeholder' => 'Enter CIN'],
            ])
            ->add('dateInscription', DateType::class, [
                'label' => 'Date d\'Inscription',
                'widget' => 'single_text', // Use a date picker
            ])
            ->add('specialite', TextType::class, [
                'label' => 'Spécialité',
                'attr' => ['placeholder' => 'Enter Speciality'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coach::class, // Make sure to link to the Coach entity
        ]);
    }
}
