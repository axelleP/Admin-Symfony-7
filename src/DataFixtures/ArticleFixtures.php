<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Faker\Factory;
use App\Entity\Category;
use App\Entity\Article;

class ArticleFixtures extends Fixture implements FixtureGroupInterface
{
    //exécuter : php bin/console doctrine:fixtures:load --append --group=article
    public function load(ObjectManager $manager): void
    {
        $categories = $manager->getRepository(Category::class)->findAll();

        if (!$categories) {
            throw new \Exception("Aucune catégorie trouvée. Assurez-vous d'avoir chargé des catégories.");
        }

        $faker = Factory::create();

        for ($i = 0; $i < 3; $i++) { 
            $randomKey = array_rand($categories);

            $article = new Article();
            $article->setCategory($categories[$randomKey]);
            $article->setCreatedAt($faker->dateTimeBetween('now', '+1 year'));
            $article->setTitleFr($faker->word());
            $article->setTitleEn($faker->word());
            $article->setContentFr($faker->text());
            $article->setContentEn($faker->text());
            $article->setImage('1656001927_bb633eb9d4e4e96ba1ab.png');
            $manager->persist($article);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['article'];
    }
}
