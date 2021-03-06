<?php

namespace Gestion\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="Gestion\GestionBundle\Repository\TransactionRepository")
 */
class Transaction {

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
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\CompteVoyageur", inversedBy="transaction", cascade="persist")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compteVoyageur;

    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Voyage", inversedBy="transaction")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voyage;

    /**
     * @var float
     *
     * @ORM\Column(name="pu", type="float", nullable=true)
     */
    private $pu;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", nullable=true)
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255, nullable=true)
     */
    private $reference;

    /**
     * @var int
     *
     * @ORM\Column(name="places", type="integer", nullable=true)
     */
    private $places;

    /**
     * @var string
     *
     * @ORM\Column(name="operateur", type="string", length=255, nullable=true)
     */
    private $operateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=255, nullable=true)
     */
    private $info;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=true)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="testSMSSend", type="string", length=255, nullable=true)
     */
    private $testSMSSend;

    /**
     * @var string
     *
     * @ORM\Column(name="testEmailSend", type="string", length=255, nullable=true)
     */
    private $testEmailSend;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pu
     *
     * @param float $pu
     *
     * @return Transaction
     */
    public function setPu($pu)
    {
        $this->pu = $pu;

        return $this;
    }

    /**
     * Get pu
     *
     * @return float
     */
    public function getPu()
    {
        return $this->pu;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return Transaction
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Transaction
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set places
     *
     * @param integer $places
     *
     * @return Transaction
     */
    public function setPlaces($places)
    {
        $this->places = $places;

        return $this;
    }

    /**
     * Get places
     *
     * @return integer
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Set operateur
     *
     * @param string $operateur
     *
     * @return Transaction
     */
    public function setOperateur($operateur)
    {
        $this->operateur = $operateur;

        return $this;
    }

    /**
     * Get operateur
     *
     * @return string
     */
    public function getOperateur()
    {
        return $this->operateur;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Transaction
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set info
     *
     * @param string $info
     *
     * @return Transaction
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Transaction
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set testSMSSend
     *
     * @param string $testSMSSend
     *
     * @return Transaction
     */
    public function setTestSMSSend($testSMSSend)
    {
        $this->testSMSSend = $testSMSSend;

        return $this;
    }

    /**
     * Get testSMSSend
     *
     * @return string
     */
    public function getTestSMSSend()
    {
        return $this->testSMSSend;
    }

    /**
     * Set testEmailSend
     *
     * @param string $testEmailSend
     *
     * @return Transaction
     */
    public function setTestEmailSend($testEmailSend)
    {
        $this->testEmailSend = $testEmailSend;

        return $this;
    }

    /**
     * Get testEmailSend
     *
     * @return string
     */
    public function getTestEmailSend()
    {
        return $this->testEmailSend;
    }

    /**
     * Set compteVoyageur
     *
     * @param \Gestion\GestionBundle\Entity\CompteVoyageur $compteVoyageur
     *
     * @return Transaction
     */
    public function setCompteVoyageur(\Gestion\GestionBundle\Entity\CompteVoyageur $compteVoyageur)
    {
        $this->compteVoyageur = $compteVoyageur;

        return $this;
    }

    /**
     * Get compteVoyageur
     *
     * @return \Gestion\GestionBundle\Entity\CompteVoyageur
     */
    public function getCompteVoyageur()
    {
        return $this->compteVoyageur;
    }

    /**
     * Set voyage
     *
     * @param \Gestion\GestionBundle\Entity\Voyage $voyage
     *
     * @return Transaction
     */
    public function setVoyage(\Gestion\GestionBundle\Entity\Voyage $voyage)
    {
        $this->voyage = $voyage;

        return $this;
    }

    /**
     * Get voyage
     *
     * @return \Gestion\GestionBundle\Entity\Voyage
     */
    public function getVoyage()
    {
        return $this->voyage;
    }

    /**
     * Set compagnie
     *
     * @param \Gestion\GestionBundle\Entity\Compagnie $compagnie
     *
     * @return Transaction
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
