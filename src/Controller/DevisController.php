<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\EmailRepository;
use App\Repository\PhoneNumberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class DevisController extends AbstractController
{
    #[Route('/devis', name: 'app_devis')]
    public function index(Request $request, EntityManagerInterface $em, MailerInterface $mailer, PhoneNumberRepository $phoneNumberRepository, EmailRepository $emailRepository): Response
    {
        $emails = $emailRepository->findAll();
        $phoneNumbers = $phoneNumberRepository->findAll();
        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);
        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $em->persist($contact);
            $em->flush();
            $email = new TemplatedEmail();
            $email->to($contact->getEmail())
                ->subject('Votre demande a bien été recu')
                ->htmlTemplate('@emails_templates/devis.html.twig')
                ->context([
                    'prenom' => $contact->getPrenom()
                ]);

            $mailer->send($email);
            return $this->redirectToRoute('app_devis_confirmation');
        }
        return $this->render('devis/index.html.twig', [
            'form' => $formContact->createView(),
            'emails' => $emails,
            'phoneNumbers' => $phoneNumbers
        ]);
    }
}
