<?php

namespace App\Relation\Message;

class DeleteRelationMessage
{

    public function __construct(
     public   string $relationId
    )
    {
    }
}