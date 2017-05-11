<?php

namespace Gestion\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompteVoyageur
 *
 * @ORM\Table(name="compte_voyageur")
 * @ORM\Entity(repositoryClass="Gestion\GestionBundle\Repository\CompteVoyageurRepository")
 */
class CompteVoyageur {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


     /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Compagnie")
     */
    private $compagnie;

    /**
     * @ORM\OneToMany(targetEntity="Gestion\GestionBundle\Entity\Transaction", mappedBy="compteVoyageur", cascade="persist")
     */
    private $transaction;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * Constructor
     */
    public function __construct() {
        $this->transaction = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return CompteVoyageur
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return CompteVoyageur
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Add transaction
     *
     * @param \Gestion\GestionBundle\Entity\Transaction $transaction
     *
     * @return CompteVoyageur
     */
    public function addTransaction(\Gestion\GestionBundle\Entity\Transaction $transaction) {
        $this->transaction[] = $transaction;

        return $this;
    }

    /**
     * Remove transaction
     *
     * @param \Gestion\GestionBundle\Entity\Transaction $transaction
     */
    public function removeTransaction(\Gestion\GestionBundle\Entity\Transaction $transaction) {
        $this->transaction->removeElement($transaction);
    }

    /**
     * Get transaction
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransaction() {
        return $this->transaction;
    }


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return CompteVoyageur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return CompteVoyageur
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set compagnie
     *
     * @param \Gestion\GestionBundle\Entity\Compagnie $compagnie
     *
     * @return CompteVoyageur
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
