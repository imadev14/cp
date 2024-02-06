<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('email')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'titre',
                'label' => 'Catégorie'
            ])
            ->add('objet', TextareaType::class, [
                'label' => 'Votre projet',
                'attr' => [
                    'style' => 'height: 200px;',
                ]
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'valider',
                    'style' => 'background-color: red',
                    'class' => 'get-started-btn',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
