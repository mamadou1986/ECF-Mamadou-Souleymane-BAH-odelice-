<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 17/08/2018
 * Time: 12:18
 */

namespace Blog\BlogBundle\DataFixtures\ORM;


use Blog\BlogBundle\Entity\Article;
use Blog\BlogBundle\Entity\Author;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class AuthorArticleFixture extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $emailList = [
            "user1@mail.com",
            "user2@mail.com",
            "user3@mail.com",
            "user4@mail.com",
            "user5@mail.com"
        ];

        $authors = [];

        $numberOfArticles = 150;

        for ($i = 0; $i < count($emailList); $i++) {
            $authors[] = new Author();
            $authors[$i]->setEmail($emailList[$i])
                ->setFirstName($faker->firstName)
                ->setName($faker->lastName);
            $manager->persist($authors[$i]);
        }

        for ($i = 0; $i < $numberOfArticles; $i++) {
            $article = new Article();
            $article->setTitle($faker->jobTitle)
                ->setText($faker->text(2500))
                ->setAuthor($authors[mt_rand(0, count($authors) - 1)])
                ->setCreatedAt($faker->dateTimeThisDecade());

            $this->setReference("article_$i", $article);

            $manager->persist($article);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}