<?php
/**
 * Created by PhpStorm.
 * User: Sow
 * Date: 16/08/2018
 * Time: 23:52
 */
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\userAdress;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class userAdressData extends AbstractFixture implements OrderedFixtureInterface
{


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $adresse1 = new userAdress();
        $adresse1->setUser($this->getReference('utilisateur1'));
        $adresse1->setNom('Catelain');
        $adresse1->setPrenom('Benjamin');
        $adresse1->setTelephone('0600000000');
        $adresse1->setAdresse('3 rue alberta rubosca');
        $adresse1->setCp('76600');
        $adresse1->setPays('France');
        $adresse1->setVille('Le Havre');
        $adresse1->setComplement('face à l\'église');
        $manager->persist($adresse1);

        $adresse2 = new userAdress();
        $adresse2->setUser($this->getReference('utilisateur3'));
        $adresse2->setNom('premier');
        $adresse2->setPrenom('albert');
        $adresse2->setTelephone('0600000000');
        $adresse2->setAdresse('5 rue rubosca');
        $adresse2->setCp('76600');
        $adresse2->setPays('France');
        $adresse2->setVille('Le Havre');
        $adresse2->setComplement('face à la plage');
        $manager->persist($adresse2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}
