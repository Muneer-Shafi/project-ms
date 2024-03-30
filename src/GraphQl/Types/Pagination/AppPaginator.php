<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\GraphQl\Types\Pagination;

use App\Repository\DoctrinePostRepository;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type]
final class AppPaginator
{
    /**
     * @param positive-int $first
     */
    public function __construct(
        public  ?Cursor $after,
        public  ?int $first,
        public  DoctrinePostRepository $entityRepository
    ) {
    }

    /**
     * @throws \Exception
     *
     * @return list<Edge>
     */
    #[Field]
    public function edges(): array
    {
        return $this->entityRepository->getEdges((int)$this->first, $this->after);
    }

    #[Field]
    public function totalCount(): int
    {
        return $this->entityRepository->getTotalCount();
    }

    #[Field]
    public function pageInfo(): AppPageInfo
    {
        return new AppPageInfo($this);
    }
}
