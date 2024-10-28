<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Adresse $adresses = null;

    /**
     * @var Collection<int, Dette>
     */
    #[ORM\OneToMany(targetEntity: Dette::class, mappedBy: 'client')]
    private Collection $detteClies;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $users = null;

    public function __construct()
    {
        $this->detteClies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresses(): ?Adresse
    {
        return $this->adresses;
    }

    public function setAdresses(?Adresse $adresses): static
    {
        $this->adresses = $adresses;

        return $this;
    }

    /**
     * @return Collection<int, Dette>
     */
    public function getDetteClies(): Collection
    {
        return $this->detteClies;
    }

    public function addDetteCly(Dette $detteCly): static
    {
        if (!$this->detteClies->contains($detteCly)) {
            $this->detteClies->add($detteCly);
            $detteCly->setClient($this);
        }

        return $this;
    }

    public function removeDetteCly(Dette $detteCly): static
    {
        if ($this->detteClies->removeElement($detteCly)) {
            // set the owning side to null (unless already changed)
            if ($detteCly->getClient() === $this) {
                $detteCly->setClient(null);
            }
        }

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): static
    {
        $this->users = $users;

        return $this;
    }
}
