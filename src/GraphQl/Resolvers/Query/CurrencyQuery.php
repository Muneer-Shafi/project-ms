<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\GraphQl\Resolvers\Query;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use TheCodingMachine\GraphQLite\Annotations\Query;

class CurrencyQuery
{
    public function __construct(
        private readonly CurrencyRepository $currencyRepository,
    ) {
    }

    /**
     * @return Currency[]
     */
    #[Query]
    public function currencies(): array
    {
        return $this->currencyRepository->findAll();
    }
}
