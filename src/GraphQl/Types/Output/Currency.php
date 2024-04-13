<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\GraphQl\Types\Output;

use App\Currency\Entity\Currency as CurrencyEntity;
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
