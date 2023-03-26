<?php

declare(strict_types=1);


namespace App\GraphQl\Types\Output;

use App\Entity\User as UserEntity;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type(name: 'UserType', class: UserEntity::class,)]
final class User
{

    #[Field]
    public function id(UserEntity $UserEntity): ?int
    {
        return $UserEntity->getId();
    }
    #[Field]
    public function name(UserEntity $UserEntity): string
    {
        return $UserEntity->getFullName();
    }

    #[Field]
    public function email(UserEntity $UserEntity): string
    {
        return $UserEntity->getEmail();
    }
}
