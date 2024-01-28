<?php
declare(strict_types=1);

namespace App\Relation\MessageHandler;


use App\Relation\Domain\Entity\Relation;
use App\Relation\Message\DeleteRelationMessage;
use App\Relation\Message\NewRelationMessage;
use App\Relation\Service\RelationRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]

class DeleteRelationMessageHandler
{
    public function __construct(
        private readonly RelationRepository $relationRepository,
    )
    {
    }
    public function __invoke(DeleteRelationMessage $message): Relation
    {
        $relation = $this->relationRepository->find($message->relationId);
        $this->relationRepository->remove($relation,true);
        return $relation;
    }
}