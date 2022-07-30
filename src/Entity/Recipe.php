<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;


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
    private ?string $ingredients = null;

    #[ORM\Column(length: 255)]
    private ?string $steps = null;


    #[ORM\Column(type: Types::OBJECT, nullable: true)]
    private ?object $regimeList = null;



    #[ORM\ManyToMany(targetEntity: Regime::class)]
    private Collection $regime;

    #[ORM\Column(length: 255)]
    #[Assert\Image(
        minWidth: 200,
        maxWidth: 400,
        maxHeight: 400,
        minHeight: 200,
    )]
    private ?string $picture = null;

    #[ORM\OneToMany(mappedBy: 'recip_allergene', targetEntity: Allergene::class)]
    private Collection $allergeneList;

    public function __construct()
    {
        $this->regime = new ArrayCollection();
        $this->allergeneList = new ArrayCollection();
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

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(string $ingredients): self
    {
        $this->ingredients = $ingredients;

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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture($picture = null)
    {
        $this->picture = $picture;

        return $this;
    }
    public function __toString()
    {
        return $this->title;
    }

    /**
     * @return Collection<int, Allergene>
     */
    public function getAllergeneList(): Collection
    {
        return $this->allergeneList;
    }

    public function addAllergeneList(Allergene $allergeneList): self
    {
        if (!$this->allergeneList->contains($allergeneList)) {
            $this->allergeneList[] = $allergeneList;
            $allergeneList->setRecipAllergene($this);
        }

        return $this;
    }

    public function removeAllergeneList(Allergene $allergeneList): self
    {
        if ($this->allergeneList->removeElement($allergeneList)) {
            // set the owning side to null (unless already changed)
            if ($allergeneList->getRecipAllergene() === $this) {
                $allergeneList->setRecipAllergene(null);
            }
        }

        return $this;
    }

}
