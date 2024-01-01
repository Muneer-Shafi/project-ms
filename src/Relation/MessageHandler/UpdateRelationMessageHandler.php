<?php
declare(strict_types=1);

namespace App\Relation\MessageHandler;

use App\Relation\Message\UpdateRelationMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


#[AsMessageHandler]
class UpdateRelationMessageHandler
{
    public function __invoke(UpdateRelationMessage $updateRelationMessage)
    {
        dd($updateRelationMessage);
    }
}