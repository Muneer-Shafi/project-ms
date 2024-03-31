<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\UI\GraphQL\Types\Output;

use App\Relation\Entity\RelationContact as ContactEntity;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type(class: ContactEntity::class, name: 'ContactType', )]
final class Contact
{
    #[Field]
    public function id(ContactEntity $contact): ?int
    {
        return $contact->getId();
    }

    #[Field]
    public function firstName(ContactEntity $postEntity): string
    {
        return $postEntity->getFirstName();
    }

    #[Field]
    public function lastName(ContactEntity $postEntity): string
    {
        return $postEntity->getLastName();
    }

    #[Field]
    public function email(ContactEntity $postEntity): string
    {
        return $postEntity->getEmail();
    }

    #[Field]
    public function telephone(ContactEntity $postEntity): string
    {
        return $postEntity->getTelephone();
    }
}
