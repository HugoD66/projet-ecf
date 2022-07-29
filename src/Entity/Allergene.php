<?php

namespace App\Entity;

use App\Repository\AllergeneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AllergeneRepository::class)]
class Allergene
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Recipe::class, inversedBy: 'allergene')]
    private Collection $title;

    #[ORM\ManyToOne(inversedBy: 'allergenes')]
    private ?User $userAllergene = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    public function __construct()
    {
        $this->title = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getTitle(): Collection
    {
        return $this->title;
    }

    public function addTitle(Recipe $title): self
   {
        if (!$this->title->contains($title)) {
            $this->title[] = $title;
        }

        return $this;
    }


    public function removeTitle(Recipe $title): self
    {
        $this->title->removeElement($title);

        return $this;
    }

    public function getUserAllergene(): ?User
    {
        return $this->userAllergene;
    }

    public function setUserAllergene(?User $userAllergene): self
    {
        $this->userAllergene = $userAllergene;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setTitle(string $string)
    {
        return $this->title;

    }

}
