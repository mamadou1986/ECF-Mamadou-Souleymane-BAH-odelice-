<?php
/**
 * Created by PhpStorm.
 * User: Sow
 * Date: 16/08/2018
 * Time: 23:04
 */
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Ingredient;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class IngredientData extends AbstractFixture implements OrderedFixtureInterface
{


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $ingredient1 = new Ingredient();
        $ingredient1->setNom('Légumes');
        $ingredient1->setImage($this->getReference('media1'));
        $manager->persist($ingredient1);

        $ingredient2 = new Ingredient();
        $ingredient2->setNom('fruits');
        $ingredient2->setImage($this->getReference('media2'));
        $manager->persist($ingredient2);

        $manager->flush();

        $this->addReference('ingredient1', $ingredient1);
        $this->addReference('ingredient2', $ingredient2);

    }

    public function getOrder()
    {
        return 2;
    }

}