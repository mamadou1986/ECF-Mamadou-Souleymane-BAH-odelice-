<?php
/**
 * Created by PhpStorm.
 * User: Sow
 * Date: 16/08/2018
 * Time: 23:47
 */
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Tva;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
class TvaData extends AbstractFixture implements OrderedFixtureInterface
{


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tva1 = new Tva();
        $tva1->setMultiplicate('0.982');
        $tva1->setNom('TVA 1.75%');
        $tva1->setValeur('1.75');
        $manager->persist($tva1);

        $tva2 = new Tva();
        $tva2->setMultiplicate('0.833');
        $tva2->setNom('TVA 20%');
        $tva2->setValeur('20');
        $manager->persist($tva2);

        $manager->flush();

        $this->addReference('tva1', $tva1);
        $this->addReference('tva2', $tva2);

    }

    public function getOrder()
    {
        return 3;
    }
}