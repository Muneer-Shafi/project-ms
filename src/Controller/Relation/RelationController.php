<?php

declare(strict_types=1);

namespace App\Controller\Relation;

use App\Entity\Address;
use App\Entity\Relation;
use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\RelationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Logout\LogoutUrlGenerator;


#[Route('/relation'), IsGranted('ROLE_USER')]
class RelationController extends AbstractController
{
    #[Route('/new', methods: ['GET', 'POST'], name: 'relation_new')]
    public function new(
        #[CurrentUser] User $user,
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {
        $relation = new Relation();
        $address = new Address();
        $address->setName('pampore');

        $relation->getAddresses()->add($address);

        $form = $this->createForm(RelationType::class, $relation);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'user.updated_successfully');

            return $this->redirectToRoute('user_edit');
        }

        return $this->render('relation/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/change-password', methods: ['GET', 'POST'], name: 'user_change_password')]
    public function changePassword(
        #[CurrentUser] User $user,
        Request $request,
        EntityManagerInterface $entityManager,
        LogoutUrlGenerator $logoutUrlGenerator,
    ): Response {
        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirect($logoutUrlGenerator->getLogoutPath());
        }

        return $this->render('user/change_password.html.twig', [
            'form' => $form,
        ]);
    }
}
