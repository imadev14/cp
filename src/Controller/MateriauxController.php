<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MateriauxController extends AbstractController
{
    #[Route('/materiaux', name: 'app_materiaux')]
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('materiaux/index.html.twig', [
            'articles' => $articleRepository->findBy([
                'category' =>  $categoryRepository->findBy([
                    'titre' => Category::MATERIAUX
                ])
            ]),
        ]);
    }
}
