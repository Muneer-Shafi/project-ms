<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\GraphQl\Types\Pagination;

use Doctrine\ORM\NonUniqueResultException;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type]
final class PageInfo
{
    public function __construct(
         private PostConnection $postConnection
    ) {
    }

    /**
     * @throws NonUniqueResultException
     */
    #[Field]
    public function startCursor(): ?string
    {
        $cursor = $this->postConnection->postRepository->startCursor($this->postConnection->after)?->value;

        return null === $cursor ? null : (string) $cursor;
    }

    #[Field]
    public function endCursor(): ?string
    {
        $cursor = $this->postConnection->postRepository->endCursor((int)$this->postConnection->first, $this->postConnection->after)?->value;

        return null === $cursor ? null : (string) $cursor;
    }

    #[Field]
    public function hasNextPage(): bool
    {
        return $this->postConnection->postRepository->hasNextPage((int)$this->postConnection->first, $this->postConnection->after);
    }

    #[Field]
    public function hasPreviousPage(): bool
    {
        return $this->postConnection->postRepository->hasPreviousPage($this->postConnection->after);
    }
}
