<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Factory;

use App\Relation\Domain\Entity\RelationContact;
use Zenstruck\Foundry\ModelFactory;

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

    protected function getDefaults(): array
    {
        return [
            'email' => self::faker()->email(),
            'firstName' => self::faker()->firstName(),
            'gender' => self::faker()->randomElement(['Male', 'Female']),
            'initials' => self::faker()->randomElement(['Mr', 'Mrs', 'Sir']),
            'lastName' => self::faker()->lastName(),
            'telephone' => self::faker()->phoneNumber(50),
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
        return RelationContact::class;
    }
}
