<?php
declare(strict_types=1);

namespace App\Relation\MessageHandler;

use App\Relation\Entity\Relation;
use App\Relation\Message\UpdateRelationMessage;
use App\Relation\Service\RelationRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


#[AsMessageHandler]
class UpdateRelationMessageHandler
{
    public function __invoke(UpdateRelationMessage $updateRelationMessage):void
    {
        dd($updateRelationMessage);
    }
}