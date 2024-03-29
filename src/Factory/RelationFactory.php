<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Factory;

use App\Relation\Domain\Entity\Relation;
use App\Relation\Service\RelationRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Relation>
 *
 * @method        Relation|Proxy                     create(array|callable $attributes = [])
 * @method static Relation|Proxy                     createOne(array $attributes = [])
 * @method static Relation|Proxy                     find(object|array|mixed $criteria)
 * @method static Relation|Proxy                     findOrCreate(array $attributes)
 * @method static Relation|Proxy                     first(string $sortedField = 'id')
 * @method static Relation|Proxy                     last(string $sortedField = 'id')
 * @method static Relation|Proxy                     random(array $attributes = [])
 * @method static Relation|Proxy                     randomOrCreate(array $attributes = [])
 * @method static RelationRepository|RepositoryProxy repository()
 * @method static Relation[]|Proxy[]                 all()
 * @method static Relation[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Relation[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Relation[]|Proxy[]                 findBy(array $attributes)
 * @method static Relation[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Relation[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Relation> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Relation> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Relation> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Relation> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Relation> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Relation> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Relation> random(array $attributes = [])
 * @phpstan-method static Proxy<Relation> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Relation> repository()
 * @phpstan-method static list<Proxy<Relation>> all()
 * @phpstan-method static list<Proxy<Relation>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Relation>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<Relation>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Relation>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Relation>> randomSet(int $number, array $attributes = [])
 */
final class RelationFactory extends ModelFactory
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
            'currency' => CurrencyFactory::new(),
            'subsidiary' => SubsidiaryFactory::new(),
            'name' => self::faker()->company(),
            'shortName' => self::faker()->companySuffix(),
            'email' => self::faker()->email(),
            'cocNumber' => self::faker()->randomNumber(),
            'remarks' => self::faker()->text(25),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Relation $relation): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Relation::class;
    }
}
