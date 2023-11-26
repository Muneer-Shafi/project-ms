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
