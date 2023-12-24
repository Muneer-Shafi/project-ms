<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Subsidiary\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/subsidiary'), IsGranted('ROLE_USER')]
class SubsidiaryController extends AbstractController
{
    #[Route(''), IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('subsidiary/edit.html.twig', []
        );
    }
}
