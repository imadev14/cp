<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\EmailRepository;
use App\Repository\PhoneNumberRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MateriauxController extends AbstractController
{
    #[Route('/materiaux', name: 'app_materiaux')]
    public function index(ArticleRepository $articleRepository, PhoneNumberRepository $phoneNumberRepository, CategoryRepository $categoryRepository, EmailRepository $emailRepository): Response
    {
        $emails = $emailRepository->findAll();
        $phoneNumbers = $phoneNumberRepository->findAll();

        return $this->render('materiaux/index.html.twig', [
            'articles' => $articleRepository->findBy([
                'category' =>  $categoryRepository->findBy([
                    'titre' => Category::MATERIAUX
                ])
            ]),
            'emails' => $emails,
            'phoneNumbers' => $phoneNumbers
        ]);
    }
}
