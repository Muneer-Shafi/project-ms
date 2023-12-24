<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Entity;

use App\Common\Trait\TimestampableEntity;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $gnCode = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $hsCode = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $tarifCode = null;

    #[ORM\Column]
    private ?bool $isLiquid = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $brand = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $productSpecification = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProductGroup $productGroup = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
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

    public function getGnCode(): ?string
    {
        return $this->gnCode;
    }

    public function setGnCode(?string $gnCode): self
    {
        $this->gnCode = $gnCode;

        return $this;
    }

    public function getHsCode(): ?string
    {
        return $this->hsCode;
    }

    public function setHsCode(?string $hsCode): self
    {
        $this->hsCode = $hsCode;

        return $this;
    }

    public function getTarifCode(): ?string
    {
        return $this->tarifCode;
    }

    public function setTarifCode(?string $tarifCode): self
    {
        $this->tarifCode = $tarifCode;

        return $this;
    }

    public function isIsLiquid(): ?bool
    {
        return $this->isLiquid;
    }

    public function setIsLiquid(bool $isLiquid): self
    {
        $this->isLiquid = $isLiquid;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getProductSpecification(): ?string
    {
        return $this->productSpecification;
    }

    public function setProductSpecification(?string $productSpecification): self
    {
        $this->productSpecification = $productSpecification;

        return $this;
    }

    public function getProductGroup(): ?ProductGroup
    {
        return $this->productGroup;
    }

    public function setProductGroup(?ProductGroup $productGroup): self
    {
        $this->productGroup = $productGroup;

        return $this;
    }
}
