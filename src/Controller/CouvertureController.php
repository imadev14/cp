<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CouvertureController extends AbstractController
{
    #[Route('/couverture', name: 'app_couverture')]
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        $articles = $articleRepository->findBy([
            'category' =>  $categoryRepository->findBy([
                'titre' => Article::COUVERTURE
            ])
        ]);

        return $this->render('couverture/index.html.twig', [
            'controller_name' => 'totoController',
        ]);
    }
}
