<?php

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Factory;

use App\Subsidiary\Application\Repository\SubsidiaryRepository;
use App\Subsidiary\Domain\Entity\Subsidiary;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Subsidiary>
 *
 * @method        Subsidiary|Proxy                     create(array|callable $attributes = [])
 * @method static Subsidiary|Proxy                     createOne(array $attributes = [])
 * @method static Subsidiary|Proxy                     find(object|array|mixed $criteria)
 * @method static Subsidiary|Proxy                     findOrCreate(array $attributes)
 * @method static Subsidiary|Proxy                     first(string $sortedField = 'id')
 * @method static Subsidiary|Proxy                     last(string $sortedField = 'id')
 * @method static Subsidiary|Proxy                     random(array $attributes = [])
 * @method static Subsidiary|Proxy                     randomOrCreate(array $attributes = [])
 * @method static SubsidiaryRepository|RepositoryProxy repository()
 * @method static Subsidiary[]|Proxy[]                 all()
 * @method static Subsidiary[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Subsidiary[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Subsidiary[]|Proxy[]                 findBy(array $attributes)
 * @method static Subsidiary[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Subsidiary[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class SubsidiaryFactory extends ModelFactory
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
            'active' => self::faker()->boolean(),
            'address' => self::faker()->text(255),
            'code' => self::faker()->text(100),
            'country' => self::faker()->text(50),
            'name' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Subsidiary $subsidiary): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Subsidiary::class;
    }
}
