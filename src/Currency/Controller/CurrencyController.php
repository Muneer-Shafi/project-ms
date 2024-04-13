<?php

declare(strict_types=1);

namespace App\Currency\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CurrencyController extends AbstractController
    {
        #[Route(''), IsGranted('ROLE_USER')]
        public function index(): Response
        {
          
        }

        #[Route(''), IsGranted('ROLE_USER')]
        public function edit(): Response
        {
     
        }
}