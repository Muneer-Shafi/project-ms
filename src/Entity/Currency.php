<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Entity;

use App\Relation\Entity\Relation;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 50)]
    private string $code;

    #[ORM\Column(length: 10, nullable: true)]
    private string $symbol;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $remarks = null;

    #[ORM\OneToOne(mappedBy: 'currency', cascade: ['persist', 'remove'])]
    private ?Relation $relation = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(?string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(?string $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
    }
}
