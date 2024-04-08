<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Authentication\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ApiController extends AbstractController
{
    #[Route('/api/login', name: 'api_login')]
    public function index(#[CurrentUser] ?User $user, Request $request): Response
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials try again1111',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'user' => $user->jsonSerialize(),
        ]);
    }

    #[Route('/api/user', name: 'api_user')]
    #[IsGranted('IS_AUTHENTICATED')]
    public function userInfo(#[CurrentUser] ?User $user, Request $request): Response
    {
        return $this->json([
            'user' => $user->jsonSerialize(),
        ]);
    }
}
