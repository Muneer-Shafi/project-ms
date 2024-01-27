<?php
declare(strict_types=1);

namespace App\Relation\UI\GraphQL\Resolvers\Mutation;

use App\Relation\Domain\Entity\Relation;
use App\Relation\DTO\RelationDTO;
use App\Relation\Message\DeleteRelationMessage;
use App\Relation\Message\NewRelationMessage;
use App\Relation\UI\GraphQL\Types\Input\RelationInput;
use Symfony\Component\Messenger\MessageBusInterface;
use TheCodingMachine\GraphQLite\Annotations\Mutation;
use TheCodingMachine\GraphQLite\Annotations\UseInputType;
use TheCodingMachine\GraphQLite\Types\ID;

class NewRelationMutation
{
    public function __construct(
        private readonly MessageBusInterface $messageBus
    )
    {
    }

    #[Mutation]
    public function newRelation(
        #[UseInputType(inputType: 'CreateNewRelation!')] Relation $relation,
    ): void
    {
        $message = new NewRelationMessage($relation);
        $this->messageBus->dispatch($message);
    }

    #[Mutation]
    public function deleteRelation(
        ID $relationId,
    ): void
    {
        $message = new DeleteRelationMessage((string)$relationId->val());
        $this->messageBus->dispatch($message);
    }
}