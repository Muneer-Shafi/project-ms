<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
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
