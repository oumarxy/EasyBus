<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="UsersBundle\Repository\UtilisateurRepository")
 * @UniqueEntity(fields="email", message="Ce mail existe déjà")
 */
class Utilisateur extends BaseUser {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Compagnie")
     * @ORM\JoinColumn(nullable=true)
     */
    private $compagnie;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255,nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenoms", type="string", length=255,nullable=true)
     */
    private $prenoms;

    /**
     * @var string
     *
     * @ORM\Column(name="habitation", type="string", length=255,nullable=true)
     */
    private $habitation;

    /**
     * @var string
     *
     * @ORM\Column(name="tel1", type="string", length=255,nullable=true)
     */
    private $tel1;

    /**
     * @var string
     *
     * @ORM\Column(name="tel2", type="string", length=20,nullable=true)
     */
    private $tel2;




    public function __construct() {
        parent::__construct();
        // your own logic
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Utilisateur
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set prenoms
     *
     * @param string $prenoms
     * @return Utilisateur
     */
    public function setPrenoms($prenoms) {
        $this->prenoms = $prenoms;

        return $this;
    }

    /**
     * Get prenoms
     *
     * @return string 
     */
    public function getPrenoms() {
        return $this->prenoms;
    }

    /**
     * Set habitation
     *
     * @param string $habitation
     * @return Utilisateur
     */
    public function setHabitation($habitation) {
        $this->habitation = $habitation;

        return $this;
    }

    /**
     * Get habitation
     *
     * @return string 
     */
    public function getHabitation() {
        return $this->habitation;
    }

    /**
     * Set tel1
     *
     * @param string $tel1
     * @return Utilisateur
     */
    public function setTel1($tel1) {
        $this->tel1 = $tel1;

        return $this;
    }

    /**
     * Get tel1
     *
     * @return string 
     */
    public function getTel1() {
        return $this->tel1;
    }

    /**
     * Set tel2
     *
     * @param string $tel2
     * @return Utilisateur
     */
    public function setTel2($tel2) {
        $this->tel2 = $tel2;

        return $this;
    }

    /**
     * Get tel2
     *
     * @return string 
     */
    public function getTel2() {
        return $this->tel2;
    }



    /**
     * Set compagnie
     *
     * @param \Gestion\GestionBundle\Entity\Compagnie $compagnie
     *
     * @return Utilisateur
     */
    public function setCompagnie(\Gestion\GestionBundle\Entity\Compagnie $compagnie = null)
    {
        $this->compagnie = $compagnie;

        return $this;
    }

    /**
     * Get compagnie
     *
     * @return \Gestion\GestionBundle\Entity\Compagnie
     */
    public function getCompagnie()
    {
        return $this->compagnie;
    }
}
