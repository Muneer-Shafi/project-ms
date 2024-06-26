<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\GraphQl\Resolvers\Query;


use App\Authentication\Entity\User;
use App\GraphQl\Types\Pagination\Cursor;
use App\GraphQl\Types\Pagination\PostConnection;
use App\Repository\DoctrinePostRepository;
use App\Repository\PostRepository;
use TheCodingMachine\GraphQLite\Annotations\InjectUser;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\GraphQLite\Containers\NotFoundException;

final class PostQuery
{
    public function __construct(
        private readonly DoctrinePostRepository $doctrinePostRepository
    ) {
    }

    #[Query]
    public function getPosts(
        #[InjectUser] User $user,
        ?string $after,
        int $first = 5,
    ): PostConnection {
        if ($first <= 0) {
            throw new NotFoundException('First cannot be less than or equal to 0');
        }

        return new PostConnection(
            after: null === $after ? null : new Cursor($after),
            first: $first,
            postRepository: $this->doctrinePostRepository
        );
    }
}
