<?php

namespace App\DataFixtures;

use App\Entity\Unit;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UnitFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $unit = new Unit();
        $unit->setName("gramm");
        $unit->setCode("g");
        $manager->persist($unit);

        $unit = new Unit();
        $unit->setName("dekagramm");
        $unit->setCode("dkg");
        $manager->persist($unit);

        $unit = new Unit();
        $unit->setName("kilogramm");
        $unit->setCode("kg");
        $manager->persist($unit);

        $unit = new Unit();
        $unit->setName("mililiter");
        $unit->setCode("ml");
        $manager->persist($unit);

        $unit = new Unit();
        $unit->setName("deciliter");
        $unit->setCode("dl");
        $manager->persist($unit);

        $unit = new Unit();
        $unit->setName("liter");
        $unit->setCode("l");
        $manager->persist($unit);

        $unit = new Unit();
        $unit->setName("evőkanál");
        $unit->setCode("ek");
        $manager->persist($unit);

        $unit = new Unit();
        $unit->setName("teáskanál");
        $unit->setCode("tk");
        $manager->persist($unit);

        $unit = new Unit();
        $unit->setName("csipet");
        $unit->setCode("cs");
        $manager->persist($unit);

        $manager->flush();
    }
}
