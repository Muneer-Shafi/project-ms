<?php

namespace App\Relation\UI\GraphQL\Types\Output;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;
use App\Relation\Domain\Entity\Relation as RelationEntity;

#[Type(class: RelationEntity::class, name: 'UserType',)]
class Relation
{
    #[Field]
   public  function  name(RelationEntity $relation):?string{
       return  $relation->getName();
    }
}