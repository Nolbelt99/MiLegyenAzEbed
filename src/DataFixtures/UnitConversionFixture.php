<?php

namespace App\DataFixtures;

use App\Entity\Unit;
use App\Entity\UnitConversion;
use App\DataFixtures\UnitFixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UnitConversionFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $unitConversion = new UnitConversion();
        $unitConversion->setFromUnit($manager->getRepository(Unit::class)->findOneBy(['code' => 'g']));
        $unitConversion->setToUnit($manager->getRepository(Unit::class)->findOneBy(['code' => 'dkg']));
        $unitConversion->setConversionFactor(10);
        $manager->persist($unitConversion);

        $unitConversion = new UnitConversion();
        $unitConversion->setFromUnit($manager->getRepository(Unit::class)->findOneBy(['code' => 'g']));
        $unitConversion->setToUnit($manager->getRepository(Unit::class)->findOneBy(['code' => 'kg']));
        $unitConversion->setConversionFactor(1000);
        $manager->persist($unitConversion);

        $unitConversion = new UnitConversion();
        $unitConversion->setFromUnit($manager->getRepository(Unit::class)->findOneBy(['code' => 'ml']));
        $unitConversion->setToUnit($manager->getRepository(Unit::class)->findOneBy(['code' => 'dl']));
        $unitConversion->setConversionFactor(100);
        $manager->persist($unitConversion);

        $unitConversion = new UnitConversion();
        $unitConversion->setFromUnit($manager->getRepository(Unit::class)->findOneBy(['code' => 'ml']));
        $unitConversion->setToUnit($manager->getRepository(Unit::class)->findOneBy(['code' => 'l']));
        $unitConversion->setConversionFactor(1000);
        $manager->persist($unitConversion);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UnitFixture::class
        ];
    }
}
