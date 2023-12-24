<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\MessageHandler;

use App\Relation\Message\RelationMessage;

// use Symfony\Component\Messenger\Attribute\AsMessageHandler;
// #[AsMessageHandler]
class RelationMessageHandler
{
    public function __invoke(RelationMessage $relationMessage)
    {
        // TODO: Implement __invoke() method.
    }
}
