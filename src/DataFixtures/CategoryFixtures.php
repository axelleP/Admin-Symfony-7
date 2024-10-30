<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use App\Entity\Category;

class CategoryFixtures extends Fixture implements FixtureGroupInterface
{
    //exécuter : php bin/console doctrine:fixtures:load --append --group=category
    public function load(ObjectManager $manager): void
    {
        $categories = [
            [
                'code' => 'CAT1',
                'nameFr' => 'Catégorie1',
                'nameEn' => 'Category1',
            ],
            [
                'code' => 'CAT2',
                'nameFr' => 'Catégorie2',
                'nameEn' => 'Category2',
            ],
            [
                'code' => 'CAT3',
                'nameFr' => 'Catégorie3',
                'nameEn' => 'Category3',
            ]
        ];

        $position = 1;
        foreach ($categories as $data) {
            $category = new Category();
            $category->setCode($data['code']);
            $category->setPosition($position++);
            $category->setNameFr($data['nameFr']);
            $category->setNameEn($data['nameEn']);
            $manager->persist($category);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['category'];
    }
}
