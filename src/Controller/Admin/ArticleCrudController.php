<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libelle'),
            TextareaField::new('information'),
            AssociationField::new('category'),
            TextField::new('image')
                ->setFormType(FileType::class)
                ->onlyOnForms(),
            ImageField::new('image')
                ->setBasePath('/uploads/articles')
                ->onlyOnIndex(),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->uploadImage($entityInstance);
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->uploadImage($entityInstance);
        parent::updateEntity($entityManager, $entityInstance);
    }

    private function uploadImage($entityInstance): void
    {
        if (!$entityInstance instanceof Article) {
            return;
        }

        $imageFile = $entityInstance->getImage();

        // only upload new images
        if ($imageFile instanceof UploadedFile) {
            $newFilename = $this->slugger->slug($entityInstance->getLibelle()) . '.' . $imageFile->guessExtension();
            try {
                $imageFile->move(
                    $this->getParameter('app.article_images_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $entityInstance->setImage($newFilename);
        }
    }
}
