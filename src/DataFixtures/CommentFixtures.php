<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Faker\Factory;
use App\Entity\Article;
use App\Entity\Comment;

class CommentFixtures extends Fixture implements FixtureGroupInterface
{
    //exécuter : php bin/console doctrine:fixtures:load --append --group=comment
    public function load(ObjectManager $manager): void
    {
        $articles = $manager->getRepository(Article::class)->findAll();

        if (!$articles) {
            throw new \Exception("Aucun article trouvé. Assurez-vous d'avoir chargé des articles.");
        }

        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) { 
            $randomKey = array_rand($articles);

            $comment = new Comment();
            $comment->setArticle($articles[$randomKey]);
            $comment->setCreatedAt($faker->dateTimeBetween('now', '+1 year'));
            $comment->setPseudo($faker->name());
            $comment->setEmail($faker->email());
            $comment->setComment($faker->text());
            $manager->persist($comment);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['comment'];
    }
}
