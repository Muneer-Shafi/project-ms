<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
#[Route('/api', name: 'api')]
class ApiLoginController extends AbstractController
{
    #[Route('/login', name: 'app_api_login')]
    public function index(#[CurrentUser] ?User $user): JsonResponse
    {

        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $this->json([
            'user'  => $user->getUserIdentifier(),
            'token' => 'some token is genereted',
        ]);
    }
}
