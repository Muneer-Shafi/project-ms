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

use App\Entity\Comment;
use App\Entity\Post as PostEntity;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type(class: PostEntity::class, name: 'PostType', )]
final class Post
{
    #[Field]
    public function id(PostEntity $postEntity): ?int
    {
        return $postEntity->getId();
    }

    #[Field]
    public function title(PostEntity $postEntity): string
    {
        return $postEntity->getTitle();
    }

    #[Field]
    public function content(PostEntity $postEntity): string
    {
        return $postEntity->getContent();
    }

    /**
     * Undocumented function.
     *
     * @return Comment[]
     */
    #[Field]
    public function comments(PostEntity $postEntity): array
    {
        return $postEntity->getComments()->toArray();
    }
}
