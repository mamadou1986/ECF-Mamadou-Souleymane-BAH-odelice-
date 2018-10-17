<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 17/08/2018
 * Time: 14:27
 */

namespace Blog\BlogBundle\DataFixtures\ORM;


use Blog\BlogBundle\Entity\Article;
use Blog\BlogBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CommentFixture extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $numberOfArticles = 150;

        for($i=0; $i < $numberOfArticles; $i++){
            $numberOfComments = mt_rand(0, 30);

            for($k=0; $k < $numberOfComments; $k++){

                /**
                 * @var Article
                 */
                $article = $this->getReference("article_$i");
                /**
                 * @var \DateTime
                 */
                $publishedAt = $article->getCreatedAt();

                $commentDate = $publishedAt->add(new \DateInterval("P".mt_rand(0,30)."D"));

                $comment = new Comment();
                $comment ->setEmail($faker->email)
                        ->setCommentText($faker->text(200))
                        ->setArticle($article)
                        ->setCreatedAt($commentDate);
                $manager->persist($comment);
            }
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
        return 10;
    }
}