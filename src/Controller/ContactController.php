<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
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
        return $this->render('contact/index.html.twig', [
            'form' => $formContact->createView(),
        ]);
    }
}
