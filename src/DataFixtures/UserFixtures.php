<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use App\Entity\User;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    //exécuter : php bin/console doctrine:fixtures:load --append --group=user
    public function load(ObjectManager $manager): void
    {
        $factory = new PasswordHasherFactory(['common' => ['algorithm' => 'bcrypt']]);
        $hasher = $factory->getPasswordHasher('common');
        $hash = $hasher->hash('password');

        $user = new User();
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setEmail('admin_test@gmail.com');
        $user->setPassword($hash);
        $manager->persist($user);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['user'];
    }
}
