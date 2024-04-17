<?php

declare(strict_types=1);

namespace App\Relation\DTO;

use ApiPlatform\Doctrine\Common\State\PersistProcessor;
use ApiPlatform\Doctrine\Common\State\RemoveProcessor;
use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Currency\Repository\CurrencyRepository;
use App\Relation\Entity\Relation;
use App\Relation\Service\RelationRepository;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class EntityClassDtoStateProcessor implements ProcessorInterface
{

    public function __construct(
        private RelationRepository $relationRepository,
        private CurrencyRepository $currencyRepository,
        #[Autowire(service: PersistProcessor::class)] private ProcessorInterface $persistProcessor,
        #[Autowire(service: RemoveProcessor::class)] private ProcessorInterface $removeProcessor,
    ) {
    }
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $entity = $this->mapDtoToEntity($data);
        if ($operation instanceof DeleteOperationInterface) {
            $this->removeProcessor->process($entity, $operation, $uriVariables, $context);
            return null;
        }
        $this->persistProcessor->process($entity, $operation, $uriVariables, $context);
        
        $data->id = $entity->getId();
        assert($data instanceof RelationDTO);

      return $data;
    }

    private function mapDtoToEntity(object $dto): object
    {

        assert($dto instanceof RelationDTO);
        if ($dto->id) {
            $entity = $this->relationRepository->find($dto->id);
            if (!$entity) {
                throw new \Exception(sprintf('Entity %d not found', $dto->id));
            }
        } else {
            $entity = new Relation();
            $entity->setEmail($dto->email);
            $entity->setName($dto->name);
            $entity->setCocNumber($dto->cocNumber);
            $entity->setShortName($dto->shortName);
            $entity->setEmail('test@gmail.com');
            $entity->setCurrency($this->currencyRepository->find(518));
        }

        return $entity;
    }
}
