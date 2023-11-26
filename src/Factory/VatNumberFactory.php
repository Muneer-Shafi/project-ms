<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Factory;

use App\Entity\VatNumber;
use App\Repository\VatNumberRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<VatNumber>
 *
 * @method        VatNumber|Proxy                     create(array|callable $attributes = [])
 * @method static VatNumber|Proxy                     createOne(array $attributes = [])
 * @method static VatNumber|Proxy                     find(object|array|mixed $criteria)
 * @method static VatNumber|Proxy                     findOrCreate(array $attributes)
 * @method static VatNumber|Proxy                     first(string $sortedField = 'id')
 * @method static VatNumber|Proxy                     last(string $sortedField = 'id')
 * @method static VatNumber|Proxy                     random(array $attributes = [])
 * @method static VatNumber|Proxy                     randomOrCreate(array $attributes = [])
 * @method static VatNumberRepository|RepositoryProxy repository()
 * @method static VatNumber[]|Proxy[]                 all()
 * @method static VatNumber[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static VatNumber[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static VatNumber[]|Proxy[]                 findBy(array $attributes)
 * @method static VatNumber[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static VatNumber[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<VatNumber> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<VatNumber> createOne(array $attributes = [])
 * @phpstan-method static Proxy<VatNumber> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<VatNumber> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<VatNumber> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<VatNumber> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<VatNumber> random(array $attributes = [])
 * @phpstan-method static Proxy<VatNumber> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<VatNumber> repository()
 * @phpstan-method static list<Proxy<VatNumber>> all()
 * @phpstan-method static list<Proxy<VatNumber>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<VatNumber>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<VatNumber>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<VatNumber>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<VatNumber>> randomSet(int $number, array $attributes = [])
 */
final class VatNumberFactory extends ModelFactory
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
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(VatNumber $vatNumber): void {})
        ;
    }

    protected static function getClass(): string
    {
        return VatNumber::class;
    }
}
