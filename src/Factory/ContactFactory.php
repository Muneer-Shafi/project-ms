<?php

namespace App\Factory;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Contact>
 *
 * @method        Contact|Proxy create(array|callable $attributes = [])
 * @method static Contact|Proxy createOne(array $attributes = [])
 * @method static Contact|Proxy find(object|array|mixed $criteria)
 * @method static Contact|Proxy findOrCreate(array $attributes)
 * @method static Contact|Proxy first(string $sortedField = 'id')
 * @method static Contact|Proxy last(string $sortedField = 'id')
 * @method static Contact|Proxy random(array $attributes = [])
 * @method static Contact|Proxy randomOrCreate(array $attributes = [])
 * @method static ContactRepository|RepositoryProxy repository()
 * @method static Contact[]|Proxy[] all()
 * @method static Contact[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Contact[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Contact[]|Proxy[] findBy(array $attributes)
 * @method static Contact[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Contact[]|Proxy[] randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Contact> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Contact> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Contact> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Contact> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Contact> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Contact> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Contact> random(array $attributes = [])
 * @phpstan-method static Proxy<Contact> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Contact> repository()
 * @phpstan-method static list<Proxy<Contact>> all()
 * @phpstan-method static list<Proxy<Contact>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Contact>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<Contact>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Contact>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Contact>> randomSet(int $number, array $attributes = [])
 */
final class ContactFactory extends ModelFactory
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
            'email' => self::faker()->text(100),
            'firstName' => self::faker()->text(50),
            'gender' => self::faker()->text(50),
            'intials' => self::faker()->text(50),
            'lastName' => self::faker()->text(50),
            'telephone' => self::faker()->text(50),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Contact $contact): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Contact::class;
    }
}
