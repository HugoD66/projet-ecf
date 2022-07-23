<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $cookingTime = null;

    #[ORM\Column]
    private ?int $cookingRest = null;

    #[ORM\Column]
    private ?int $heatTime = null;

    #[ORM\Column(length: 255)]
    private ?string $ingrédients = null;

    #[ORM\Column(length: 255)]
    private ?string $steps = null;



    #[ORM\Column(type: Types::OBJECT, nullable: true)]
    private ?object $regimeList = null;

    #[ORM\ManyToMany(targetEntity: Allergene::class, mappedBy: 'title')]
    private Collection $allergene;

    #[ORM\ManyToMany(targetEntity: Regime::class)]
    private Collection $regime;

    public function __construct()
    {
        $this->allergene = new ArrayCollection();
        $this->regime = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getCookingTime(): ?int
    {
        return $this->cookingTime;
    }

    public function setCookingTime(int $cookingTime): self
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    public function getCookingRest(): ?int
    {
        return $this->cookingRest;
    }

    public function setCookingRest(int $cookingRest): self
    {
        $this->cookingRest = $cookingRest;

        return $this;
    }

    public function getHeatTime(): ?int
    {
        return $this->heatTime;
    }

    public function setHeatTime(int $heatTime): self
    {
        $this->heatTime = $heatTime;

        return $this;
    }

    public function getIngrédients(): ?string
    {
        return $this->ingrédients;
    }

    public function setIngrédients(string $ingrédients): self
    {
        $this->ingrédients = $ingrédients;

        return $this;
    }

    public function getSteps(): ?string
    {
        return $this->steps;
    }

    public function setSteps(string $steps): self
    {
        $this->steps = $steps;

        return $this;
    }


    public function getRegimeList(): ?object
    {
        return $this->regimeList;
    }

    public function setRegimeList(?object $regimeList): self
    {
        $this->regimeList = $regimeList;

        return $this;
    }

    /**
     * @return Collection<int, Allergene>
     */
    public function getAllergene(): Collection
    {
        return $this->allergene;
    }

    public function addAllergene(Allergene $allergene): self
    {
        if (!$this->allergene->contains($allergene)) {
            $this->allergene[] = $allergene;
            $allergene->addTitle($this);
        }

        return $this;
    }

    public function removeAllergene(Allergene $allergene): self
    {
        if ($this->allergene->removeElement($allergene)) {
            $allergene->removeTitle($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Regime>
     */
    public function getRegime(): Collection
    {
        return $this->regime;
    }

    public function addRegime(Regime $regime): self
    {
        if (!$this->regime->contains($regime)) {
            $this->regime[] = $regime;
        }

        return $this;
    }

    public function removeRegime(Regime $regime): self
    {
        $this->regime->removeElement($regime);

        return $this;
    }
}
