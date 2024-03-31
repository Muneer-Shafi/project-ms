<?php
declare(strict_types=1);

namespace App\Relation\UI\GraphQL\Types\Input;

use App\Entity\Currency;
use App\Relation\Entity\Relation;
use App\Relation\Entity\RelationAddress;
use App\Relation\Entity\RelationContact;
use App\Relation\DTO\RelationDTO;
use TheCodingMachine\GraphQLite\Annotations\Factory;
use TheCodingMachine\GraphQLite\Annotations\UseInputType;

final class RelationInput
{
    /**
     * The Factory annotation will create automatically a RelationInput input type in GraphQL.
     */
    #[Factory(name: 'CreateNewRelation', default: false)]
    public function createRelation(
        string                                                   $relationName,
        string                                                   $relationShortName,
        string                                                   $email,
        #[UseInputType(inputType: '[RelationContact!]!')] array $contacts,
        #[UseInputType(inputType: '[RelationAddress!]!')] array $addresses,
    ): Relation
    {

        $relation = Relation::create(new RelationDTO($relationName, $relationShortName, $email));
        $relation->setRemarks('via graphql saved');
        $relation->setCocNumber('COCIe333');
        $currency = new Currency();
        $currency->setCode('EUR');
        $relation->setCurrency($currency);
        $relation->setContacts($contacts);
        return $relation;
    }

    #[Factory(name: 'RelationContact', default: false)]
    public function contacts(string $firstName, string $lastName, string $email, string $gender, string $telephone): RelationContact
    {
        return RelationContact::create(
            firstName: $firstName, lastName: $lastName, email: $email, gender: $gender, telephone: $telephone
        );
    }

    #[Factory(name: 'RelationAddress', default: false)]
    public function addresses(string $name, string $city, string $addressLine1, string $addressLine2, string $pinCode): RelationAddress
    {
        return RelationAddress::create(
            name: $name, addressLine1: $addressLine1, addressLine2: $addressLine2, city: $city, pinCode: $pinCode
        );
    }
}