<?php

namespace App\Controller;

use App\Entity\PhoneNumber;
use App\Form\PhoneNumberType;
use App\Repository\PhoneNumberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/phone/number')]
class PhoneNumberController extends AbstractController
{
    #[Route('/', name: 'app_phone_number_index', methods: ['GET'])]
    public function index(PhoneNumberRepository $phoneNumberRepository): Response
    {
        $phoneNumbers = $phoneNumberRepository->findAll();
        return $this->render('phone_number/index.html.twig', [
            'phoneNumbers' => $phoneNumbers,
        ]);
    }

    #[Route('/new', name: 'app_phone_number_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $phoneNumber = new PhoneNumber();
        $form = $this->createForm(PhoneNumberType::class, $phoneNumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($phoneNumber);
            $entityManager->flush();

            return $this->redirectToRoute('app_phone_number_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('phone_number/new.html.twig', [
            'phone_number' => $phoneNumber,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_phone_number_show', methods: ['GET'])]
    public function show(PhoneNumber $phoneNumber): Response
    {
        return $this->render('phone_number/show.html.twig', [
            'phone_number' => $phoneNumber,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_phone_number_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PhoneNumber $phoneNumber, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PhoneNumberType::class, $phoneNumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_phone_number_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('phone_number/edit.html.twig', [
            'phone_number' => $phoneNumber,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_phone_number_delete', methods: ['POST'])]
    public function delete(Request $request, PhoneNumber $phoneNumber, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $phoneNumber->getId(), $request->request->get('_token'))) {
            $entityManager->remove($phoneNumber);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_phone_number_index', [], Response::HTTP_SEE_OTHER);
    }
}
