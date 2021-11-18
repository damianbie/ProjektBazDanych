<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\DataFixtures\WorkerFixtures;


class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $_pass;

    public function __construct(UserPasswordHasherInterface $pass)
    {
        $this->_pass = $pass;
    }
    private function _createUser(array $data): User
    {
        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword($this->_pass->hashPassword($user, $data['pass']));
        $user->setRoles($data['roles']);
        $user->setWorker($data['worker']);
        $user->setAccountCreaterAt(new \DateTimeImmutable('now'));

        return $user;
    }
    public function load(ObjectManager $manager): void
    {
        $user = $this->_createUser(array(
            'email'     => 'damianb121@gmail.com',
            'pass'      => 'admin',
            'roles'     => ['ROLE_ADMIN'],
            'worker'    => $this->getReference(WorkerFixtures::ADMIN_USER),
        ));
        $manager->persist($user);
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            WorkerFixtures::class,
        ];
    }
}
