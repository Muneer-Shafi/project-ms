<?php

declare(strict_types=1);

namespace App\Product\Controller;

use App\Product\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
#[Route('/product'), IsGranted('ROLE_USER')]

class ProductController extends AbstractController
    {
    public function __construct(
        private readonly ProductRepository $productRepository,
    )
    {
    }

    #[Route('',name:'product_list'), IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('subsidiary/edit.html.twig', [
            'products' => $this->productRepository->findAll(),
        ]);
    }
}