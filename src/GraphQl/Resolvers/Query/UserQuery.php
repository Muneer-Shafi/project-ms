<?php

declare(strict_types=1);

namespace App\GraphQl\Resolvers\Query;

use App\Entity\User;
use App\GraphQl\Types\Pagination\Cursor;
use App\GraphQl\Types\Pagination\PostConnection;
use App\Repository\DoctrinePostRepository;
use App\Repository\UserRepository;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\InjectUser;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\GraphQLite\Containers\NotFoundException;

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
        return  $this->userRepository->findAll();
    }
}
