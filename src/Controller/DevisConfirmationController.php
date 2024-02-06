<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevisConfirmationController extends AbstractController
{
    #[Route('/devis-confirmation', name: 'app_devis_confirmation')]
    public function index(): Response
    {
        return $this->render('devis_confirmation/index.html.twig', [
            'controller_name' => 'DevisConfirmationController',
        ]);
    }
}
