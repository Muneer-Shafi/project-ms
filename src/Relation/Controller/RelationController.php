<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\Controller;

use App\Entity\Currency;
use App\Entity\User;
use App\Relation\Domain\Entity\Relation;
use App\Relation\Domain\Entity\RelationAddress;
use App\Relation\Domain\Entity\RelationContact;
use App\Relation\DTO\RelationDTO;
use App\Relation\Form\RelationType;
use App\Relation\Message\NewRelationMessage;
use App\Relation\Service\RelationRepository;
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
        private readonly MessageBusInterface $messageBus
    ) {
    }

    #[Route('/home', name: 'relation_index', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/', name: 'relation_index', methods: ['GET'])]
    public function index(): Response
    {
        $relations = $this->relationRepository->findAll();

        return $this->render('relation/list.html.twig', [
            'relations' => $relations,
        ]);
    }

    #[Route('/new', name: 'relation_new', methods: ['GET', 'POST'])]
    public function new(
        #[CurrentUser] User $user,
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {

        $relation = Relation::create(new RelationDTO('chinar', 'CHNR','test@gmail.com'));
        $relation->setRemarks('via graphql saved');
        $relation->setCocNumber('COCIe333');
        $currency = new Currency();
        $currency->setCode('EUR');

        $relation->setCurrency($currency);
        $con = new RelationContact();
        $con->setEmail('con@gmail');
        $con->setGender('male');
        $con->setFirstName('Sam');
        $con->setLastName('bills');
        $con->setInitials('Mr');
        $con->setTelephone('9419038739');
        $con->setRelation($relation);

        $relation->addContact($con);
        $message = new NewRelationMessage($relation);
        $this->messageBus->dispatch($message);
//        foreach ($contacts as $contact){
//            $relation->addContact($contact);
//        }
//        $relation = new Relation();
//        $address = new RelationAddress();
//        $address->setName('pampore');

//        $relation->getAddresses()->add($address);

        $form = $this->createForm(RelationType::class, $relation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'user.updated_successfully');

            return $this->redirectToRoute('relation_new');
        }

        return $this->render('relation/edit.html.twig', [
            'user' => $user,
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
            'post' => $relation,
            'form' => $form,
        ]);
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

        // Delete the tags associated with this blog post. This is done automatically
        // by Doctrine, except for SQLite (the database used in this application)
        // because foreign key support is not enabled by default in SQLite
        $relation->getAddresses()->clear();

        $entityManager->remove($relation);
        $entityManager->flush();

        $this->addFlash('success', 'post.deleted_successfully');

        return $this->redirectToRoute('admin_post_index');
    }
}
