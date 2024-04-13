<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\GraphQl\Resolvers\Query;


use App\Authentication\Entity\User;
use App\Authentication\Repository\UserRepository;
use TheCodingMachine\GraphQLite\Annotations\Query;

final class UserQuery
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    /**
     * @return User[]
     */
    #[Query]
    public function users(): array
    {
        return $this->userRepository->findAll();
    }
}
