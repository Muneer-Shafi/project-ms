<?php

declare(strict_types=1);

namespace App\GraphQl\Types\Pagination;

use Doctrine\ORM\NonUniqueResultException;
use Qbil\Order\UI\GraphQL\Types\Output\OrderConnection\OrderConnection;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type]
final class PageInfo
{
    public function __construct(
        readonly private PostConnection $postConnection
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
        $cursor = $this->postConnection->postRepository->endCursor($this->postConnection->first, $this->postConnection->after)?->value;

        return null === $cursor ? null : (string) $cursor;
    }

    #[Field]
    public function hasNextPage(): bool
    {
        return $this->postConnection->postRepository->hasNextPage( $this->postConnection->first, $this->postConnection->after);
    }

    #[Field]
    public function hasPreviousPage(): bool
    {
        return $this->postConnection->postRepository->hasPreviousPage($this->postConnection->after);
    }
}
