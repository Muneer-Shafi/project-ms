<?php
declare(strict_types=1);

namespace App\Relation\UI\GraphQL\Types\Input;

use App\Entity\Currency;
use App\Factory\AddressFactory;
use App\Factory\ContactFactory;
use App\Factory\RelationFactory;
use App\Relation\Domain\Entity\Relation;
use App\Relation\Domain\Entity\RelationContact;
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
        string $relationName,
        string $relationShortName,
        string $email,
        #[UseInputType(inputType: '[RelationContacts!]!')] array $contacts,
    ): Relation
    {

        $relation = Relation::create(new RelationDTO($relationName, $relationShortName,$email));
        $relation->setRemarks('via graphql saved');
        $relation->setCocNumber('COCIe333');
        $currency = new Currency();
        $currency->setCode('EUR');

        $relation->setCurrency($currency);
        $con = new RelationContact();
        $con->setEmail('con@gmail');
        $con->setGender('male');
        $con->setFirstName('Sam');
        $con->setLastName('bills');
        $con->setRelation($relation);

//        $relation->addContact($con);
//        foreach ($contacts as $contact){
//            $relation->addContact($contact);
//        }
        return $relation;
    }

    #[Factory(name: 'RelationContacts', default: false)]
    public function contacts(string $firstName, string $lastName): RelationContact
    {
        $contact = new RelationContact();
        $contact->setFirstName($firstName);
        $contact->setLastName($lastName);
        return $contact;
    }
}