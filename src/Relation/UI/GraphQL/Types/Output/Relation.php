<?php
declare(strict_types=1);

namespace App\Relation\UI\GraphQL\Types\Output;

use App\Relation\Domain\Entity\RelationAddress;
use App\Relation\Domain\Entity\RelationContact;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;
use App\Relation\Domain\Entity\Relation as RelationEntity;

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
     * @param RelationEntity $relation
     * @return list<RelationAddress>
     */
    #[Field]
    public function addresses(RelationEntity $relation): array
    {
        return $relation->getAddresses()->toArray();
    }

    /**
     * @param RelationEntity $relation
     * @return list<RelationContact>
     */
    #[Field]
    public function contacts(RelationEntity $relation): array
    {
        return $relation->getContacts()->toArray();
    }
}