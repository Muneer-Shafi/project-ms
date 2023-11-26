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

namespace App\Factory;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Currency>
 *
 * @method        Currency|Proxy                     create(array|callable $attributes = [])
 * @method static Currency|Proxy                     createOne(array $attributes = [])
 * @method static Currency|Proxy                     find(object|array|mixed $criteria)
 * @method static Currency|Proxy                     findOrCreate(array $attributes)
 * @method static Currency|Proxy                     first(string $sortedField = 'id')
 * @method static Currency|Proxy                     last(string $sortedField = 'id')
 * @method static Currency|Proxy                     random(array $attributes = [])
 * @method static Currency|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CurrencyRepository|RepositoryProxy repository()
 * @method static Currency[]|Proxy[]                 all()
 * @method static Currency[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Currency[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Currency[]|Proxy[]                 findBy(array $attributes)
 * @method static Currency[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Currency[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Currency> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Currency> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Currency> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Currency> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Currency> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Currency> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Currency> random(array $attributes = [])
 * @phpstan-method static Proxy<Currency> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Currency> repository()
 * @phpstan-method static list<Proxy<Currency>> all()
 * @phpstan-method static list<Proxy<Currency>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Currency>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<Currency>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Currency>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Currency>> randomSet(int $number, array $attributes = [])
 */
final class CurrencyFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'code' => self::faker()->currencyCode(),
            'symbol' => self::faker()->currencyCode(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Currency $currency): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Currency::class;
    }
}
