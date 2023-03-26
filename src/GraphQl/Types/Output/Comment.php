<?php

declare(strict_types=1);


namespace App\GraphQl\Types\Output;

use App\Entity\Comment as CommentEntity;
use App\Entity\User;
use DateTime;
use DateTimeImmutable;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type(name: 'CommentType', class: CommentEntity::class,)]
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
    #[Field]
    public function commentedAt(CommentEntity $CommentEntity): DateTimeImmutable
    {
        return $CommentEntity->getPublishedAt();
    }
}
