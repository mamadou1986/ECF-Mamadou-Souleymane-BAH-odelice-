<?php
/**
 * Created by PhpStorm.
 * User: Sow
 * Date: 16/08/2018
 * Time: 23:37
 */
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\commandes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class commandesData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $commande1 = new commandes();
        $commande1->setUser($this->getReference('utilisateur1'));
        $commande1->setValider('1');
        $commande1->setDate(new \DateTime());
        $commande1->setReference('1');
        $commande1->setProduits(array('0' => array('1' => '2'),
            '1' => array('2' => '1'),
            '2' => array('4' => '5')
        ));
        $manager->persist($commande1);

        $commande2 = new commandes();
        $commande2->setUser($this->getReference('utilisateur3'));
        $commande2->setValider('1');
        $commande2->setDate(new \DateTime());
        $commande2->setReference('2');
        $commande2->setProduits(array('0' => array('1' => '2'),
            '1' => array('2' => '1'),
            '2' => array('4' => '5')
        ));
        $manager->persist($commande2);
        $manager->flush();

    }

    public function getOrder()
    {
        return 7;
    }
}