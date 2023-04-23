<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EchangesController extends AbstractController
{
    #[Route('/echanges', name: 'app_echanges')]
    public function index(): Response
    {
        return $this->render('echanges/index.html.twig', [
            //'controller_name' => 'EchangesController',
        ]);
    }
}
