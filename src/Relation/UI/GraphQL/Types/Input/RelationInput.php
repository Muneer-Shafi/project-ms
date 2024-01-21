<?php
declare(strict_types=1);

namespace App\Relation\UI\GraphQL\Types\Input;

use App\Relation\DTO\RelationDTO;
use TheCodingMachine\GraphQLite\Annotations\Factory;

final class RelationInput
{
    /**
     * The Factory annotation will create automatically a RelationInput input type in GraphQL.
     */
    #[Factory(name: 'CreateNewRelation', default: false)]
    public function createRelation(string $relationName, string $relationShortName): RelationDTO
    {
        return new RelationDTO($relationName, $relationShortName);
    }
}