<?php

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Factory;

use App\Product\Entity\ProductGroup;
use App\Repository\ProductGroupRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ProductGroup>
 *
 * @method        ProductGroup|Proxy                     create(array|callable $attributes = [])
 * @method static ProductGroup|Proxy                     createOne(array $attributes = [])
 * @method static ProductGroup|Proxy                     find(object|array|mixed $criteria)
 * @method static ProductGroup|Proxy                     findOrCreate(array $attributes)
 * @method static ProductGroup|Proxy                     first(string $sortedField = 'id')
 * @method static ProductGroup|Proxy                     last(string $sortedField = 'id')
 * @method static ProductGroup|Proxy                     random(array $attributes = [])
 * @method static ProductGroup|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ProductGroupRepository|RepositoryProxy repository()
 * @method static ProductGroup[]|Proxy[]                 all()
 * @method static ProductGroup[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static ProductGroup[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static ProductGroup[]|Proxy[]                 findBy(array $attributes)
 * @method static ProductGroup[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductGroup[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<ProductGroup> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<ProductGroup> createOne(array $attributes = [])
 * @phpstan-method static Proxy<ProductGroup> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<ProductGroup> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<ProductGroup> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<ProductGroup> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<ProductGroup> random(array $attributes = [])
 * @phpstan-method static Proxy<ProductGroup> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<ProductGroup> repository()
 * @phpstan-method static list<Proxy<ProductGroup>> all()
 * @phpstan-method static list<Proxy<ProductGroup>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<ProductGroup>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<ProductGroup>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<ProductGroup>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<ProductGroup>> randomSet(int $number, array $attributes = [])
 */
final class ProductGroupFactory extends ModelFactory
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
            'code' => self::faker()->text(100),
            'name' => self::faker()->text(200),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ProductGroup $productGroup): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ProductGroup::class;
    }
}
