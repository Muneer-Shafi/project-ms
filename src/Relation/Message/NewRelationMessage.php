<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\Message;

use App\Relation\DTO\RelationDTO;

class NewRelationMessage
{
    public function __construct(
        private readonly RelationDTO $relationDTO
    )
    {
    }

    public function relationDTO(): RelationDTO
    {
        return $this->relationDTO;
    }
}
