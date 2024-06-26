<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Subsidiary\Entity;

use App\BankAccount\Entity\BankAccount;
use App\Subsidiary\Repository\SubsidiaryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubsidiaryRepository::class)]
class Subsidiary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 100)]
    private string $code;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column]
    private bool $active = false;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $zipCode = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 50)]
    private ?string $country = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $website = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $abbreviationName = null;

    /**
     * @var Collection<int, BankAccount>
     */
    #[ORM\OneToMany(mappedBy: 'subsidiary', targetEntity: BankAccount::class,cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $bankAccounts;

    public function __construct()
    {
        $this->bankAccounts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): static
    {
        $this->website = $website;

        return $this;
    }

    public function getAbbreviationName(): ?string
    {
        return $this->abbreviationName;
    }

    public function setAbbreviationName(?string $abbreviationName): static
    {
        $this->abbreviationName = $abbreviationName;

        return $this;
    }

    /**
     * @return Collection<int, BankAccount>
     */
    public function getBankAccounts(): Collection
    {
        return $this->bankAccounts;
    }
    public function setBankAccounts(array $bankAccounts): void
    {
        $bankAccounts = new ArrayCollection($bankAccounts);
        foreach ($bankAccounts as $contact) {
            if (!$this->bankAccounts->contains($contact)) {
                $this->addBankAccount($contact);
            }
        }
        foreach ($this->bankAccounts as $existingAccount) {
            if (!$bankAccounts->contains($existingAccount)) {
                $this->bankAccounts->removeElement($existingAccount);
            }
        }
    }

    public function addBankAccount(BankAccount $bankAccount): static
    {
        if (!$this->bankAccounts->contains($bankAccount)) {
            $this->bankAccounts->add($bankAccount);
            $bankAccount->setSubsidiary($this);
        }

        return $this;
    }

    public function removeBankAccount(BankAccount $bankAccount): static
    {
        if ($this->bankAccounts->removeElement($bankAccount)) {
            // set the owning side to null (unless already changed)
            if ($bankAccount->getSubsidiary() === $this) {
                $bankAccount->setSubsidiary(null);
            }
        }

        return $this;
    }
}
