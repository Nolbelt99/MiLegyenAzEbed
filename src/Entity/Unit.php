<?php

namespace App\Entity;

use App\Repository\UnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnitRepository::class)]
class Unit extends BaseEntity
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 5)]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'fromUnit', targetEntity: UnitConversion::class)]
    private $fromUnitConversions;

    #[ORM\OneToMany(mappedBy: 'toUnit', targetEntity: UnitConversion::class)]
    private $toUnitConversions;
    
    #[ORM\OneToMany(mappedBy: 'unit', targetEntity: RecepieIngredient::class)]
    private $recepieIngredients;


    public function __construct()
    {
        $this->fromUnitConversions = new ArrayCollection();
        $this->toUnitConversions = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, UnitConversion>
     */
    public function getFromUnitConversions(): Collection
    {
        return $this->fromUnitConversions;
    }

    public function addFromUnitConversion(UnitConversion $fromUnitConversion): static
    {
        if (!$this->fromUnitConversions->contains($fromUnitConversion)) {
            $this->fromUnitConversions->add($fromUnitConversion);
            $fromUnitConversion->setFromUnit($this);
        }

        return $this;
    }

    public function removeFromUnitConversion(UnitConversion $fromUnitConversion): static
    {
        if ($this->fromUnitConversions->removeElement($fromUnitConversion)) {
            // set the owning side to null (unless already changed)
            if ($fromUnitConversion->getFromUnit() === $this) {
                $fromUnitConversion->setFromUnit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UnitConversion>
     */
    public function getToUnitConversions(): Collection
    {
        return $this->toUnitConversions;
    }

    public function addToUnitConversion(UnitConversion $toUnitConversion): static
    {
        if (!$this->toUnitConversions->contains($toUnitConversion)) {
            $this->toUnitConversions->add($toUnitConversion);
            $toUnitConversion->setToUnit($this);
        }

        return $this;
    }

    public function removeToUnitConversion(UnitConversion $toUnitConversion): static
    {
        if ($this->toUnitConversions->removeElement($toUnitConversion)) {
            // set the owning side to null (unless already changed)
            if ($toUnitConversion->getToUnit() === $this) {
                $toUnitConversion->setToUnit(null);
            }
        }

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
            $recepieIngredient->setUnit($this);
        }

        return $this;
    }

    public function removeRecepieIngredient(RecepieIngredient $recepieIngredient): static
    {
        if ($this->recepieIngredients->removeElement($recepieIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recepieIngredient->getUnit() === $this) {
                $recepieIngredient->setUnit(null);
            }
        }

        return $this;
    }
}
