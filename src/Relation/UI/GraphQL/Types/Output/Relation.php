<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\UI\GraphQL\Types\Output;

use App\Relation\Entity\Relation as RelationEntity;
use App\Relation\Entity\RelationAddress;
use App\Relation\Entity\RelationContact;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type(class: RelationEntity::class, name: 'RelationType')]
class Relation
{
    #[Field]
    public function id(RelationEntity $relation): int
    {
        return $relation->getId();
    }

    #[Field]
    public function name(RelationEntity $relation): string
    {
        return $relation->getName();
    }

    #[Field]
    public function shortName(RelationEntity $relation): string
    {
        return $relation->getShortName();
    }

    #[Field]
    public function email(RelationEntity $relation): string
    {
        return $relation->getEmail();
    }

    /**
     * @return list<RelationAddress>
     */
    #[Field]
    public function addresses(RelationEntity $relation): array
    {
        return $relation->getAddresses()->toArray();
    }

    /**
     * @return list<RelationContact>
     */
    #[Field]
    public function contacts(RelationEntity $relation): array
    {
        return $relation->getContacts()->toArray();
    }
}
