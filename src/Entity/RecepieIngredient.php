<?php

namespace App\Entity;

use App\Repository\RecepieIngredientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecepieIngredientRepository::class)]
class RecepieIngredient extends BaseEntity
{
    #[ORM\ManyToOne(targetEntity: Recipe::class, inversedBy: 'recepieIngredients')]
    #[ORM\JoinColumn(name: 'recipe_id', referencedColumnName: 'id')]
    private $recipe;

    #[ORM\ManyToOne(targetEntity: Ingredient::class, inversedBy: 'recepieIngredients')]
    #[ORM\JoinColumn(name: 'ingredient_id', referencedColumnName: 'id')]
    private $ingredient;

    #[ORM\ManyToOne(targetEntity: Unit::class, inversedBy: 'recepieIngredients')]
    #[ORM\JoinColumn(name: 'unit_id', referencedColumnName: 'id')]
    private $unit;

    #[ORM\Column]
    private ?int $quantity = null;


    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): static
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): static
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}
