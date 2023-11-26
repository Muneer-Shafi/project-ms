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
     * @throws \Exception
     *
     * @return list<Edge>
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
