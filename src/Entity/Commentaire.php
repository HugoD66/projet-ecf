<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Count(min: 0, max: 5)]
    private ?int $note = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $note_at = null;

    #[ORM\OneToOne(inversedBy: 'commentaire', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $username = null;

    #[ORM\OneToMany(mappedBy: 'commentaire', targetEntity: Recipe::class)]
    private Collection $recipe_commentaire;

    public function __construct()
    {
        $this->recipe_commentaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getNoteAt(): ?\DateTimeImmutable
    {
        return $this->note_at;
    }

    public function setNoteAt(\DateTimeImmutable $note_at): self
    {
        $this->note_at = $note_at;

        return $this;
    }

    public function getUsername(): ?User
    {
        return $this->username;
    }

    public function setUsername(User $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getRecipeCommentaire(): Collection
    {
        return $this->recipe_commentaire;
    }

    public function addRecipeCommentaire(Recipe $recipeCommentaire): self
    {
        if (!$this->recipe_commentaire->contains($recipeCommentaire)) {
            $this->recipe_commentaire[] = $recipeCommentaire;
            $recipeCommentaire->setCommentaire($this);
        }

        return $this;
    }

    public function removeRecipeCommentaire(Recipe $recipeCommentaire): self
    {
        if ($this->recipe_commentaire->removeElement($recipeCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($recipeCommentaire->getCommentaire() === $this) {
                $recipeCommentaire->setCommentaire(null);
            }
        }

        return $this;
    }
}
