<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Subsidiary\Controller;

use App\Relation\Entity\Relation;
use App\Subsidiary\Entity\Subsidiary;
use App\Subsidiary\Form\SubsidiaryType;
use App\Subsidiary\Repository\SubsidiaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/subsidiary'), IsGranted('ROLE_USER')]
class SubsidiaryController extends AbstractController
{
    public function __construct(
        private readonly SubsidiaryRepository $subsidiaryRepository,
    )
    {
    }

    #[Route('', name: 'subsidiary_list'), IsGranted('ROLE_USER')]
    public function indexAction(): Response
    {
        return $this->render('subsidiary/index.html.twig', [
            'subsidiaries' => $this->subsidiaryRepository->findAll(),
        ]);
    }

    #[Route('/{id<\d+>}/edit', name: 'subsidiary_edit', methods: ['GET', 'POST'])]
    public function editAction(Request $request, Subsidiary $subsidiary, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SubsidiaryType::class, $subsidiary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'subsidiary.updated_successfully');
            return $this->redirectToRoute('subsidiary_edit', ['id' => $subsidiary->getId()]);
        }

        return $this->render('subsidiary/edit.html.twig', [
            'subsidiary' => $subsidiary,
            'form' => $form,
        ]);
    }
}
