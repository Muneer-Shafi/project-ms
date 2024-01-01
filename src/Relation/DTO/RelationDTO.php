<?php
declare(strict_types=1);

namespace App\Relation\DTO;

class RelationDTO
{
    public function __construct(
        public string $relationName,
        public string $relationShortName
    )
    {
    }

}