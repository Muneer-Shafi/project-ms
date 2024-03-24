<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\UI\GraphQL\Resolvers\Query;

use App\Relation\Domain\Entity\Relation;
use App\Relation\Service\RelationRepository;
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
     * @throws NotFoundException
     */
    #[Query]
    public function relation(ID $relationId): Relation
    {
        $relation = $this->relationRepository->find((string) $relationId);
        if (null === $relation) {
            throw new NotFoundException(sprintf('Relation of Id: %s not found', $relationId->val()));
        }

        return $relation;
    }
}
