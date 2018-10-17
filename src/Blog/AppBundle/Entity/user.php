<?php
/**
 * Created by PhpStorm.
 * User: Sow
 * Date: 16/08/2018
 * Time: 04:04
 */
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class user extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->commandes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->adresse = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\commandes",mappedBy="user",cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\userAdress",mappedBy="user",cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $adresse;


    /**
     * Add commande
     *
     * @param \AppBundle\Entity\commandes $commande
     *
     * @return user
     */
    public function addCommande(\AppBundle\Entity\commandes $commande)
    {
        $this->commandes[] = $commande;

        return $this;
    }

    /**
     * Remove commande
     *
     * @param \AppBundle\Entity\commandes $commande
     */
    public function removeCommande(\AppBundle\Entity\commandes $commande)
    {
        $this->commandes->removeElement($commande);
    }

    /**
     * Get commandes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    /**
     * Add adresse
     *
     * @param \AppBundle\Entity\userAdress $adresse
     *
     * @return user
     */
    public function addAdresse(\AppBundle\Entity\userAdress $adresse)
    {
        $this->adresse[] = $adresse;

        return $this;
    }

    /**
     * Remove adresse
     *
     * @param \AppBundle\Entity\userAdress $adresse
     */
    public function removeAdresse(\AppBundle\Entity\userAdress $adresse)
    {
        $this->adresse->removeElement($adresse);
    }

    /**
     * Get adresse
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}
