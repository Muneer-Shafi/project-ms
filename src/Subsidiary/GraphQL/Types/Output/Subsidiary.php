<?php

declare(strict_types=1);

namespace App\Subsidiary\GraphQL\Types\Output;

use \App\Subsidiary\Entity\Subsidiary as SubsidiaryEntity;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type(class: SubsidiaryEntity::class, name: 'SubsidiaryType')]
class Subsidiary
{
    #[Field]
    public function id(SubsidiaryEntity $subsidiary): int
    {
        return $subsidiary->getId();
    }

    #[Field]
    public function name(SubsidiaryEntity $subsidiary): string
    {
        return $subsidiary->getName();
    }

    #[Field]
    public function country(SubsidiaryEntity $subsidiary): string
    {
        return $subsidiary->getCountry();
    }

    #[Field]
    public function city(SubsidiaryEntity $subsidiary): string
    {
        return $subsidiary->getCity();
    }

//    /**
//     * @return list<RelationAddress>
//     */
//    #[Field]
//    public function addresses(SubsidiaryEntity $relation): array
//    {
//        return $relation->getAddresses()->toArray();
//    }
//
//    /**
//     * @return list<RelationContact>
//     */
//    #[Field]
//    public function contacts(SubsidiaryEntity $relation): array
//    {
//        return $relation->getContacts()->toArray();
//    }
}
