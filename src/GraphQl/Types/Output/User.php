<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\GraphQl\Types\Output;

use App\Entity\User as UserEntity;
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
