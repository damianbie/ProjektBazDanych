<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Client;
use Faker\Factory;

class ClientFixtures extends Fixture
{
    public $_faker;

    public function __construct()
    {
        $this->_faker = Factory::create('pl_PL');
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i<300; $i+=1)
        {
            $cl = new Client();
            if(rand($min=0, $max=1) == 0)
            {
                $cl->setName($this->_faker->firstName);
                $cl->setSurname($this->_faker->lastName);
                $cl->setPesel($this->_faker->pesel);
                $cl->setIsCompany(false);
            }
            else
            {
                $cl->setName($this->_faker->company);
                $cl->setNip($this->_faker->taxpayerIdentificationNumber);
                $cl->setRegon($this->_faker->regon);
                $cl->setIsCompany(true);
            }

            $cl->setPhoneNumber($this->_faker->phoneNumber);
            $cl->setAddedAt(\DateTimeImmutable::createFromMutable($this->_faker->dateTime($max='now')));
            $manager->persist($cl);
        }
        $manager->flush();
    }
}