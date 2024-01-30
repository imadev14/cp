<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToitureController extends AbstractController
{
    #[Route('/toiture', name: 'app_toiture')]
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        $articles = $articleRepository->findBy([
            'category' => $categoryRepository->findBy([
                'titre' => Article::TOITURE
            ])
        ]);

        return $this->render('toiture/index.html.twig', [
            'controller_name' => 'ToitureController',
        ]);
    }
}
