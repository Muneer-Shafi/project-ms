<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\MessageHandler;

use App\Relation\Entity\Relation;
use App\Relation\Message\NewRelationMessage;
use App\Relation\Service\RelationRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


#[AsMessageHandler]
class NewRelationMessageHandler
{
    public function __construct(
        private readonly RelationRepository $relationRepository,
    )
    {
    }

    public function __invoke(NewRelationMessage $newRelationMessage): Relation
    {
//        dd($saved,$newRelationMessage->relation());
        $this->relationRepository->save($newRelationMessage->relation(),flush: true);
        return $newRelationMessage->relation();
    }
}