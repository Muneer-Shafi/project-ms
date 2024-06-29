<?php

declare(strict_types=1);

namespace App\Subsidiary\DTO;

use ApiPlatform\Doctrine\Odm\State\Options;
use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Doctrine\Orm\State\Options as StateOptions;
use ApiPlatform\Metadata\ApiResource;
use App\Subsidiary\Entity\Subsidiary;

#[ApiResource(
    shortName: 'subsidiary',
    provider: CollectionProvider::class,

    stateOptions: new StateOptions(
        entityClass: Subsidiary::class
    ),
)]
class SubsidiaryDTO
{
    public string $name;
    public string $code;
    public string $city;
    public string $country;
    public string $website;
    public string $zipCode;
  
}
