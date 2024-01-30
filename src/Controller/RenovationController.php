<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RenovationController extends AbstractController
{
    #[Route('/renovation', name: 'app_renovation')]
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        $articles = $articleRepository->findBy([
            'category' => $categoryRepository->findBy([
                'titre' => Article::RENOVATION
            ])
        ]);
        return $this->render('renovation/index.html.twig', [
            'controller_name' => 'RenovationController',
        ]);
    }
}
