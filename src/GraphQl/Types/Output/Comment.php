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

use App\Entity\Comment as CommentEntity;
use App\Entity\User;
use DateTimeImmutable;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type(class: CommentEntity::class, name: 'CommentType', )]
final class Comment
{
    #[Field]
    public function id(CommentEntity $CommentEntity): ?int
    {
        return $CommentEntity->getId();
    }

    #[Field]
    public function user(CommentEntity $CommentEntity): User
    {
        return $CommentEntity->getAuthor();
    }

    #[Field]
    public function content(CommentEntity $CommentEntity): string
    {
        return $CommentEntity->getContent();
    }
    // #[Field]
    // public function commentedAt(CommentEntity $CommentEntity): DateTimeImmutable
    // {
    //     return $CommentEntity->getPublishedAt();
    // }
}
