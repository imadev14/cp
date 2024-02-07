<?php

namespace App\Controller;

use App\Repository\EmailRepository;
use App\Repository\PhoneNumberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevisConfirmationController extends AbstractController
{
    #[Route('/devis-confirmation', name: 'app_devis_confirmation')]
    public function index(EmailRepository $emailRepository, PhoneNumberRepository $phoneNumberRepository): Response
    {
        $emails = $emailRepository->findAll();
        $phoneNumbers = $phoneNumberRepository->findAll();

        return $this->render('devis_confirmation/index.html.twig', [
            'controller_name' => 'DevisConfirmationController',
            'emails' => $emails,
            'phoneNumbers' => $phoneNumbers
        ]);
    }
}
