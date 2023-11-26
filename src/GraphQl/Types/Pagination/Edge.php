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

use App\Entity\Post;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type(name: 'OrderEdge')]
final class Edge
{
    public function __construct(
        public readonly Post $node,
        public readonly Cursor $cursor
    ) {
    }

    #[Field]
    public function node(): Post
    {
        return $this->node;
    }

    #[Field]
    public function cursor(): string
    {
        return (string) $this->cursor->value;
    }
}
