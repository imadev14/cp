<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::DELETE);
    }

    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('email'),
            AssociationField::new('category')
                ->setLabel('Catégorie'),
            TextEditorField::new('objet'),
            ChoiceField::new('etat')
                ->setLabel('État du traitement')
                ->setChoices([
                    'À traiter' => 'à_traiter',
                    'En cours de traitement' => 'en_cours',
                    'Traité' => 'traite',
                ])
                ->allowMultipleChoices(false),
        ];
    }
}
