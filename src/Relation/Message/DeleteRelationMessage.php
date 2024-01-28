<?php
declare(strict_types=1);

namespace App\Relation\Message;

class DeleteRelationMessage
{
    public function __construct(
        public string $relationId
    )
    {
    }
}