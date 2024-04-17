<?php

declare(strict_types=1);

namespace App\Relation\DTO;

use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Doctrine\Orm\State\Options as StateOptions;
use ApiPlatform\Metadata\ApiResource;
use App\Relation\Entity\Relation;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

use ApiPlatform\Metadata\ApiFilter;

#[ApiResource(
    shortName: 'relation',
    paginationItemsPerPage: 5,
    provider: EntityToDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
    stateOptions: new StateOptions(
        entityClass: Relation::class
    ),
)]

#[ApiFilter(SearchFilter::class, properties: [
    'name' => 'partial',
])]
class RelationDTO
{
    public function __construct(
        public string|int|null $id = null,
        public string $name,
        public string $shortName,
        public string $email,
        public string $cocNumber,
        public ?string $remarks,
        public array $relationContracts = [],
    ) {
    }
}
