<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PeintureController extends AbstractController
{
    #[Route('/peinture', name: 'app_peinture')]
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('peinture/index.html.twig', [
            'articles' => $articleRepository->findBy([
                'category' =>  $categoryRepository->findBy([
                    'titre' => Category::PEINTURE
                ])
            ]),
        ]);
    }
}
