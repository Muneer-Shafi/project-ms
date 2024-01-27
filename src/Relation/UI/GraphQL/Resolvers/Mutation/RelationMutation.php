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

class RelationMutation
{
    public function __construct(
        private readonly MessageBusInterface $messageBus
    )
    {
    }

    #[Mutation]
    public function newRelation(
        #[UseInputType(inputType: 'CreateNewRelation!')] Relation $relation,
    ): Relation
    {
        $message = new NewRelationMessage($relation);
        $result = $this->messageBus->dispatch($message)->getMessage();
//        assert($result instanceof NewRelationMessage);
//        dd($message->relation(),$result->relation());

        return $message->relation();
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