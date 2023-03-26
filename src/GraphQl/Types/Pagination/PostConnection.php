<?php

declare(strict_types=1);

namespace App\GraphQl\Types\Pagination;

use App\Repository\DoctrinePostRepository;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type]
final class PostConnection
{
    /**
     * @param positive-int $first
     */
    public function __construct(
        readonly public ?Cursor $after,
        readonly public int $first,
        readonly public DoctrinePostRepository $postRepository
    ) {
    }

    /**
     * @return list<Edge>
     * @throws \Exception
     */
    #[Field]
    public function edges(): array
    {
        return $this->postRepository->getEdges($this->first, $this->after);
    }

    #[Field]
    public function totalCount(): int
    {
        return $this->postRepository->getTotalCount();
    }

    #[Field]
    public function pageInfo(): PageInfo
    {
        return new PageInfo($this);
    }
}
