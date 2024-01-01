<?php
declare(strict_types=1);

namespace App\Relation\UI\GraphQL\Resolvers\Mutation;

use App\Relation\Domain\Entity\Relation;
use App\Relation\DTO\RelationDTO;
use App\Relation\Message\NewRelationMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use TheCodingMachine\GraphQLite\Annotations\Mutation;

class NewRelationMutation
{
    public function __construct(
        private readonly MessageBusInterface $messageBus
    )
    {
    }

    #[Mutation]
    public function newRelation(string $relationName, string $relationShortName,): void
    {
        $relationDto = new RelationDTO(
            relationName: $relationName, relationShortName: $relationShortName
        );
        $message = new NewRelationMessage($relationDto);
        $this->messageBus->dispatch($message);
    }
}