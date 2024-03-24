<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\Domain\Entity;

use App\Entity\Contract;
use App\Entity\Currency;
use App\Relation\DTO\RelationDTO;
use App\Relation\Service\RelationRepository;
use App\Subsidiary\Entity\Subsidiary;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelationRepository::class)]
class Relation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 200)]
    private string $name;

    #[ORM\Column(length: 100)]
    private string $shortName;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $cocNumber = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $remarks = null;

    #[ORM\OneToOne(inversedBy: 'relation', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Currency $currency = null;

    #[ORM\OneToMany(mappedBy: 'relation', targetEntity: RelationContact::class,cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $contacts;

    #[ORM\OneToMany(mappedBy: 'relation', targetEntity: RelationAddress::class)]
    private Collection $addresses;

    #[ORM\ManyToOne()]
    public ?Subsidiary $subsidiary = null;



    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->addresses = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function getCocNumber(): ?string
    {
        return $this->cocNumber;
    }

    public function setCocNumber(?string $cocNumber): self
    {
        $this->cocNumber = $cocNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getContacts(): Collection
    {
        return $this->contacts;
    }
    public function setContacts(array $contacts): void
    {
        $contacts = new ArrayCollection($contacts);
        foreach ($contacts as $contact) {
            if (!$this->contacts->contains($contact)) {
                $this->addContact($contact);
            }
        }
        foreach ($this->contacts as $existingContact) {
            if (!$contacts->contains($existingContact)) {
                $this->contacts->removeElement($existingContact);
            }
        }
    }
    public function setAddresses(array $addresses): void
    {
        $addresses = new ArrayCollection($addresses);
        foreach ($addresses as $address) {
            if (!$this->addresses->contains($address)) {
                $this->addContact($address);
            }
        }
        foreach ($this->addresses as $existingAddress) {
            if (!$addresses->contains($existingAddress)) {
                $this->addresses->removeElement($existingAddress);
            }
        }
    }

    public function addContact(RelationContact $contact): self
    {
        $contact->setRelation($this);
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setRelation($this);
        }

        return $this;
    }

    public function removeContact(RelationContact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            if ($contact->getRelation() === $this) {
                $contact->setRelation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(RelationAddress $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses->add($address);
            $address->setRelation($this);
        }

        return $this;
    }

    public function removeAddress(RelationAddress $address): self
    {
        if ($this->addresses->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getRelation() === $this) {
                $address->setRelation(null);
            }
        }

        return $this;
    }

    public static function  create(RelationDTO $relationDTO):self
    {
        $relation = new self();
        $relation->name= $relationDTO->relationName;
        $relation->shortName= $relationDTO->relationShortName;
        $relation->email= $relationDTO->email;
        return $relation;
    }

    /**
     * @return Collection<int, Contract>
     */
    public function getContracts(): Collection
    {
        return $this->contracts;
    }

    public function addContract(Contract $contract): static
    {
        if (!$this->contracts->contains($contract)) {
            $this->contracts->add($contract);
            $contract->setRelation($this);
        }

        return $this;
    }

    public function removeContract(Contract $contract): static
    {
        if ($this->contracts->removeElement($contract)) {
            // set the owning side to null (unless already changed)
            if ($contract->getRelation() === $this) {
                $contract->setRelation(null);
            }
        }

        return $this;
    }
}
