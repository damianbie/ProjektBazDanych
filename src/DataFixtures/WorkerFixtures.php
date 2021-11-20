<?php
namespace App\DataFixtures;

use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class WorkerFixtures extends Fixture implements DependentFixtureInterface
{
    public const ADMIN_USER = "admin-user";

    public $_faker;

    public function __construct()
    {
        $this->_faker = Factory::create('pl_PL');
    }

    private function _createWorker(array $data): Worker
    {
        $worker = new Worker();
        $worker->setName($data['name']);
        $worker->setSurname($data['surname']);
        $worker->setBirthDate($data['birthDate']);
        $worker->setWorkPlace($data['workPlace']);
        $worker->setHiredAt($data['hiredAt']);
        $worker->setPhoneNumber($this->_faker->phoneNumber());

        return $worker;
    }

    public function load(ObjectManager $manager): void
    {
        $worker = $this->_createWorker(array(
            'name'          => 'Damian',
            'surname'       => 'Bielecki',
            'birthDate'     => new \DateTime('now'),
            'workPlace'     => $this->getReference(WorkPlaceFixtures::WORKPLACE_BOSS),
            'hiredAt'       => new \DateTimeImmutable('now'),
        ));

        $manager->persist($worker);

        for ($i = 0; $i<5; $i+=1)
        {
            $worker1 = $this->_createWorker(array(
                'name'          => $this->_faker->firstName,
                'surname'       => $this->_faker->lastName,
                'birthDate'     => $this->_faker->dateTime($max='now'),
                'workPlace'     => $this->getReference(WorkPlaceFixtures::WORKPLACE_MECHANIC),
                'hiredAt'       => \DateTimeImmutable::createFromMutable($this->_faker->dateTime($max='now')),
            ));
            $manager->persist($worker1);
        }

        $manager->flush();

        $this->setReference(self::ADMIN_USER, $worker);
    }

    public function getDependencies()
    {
     return array(
       WorkPlaceFixtures::class,
     );
    }
}