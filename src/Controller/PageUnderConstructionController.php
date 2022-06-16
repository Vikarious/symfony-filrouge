<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageUnderConstructionController extends AbstractController
{
    #[Route('/page_under_construction', name: 'app_page_under_construction')]
    public function index(): Response
    {
        return $this->render('page_under_construction/index.html.twig', [
            'controller_name' => 'PageUnderConstructionController',
        ]);
    }
}
