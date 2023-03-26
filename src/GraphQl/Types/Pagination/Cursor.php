<?php

declare(strict_types=1);

namespace App\GraphQl\Types\Pagination;


final class Cursor
{
    public function __construct(
        public readonly int|string $value,
    ) {
    }
}