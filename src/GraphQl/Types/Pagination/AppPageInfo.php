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
final class AppPageInfo
{
    public function __construct(
        private AppPaginator $paginator
    ) {
    }

    /**
     * @throws NonUniqueResultException
     */
    #[Field]
    public function startCursor(): ?string
    {
        $cursor = $this->paginator->entityRepository->startCursor($this->paginator->after)?->value;

        return null === $cursor ? null : (string) $cursor;
    }

    #[Field]
    public function endCursor(): ?string
    {
        $cursor = $this->paginator->entityRepository->endCursor((int)$this->paginator->first, $this->paginator->after)?->value;

        return null === $cursor ? null : (string) $cursor;
    }

    #[Field]
    public function hasNextPage(): bool
    {
        return $this->paginator->entityRepository->hasNextPage((int)$this->paginator->first, $this->paginator->after);
    }

    #[Field]
    public function hasPreviousPage(): bool
    {
        return $this->paginator->entityRepository->hasPreviousPage($this->paginator->after);
    }
}
