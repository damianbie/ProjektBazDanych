<?php

namespace App\DataFixtures;

use App\Entity\WorkPlace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WorkPlaceFixtures extends Fixture
{
    public const WORKPLACE_BOSS         = "workplace-boss";
    public const WORKPLACE_MECHANIC     = "workplace-mechanic";

    public function load(ObjectManager $manager): void
    {
        $workPlace1 = new WorkPlace();
        $workPlace1->setName('Szef');
        $workPlace1->setMinEarnings(1000);

        $workPlace2 = new WorkPlace();
        $workPlace2->setName('mechanik');
        $workPlace2->setMinEarnings(200);


        $manager->persist($workPlace1);
        $manager->persist($workPlace2);
        $manager->flush();

        $this->setReference(self::WORKPLACE_BOSS, $workPlace1);
        $this->setReference(self::WORKPLACE_MECHANIC, $workPlace2);
    }
}
