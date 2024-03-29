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

class ToitureController extends AbstractController
{
    #[Route('/toiture', name: 'app_toiture')]
    public function index(ArticleRepository $articleRepository, PhoneNumberRepository $phoneNumberRepository, CategoryRepository $categoryRepository, EmailRepository $emailRepository): Response
    {
        $emails = $emailRepository->findAll();
        $phoneNumbers = $phoneNumberRepository->findAll();

        return $this->render('toiture/index.html.twig', [
            'articles' => $articleRepository->findBy([
                'category' =>  $categoryRepository->findBy([
                    'titre' => Category::TOITURE
                ])
            ]),
            'emails' => $emails,
            'phoneNumbers' => $phoneNumbers
        ]);
    }
}
