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

namespace App\Relation\UI\GraphQL\Resolvers\Query;

use _PHPStan_d55c4f2c2\React\Dns\RecordNotFoundException;
use App\Relation\Domain\Entity\Relation;
use App\Repository\RelationRepository;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\GraphQLite\Types\ID;

class RelationQuery
{
    public function __construct(
        private readonly RelationRepository $relationRepository
    ) {
    }

    /**
     * @return list<Relation>
     */
    #[Query]
    public function relations(): array
    {
        return $this->relationRepository->findAll();
    }

    /**
     * @throws RecordNotFoundException
     */
    #[Query]
    public function relation(ID $relationId): Relation
    {
        $relation = $this->relationRepository->find((string) $relationId);
        if (null === $relation) {
            throw new RecordNotFoundException(sprintf('Relation of Id: %s not found', $relationId->val()));
        }

        return $relation;
    }
}
