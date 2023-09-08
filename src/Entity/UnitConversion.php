<?php

namespace App\Entity;

use App\Repository\UnitConversionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnitConversionRepository::class)]
class UnitConversion extends BaseEntity
{
    #[ORM\ManyToOne(targetEntity: Unit::class, inversedBy: 'fromUnitConversions')]
    #[ORM\JoinColumn(name: 'from_unit_id', referencedColumnName: 'id')]
    private $fromUnit;

    #[ORM\ManyToOne(targetEntity: Unit::class, inversedBy: 'toUnitConversions')]
    #[ORM\JoinColumn(name: 'to_unit_id', referencedColumnName: 'id')]
    private $toUnit;

    #[ORM\Column]
    private ?float $conversionFactor = null;


    public function getFromUnit(): ?Unit
    {
        return $this->fromUnit;
    }

    public function setFromUnit(?Unit $fromUnit): static
    {
        $this->fromUnit = $fromUnit;

        return $this;
    }

    public function getToUnit(): ?Unit
    {
        return $this->toUnit;
    }

    public function setToUnit(?Unit $toUnit): static
    {
        $this->toUnit = $toUnit;

        return $this;
    }

    public function getConversionFactor(): ?float
    {
        return $this->conversionFactor;
    }

    public function setConversionFactor(float $conversionFactor): static
    {
        $this->conversionFactor = $conversionFactor;

        return $this;
    }
}
