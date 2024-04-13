<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\Controller;

use App\Authentication\Entity\User;
use App\Relation\Entity\Relation;
use App\Relation\Entity\RelationAddress;
use App\Relation\Entity\RelationContact;
use App\Relation\DTO\RelationDTO;
use App\Relation\Form\RelationType;
use App\Relation\Message\NewRelationMessage;
use App\Relation\Service\RelationRepository;
use App\Subsidiary\Repository\SubsidiaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/relation'), IsGranted('ROLE_USER')]
class RelationController extends AbstractController
{
    public function __construct(
        private readonly RelationRepository $relationRepository,
        private readonly SubsidiaryRepository $subsidiaryRepository,
        private readonly MessageBusInterface $messageBus
    ) {
    }
    #[Route('/list', name: 'relation_list', methods: ['GET'])]
    public function list(): Response
    {
        $relations = $this->relationRepository->findAll();
        return $this->render('relation/list.html.twig', [
            'relations' => $relations,
        ]);
    }

    #[Route('/api', name: 'relation_api', methods: ['GET'])]
    public function api(): Response
    {
        $relations = $this->relationRepository->findAll();
        return $this->json(data: $relations, status: 200);
    }

    #[Route('/new', name: 'relation_new', methods: ['GET', 'POST'])]
    public function new(
        #[CurrentUser] User $user,
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {
        $relation = new Relation();
        $form = $this->createForm(RelationType::class, $relation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'user.updated_successfully');

            return $this->redirectToRoute('relation_new');
        }

        return $this->render('relation/edit.html.twig', [
            'user' => $user,
            'relation' => $relation,
            'form' => $form,
        ]);
    }

    #[Route('/{id<\d+>}/edit', name: 'relation_edit', methods: ['GET', 'POST'])]
    // #[IsGranted('edit', subject: 'relation', message: 'Posts can only be edited by their authors.')]
    public function edit(Request $request, Relation $relation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RelationType::class, $relation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'relation$relation.updated_successfully');

            return $this->redirectToRoute('relation_edit', ['id' => $relation->getId()]);
        }

        return $this->render('relation/edit.html.twig', [
            'relation' => $relation,
            'form' => $form,
        ]);
    }

    #[Route('/api/{id<\d+>}/edit', name: 'relation_edit', methods: ['GET'])]
    // #[IsGranted('edit', subject: 'relation', message: 'Posts can only be edited by their authors.')]
    public function editApi(Request $request, Relation $relation, EntityManagerInterface $entityManager): Response
    {
        return $this->json($relation);
    }

    /**
     * Deletes a Post entity.
     */
    #[Route('/{id}/delete', name: 'admin_post_delete', methods: ['POST'])]
    #[IsGranted('delete', subject: 'relation')]
    public function delete(Request $request, Relation $relation, EntityManagerInterface $entityManager): Response
    {
        /** @var string|null $token */
        $token = $request->request->get('token');

        if (!$this->isCsrfTokenValid('delete', $token)) {
            return $this->redirectToRoute('admin_post_index');
        }
        $relation->getAddresses()->clear();

        $entityManager->remove($relation);
        $entityManager->flush();

        $this->addFlash('success', 'post.deleted_successfully');

        return $this->redirectToRoute('admin_post_index');
    }
}
