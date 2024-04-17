<?php

declare(strict_types=1);

namespace App\Relation\DTO;

use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\TraversablePaginator;
use ApiPlatform\State\ProviderInterface;
use ApiPlatform\Doctrine\Orm\Paginator;
use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use ApiPlatform\Metadata\CollectionOperationInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class EntityToDtoStateProvider implements ProviderInterface
{

    public function __construct(
        #[Autowire(service: CollectionProvider::class)]
        private ProviderInterface $collectionProvider,
        #[Autowire(service: ItemProvider::class)]
        private ProviderInterface $itemProvider,
    ) {
    }
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {

        if ($operation instanceof CollectionOperationInterface) {
            $entities = $this->collectionProvider->provide($operation, $uriVariables, $context);
            assert($entities instanceof Paginator);
            $dtos = [];
            foreach ($entities as $entity) {
                $dtos[] = $this->mapEntityToDto($entity);
            }
            return new TraversablePaginator(
                new \ArrayIterator($dtos),
                $entities->getCurrentPage(),
                $entities->getItemsPerPage(),
                $entities->getTotalItems()
            );
        }
        $entity = $this->itemProvider->provide($operation, $uriVariables, $context);
        if (!$entity) {
            return null;
        }
        return $this->mapEntityToDto($entity);
    }

    private function mapEntityToDto(object $entity): object
    {
        $dto = new RelationDTO(
            id: $entity->getId(),
            name: $entity->getName(),
            shortName: $entity->getShortName(),
            email: $entity->getEmail(),
            cocNumber: $entity->getName(),
            remarks: $entity->getRemarks(),
            relationContracts: $entity->getContacts()->toArray(),
        );
        return $dto;
    }
}
