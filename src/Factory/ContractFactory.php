<?php

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Factory;

use App\Entity\Contract;
use App\Repository\ContractRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Contract>
 *
 * @method        Contract|Proxy                     create(array|callable $attributes = [])
 * @method static Contract|Proxy                     createOne(array $attributes = [])
 * @method static Contract|Proxy                     find(object|array|mixed $criteria)
 * @method static Contract|Proxy                     findOrCreate(array $attributes)
 * @method static Contract|Proxy                     first(string $sortedField = 'id')
 * @method static Contract|Proxy                     last(string $sortedField = 'id')
 * @method static Contract|Proxy                     random(array $attributes = [])
 * @method static Contract|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ContractRepository|RepositoryProxy repository()
 * @method static Contract[]|Proxy[]                 all()
 * @method static Contract[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Contract[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Contract[]|Proxy[]                 findBy(array $attributes)
 * @method static Contract[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Contract[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ContractFactory extends ModelFactory
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
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'price' => self::faker()->randomFloat(),
            'quantity' => self::faker()->randomFloat(),
            'relation' => RelationFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Contract $contract): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Contract::class;
    }
}
