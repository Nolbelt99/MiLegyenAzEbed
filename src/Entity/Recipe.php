<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe extends BaseEntity
{
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    /**
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    #[ORM\Column(length: 255, name:"`lead`")]
    private ?string $lead = null;

    #[ORM\Column(nullable: true)]
    private ?int $prepTime = null;

    #[ORM\Column(nullable: true)]
    private ?int $cookTime = null;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: RecepieIngredient::class)]
    private $recepieIngredients;

    #[ORM\OneToMany(targetEntity: Instruction::class, mappedBy: 'recipe', cascade: ['persist', 'remove'])]
    #[ORM\OrderBy(['stepNumber' => 'ASC'])]
    private $instructions;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'recipes')]
    #[ORM\JoinTable(name: 'recipe_categories')]
    private Collection $categories;

    public function __construct()
    {
        $this->recepieIngredients = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->instructions = new ArrayCollection();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPrepTime(): ?int
    {
        return $this->prepTime;
    }

    public function setPrepTime(?int $prepTime): static
    {
        $this->prepTime = $prepTime;

        return $this;
    }

    public function getCookTime(): ?int
    {
        return $this->cookTime;
    }

    public function setCookTime(?int $cookTime): static
    {
        $this->cookTime = $cookTime;

        return $this;
    }

    public function getLead(): ?string
    {
        return $this->lead;
    }

    public function setLead(string $lead): static
    {
        $this->lead = $lead;

        return $this;
    }

    /**
     * @return Collection<int, RecepieIngredient>
     */
    public function getRecepieIngredients(): Collection
    {
        return $this->recepieIngredients;
    }

    public function addRecepieIngredient(RecepieIngredient $recepieIngredient): static
    {
        if (!$this->recepieIngredients->contains($recepieIngredient)) {
            $this->recepieIngredients->add($recepieIngredient);
            $recepieIngredient->setRecipe($this);
        }

        return $this;
    }

    public function removeRecepieIngredient(RecepieIngredient $recepieIngredient): static
    {
        if ($this->recepieIngredients->removeElement($recepieIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recepieIngredient->getRecipe() === $this) {
                $recepieIngredient->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Instruction>
     */
    public function getInstructions(): Collection
    {
        return $this->instructions;
    }

    public function addInstruction(Instruction $instruction): static
    {
        if (!$this->instructions->contains($instruction)) {
            $this->instructions->add($instruction);
            $instruction->setRecipe($this);
        }

        return $this;
    }

    public function removeInstruction(Instruction $instruction): static
    {
        if ($this->instructions->removeElement($instruction)) {
            // set the owning side to null (unless already changed)
            if ($instruction->getRecipe() === $this) {
                $instruction->setRecipe(null);
            }
        }

        return $this;
    }
}
