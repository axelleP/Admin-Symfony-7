<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Faker\Factory;
use App\Entity\Page;

class PageFixtures extends Fixture implements FixtureGroupInterface
{
    //exécuter : php bin/console doctrine:fixtures:load --append --group=page
    public function load(ObjectManager $manager): void
    {
        $pages = ['ABOUT', 'LEGAL_INFO'];

        $faker = Factory::create();
        
        foreach ($pages as $data) {
            $page = new Page();
            $page->setCode($data);
            $page->setContentFr($faker->text());
            $page->setContentEn($faker->text());
            $manager->persist($page);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['page'];
    }
}
