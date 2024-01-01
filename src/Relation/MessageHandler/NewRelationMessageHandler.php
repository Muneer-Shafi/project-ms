<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\MessageHandler;

use App\Relation\Message\NewRelationMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


#[AsMessageHandler]
class NewRelationMessageHandler
{
    public function __invoke(NewRelationMessage $newRelationMessage)
    {
        $relationDto = $newRelationMessage->relationDTO();
      dd($newRelationMessage);
    }
}
