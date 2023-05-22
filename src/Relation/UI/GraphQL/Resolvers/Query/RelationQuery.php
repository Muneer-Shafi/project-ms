<?php
declare(strict_types=1);

namespace App\Relation\UI\GraphQL\Resolvers\Query;

use App\Relation\Domain\Entity\Relation;
use App\Repository\RelationRepository;
use TheCodingMachine\GraphQLite\Annotations\Query;

class RelationQuery
{

    public function __construct(
        private readonly RelationRepository $relationRepository
    )
    {
    }

    /**
     * @return list<Relation>
     */
    #[Query]
    public function relations(): array
    {
        return $this->relationRepository->findAll();
    }
}