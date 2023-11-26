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

namespace App\GraphQl\Types\Output;

use App\Entity\Currency as CurrencyEntity;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type(class: CurrencyEntity::class, name: 'CurrencyType')]
class Currency
{
    #[Field]
    public function id(CurrencyEntity $currency): int
    {
        return $currency->getId();
    }

    #[Field]
    public function code(CurrencyEntity $currency): string
    {
        return $currency->getCode();
    }

    #[Field]
    public function symbol(CurrencyEntity $currency): string
    {
        return $currency->getSymbol();
    }

    #[Field]
    public function remarks(CurrencyEntity $currency): ?string
    {
        return $currency->getRemarks();
    }
}
