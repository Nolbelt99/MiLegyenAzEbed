<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient extends BaseEntity
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'ingredient', targetEntity: RecepieIngredient::class)]
    private $recepieIngredients;


    public function __construct()
    {
        $this->recepieIngredients = new ArrayCollection();
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
            $recepieIngredient->setIngredient($this);
        }

        return $this;
    }

    public function removeRecepieIngredient(RecepieIngredient $recepieIngredient): static
    {
        if ($this->recepieIngredients->removeElement($recepieIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recepieIngredient->getIngredient() === $this) {
                $recepieIngredient->setIngredient(null);
            }
        }

        return $this;
    }
}
