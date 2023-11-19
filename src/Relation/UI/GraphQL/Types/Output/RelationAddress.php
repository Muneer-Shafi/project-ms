<?php
declare(strict_types=1);

namespace App\Relation\UI\GraphQL\Types\Output;
use App\Relation\Domain\Entity\RelationAddress as RelationAddressEntity;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type(class: RelationAddressEntity::class, name: 'RelationAddressType')]
class RelationAddress
{

    #[Field]
    public function id(RelationAddressEntity $relation): int
    {
        return $relation->getId();
    }
    #[Field]
    public function name(RelationAddressEntity $relation): string
    {
        return $relation->getName();
    }
    #[Field]
    public function city(RelationAddressEntity $relation): string
    {
        return $relation->getCity();
    }


}