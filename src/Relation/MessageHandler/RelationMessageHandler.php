<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
