<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe extends BaseEntity
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;
    

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
