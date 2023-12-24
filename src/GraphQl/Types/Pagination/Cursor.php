<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\GraphQl\Types\Pagination;

final class Cursor
{
    public function __construct(
        public readonly int|string $value,
    ) {
    }
}
