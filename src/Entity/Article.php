<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    /**
     * @var Collection<int, Dette>
     */
    #[ORM\ManyToMany(targetEntity: Dette::class, inversedBy: 'articles')]
    private Collection $detteArt;

    public function __construct()
    {
        $this->detteArt = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection<int, Dette>
     */
    public function getDetteArt(): Collection
    {
        return $this->detteArt;
    }

    public function addDetteArt(Dette $detteArt): static
    {
        if (!$this->detteArt->contains($detteArt)) {
            $this->detteArt->add($detteArt);
        }

        return $this;
    }

    public function removeDetteArt(Dette $detteArt): static
    {
        $this->detteArt->removeElement($detteArt);

        return $this;
    }
}
