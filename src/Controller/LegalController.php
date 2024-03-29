<?php

namespace App\Controller;

use App\Repository\EmailRepository;
use App\Repository\PhoneNumberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{
    #[Route('/mentions-legales', name: 'mentions_legales')]
    public function mentionsLegales(EmailRepository $emailRepository, PhoneNumberRepository $phoneNumberRepository): Response
    {
        $emails = $emailRepository->findAll();
        $phoneNumbers = $phoneNumberRepository->findAll();

        return $this->render('legal/mentions_legales.html.twig', [
            'emails' => $emails,
            'phoneNumbers' => $phoneNumbers
        ]);
    }

    #[Route('/politique-confidentialite', name: 'politique_confidentialite')]
    public function politiqueConfidentialite(EmailRepository $emailRepository, PhoneNumberRepository $phoneNumberRepository): Response
    {
        $emails = $emailRepository->findAll();
        $phoneNumbers = $phoneNumberRepository->findAll();

        return $this->render('legal/politique_confidentialite.html.twig', [
            'emails' => $emails,
            'phoneNumbers' => $phoneNumbers
        ]);
    }
}
