<?php

namespace App\Controller;

use App\Entity\FormContact;
use App\Form\FormContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function sendMessage(Request $request, ManagerRegistry $doctrine): Response
    {
        $contact = new FormContact();
        $form = $this->createForm(FormContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($contact);
            $em->flush();
            return $this->redirectToRoute('app_contactThanks');
        }

        return $this->renderForm('contact/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/contact/feedback-sent', name: 'app_contactThanks')]
    public function thanks(): Response
    {
        return $this->render('contact/thanks.html.twig', [

        ]);
    }
}
