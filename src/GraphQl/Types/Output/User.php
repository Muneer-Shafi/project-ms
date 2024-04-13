<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\GraphQl\Types\Output;

use App\Authentication\Entity\User as UserEntity;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type(name: 'UserType', class: UserEntity::class, )]
final class User
{
    #[Field]
    public function id(UserEntity $UserEntity): int
    {
        return $UserEntity->getId();
    }

    #[Field]
    public function firstName(UserEntity $UserEntity): string
    {
        return $UserEntity->getFirstName();
    }

    #[Field]
    public function lastName(UserEntity $UserEntity): string
    {
        return $UserEntity->getLastName();
    }

    #[Field]
    public function email(UserEntity $UserEntity): string
    {
        return $UserEntity->getEmail();
    }
}
