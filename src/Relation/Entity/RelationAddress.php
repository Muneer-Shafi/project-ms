<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\Entity;

use App\Relation\Repository\RelationAddressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'address')]
#[ORM\Entity(repositoryClass: RelationAddressRepository::class,)]
class RelationAddress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addressLine1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addressLine2 = null;

    #[ORM\Column(length: 30)]
    private ?string $pinCode = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 100)]
    private ?string $country = '';

    #[ORM\ManyToOne(inversedBy: 'addresses')]
    private ?Relation $relation = null;

    
   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddressLine1(): ?string
    {
        return $this->addressLine1;
    }

    public function setAddressLine1(?string $addressLine1): self
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    public function getAddressLine2(): ?string
    {
        return $this->addressLine2;
    }

    public function setAddressLine2(?string $addressLine2): self
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    public function getPinCode(): ?string
    {
        return $this->pinCode;
    }

    public function setPinCode(string $pinCode): self
    {
        $this->pinCode = $pinCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }
    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getRelation(): ?Relation
    {
        return $this->relation;
    }

    public function setRelation(?Relation $relation): self
    {
        $this->relation = $relation;

        return $this;
    }

    public static function create(
        string $name,
        string $addressLine1,
        string $addressLine2,
        string $city,
        string $pinCode,
        string $country
    ): self {
        $address = new self();
        $address->name = $name;
        $address->addressLine2 = $addressLine2;
        $address->addressLine1 = $addressLine1;
        $address->city = $city;
        $address->pinCode = $pinCode;
        $address->country = $country;
        return  $address;
    }
}
