<?php

namespace Gestion\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voyage
 *
 * @ORM\Table(name="voyage")
 * @ORM\Entity(repositoryClass="Gestion\GestionBundle\Repository\VoyageRepository")
 */
class Voyage {

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
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Gare")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gare;

    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Ville")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lieuDepart;

    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Ville")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lieuArrivee;

    /**
     * @ORM\OneToMany(targetEntity="Gestion\GestionBundle\Entity\Transaction", mappedBy="voyage")
     */
    private $transaction;

    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Vehicule")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicule;

    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Conducteur")
     * @ORM\JoinColumn(nullable=true)
     */
    private $conducteur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateVoyage", type="date")
     */
        private $dateVoyage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDepart", type="time")
     */
    private $heureDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureArrivee", type="time")
     */
    private $heureArrivee;

    /**
     * @var int
     *
     * @ORM\Column(name="placesDispo", type="integer")
     */
    private $placesDispo;

    /**
     * @var float
     *
     * @ORM\Column(name="prixVoyage", type="float")
     */
    private $prixVoyage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

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
     * Set dateVoyage
     *
     * @param \DateTime $dateVoyage
     *
     * @return Voyage
     */
    public function setDateVoyage($dateVoyage)
    {
        $this->dateVoyage = $dateVoyage;

        return $this;
    }

    /**
     * Get dateVoyage
     *
     * @return \DateTime
     */
    public function getDateVoyage()
    {
        return $this->dateVoyage;
    }

    /**
     * Set heureDepart
     *
     * @param \DateTime $heureDepart
     *
     * @return Voyage
     */
    public function setHeureDepart($heureDepart)
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    /**
     * Get heureDepart
     *
     * @return \DateTime
     */
    public function getHeureDepart()
    {
        return $this->heureDepart;
    }

    /**
     * Set heureArrivee
     *
     * @param \DateTime $heureArrivee
     *
     * @return Voyage
     */
    public function setHeureArrivee($heureArrivee)
    {
        $this->heureArrivee = $heureArrivee;

        return $this;
    }

    /**
     * Get heureArrivee
     *
     * @return \DateTime
     */
    public function getHeureArrivee()
    {
        return $this->heureArrivee;
    }

    /**
     * Set placesDispo
     *
     * @param integer $placesDispo
     *
     * @return Voyage
     */
    public function setPlacesDispo($placesDispo)
    {
        $this->placesDispo = $placesDispo;

        return $this;
    }

    /**
     * Get placesDispo
     *
     * @return integer
     */
    public function getPlacesDispo()
    {
        return $this->placesDispo;
    }

    /**
     * Set prixVoyage
     *
     * @param float $prixVoyage
     *
     * @return Voyage
     */
    public function setPrixVoyage($prixVoyage)
    {
        $this->prixVoyage = $prixVoyage;

        return $this;
    }

    /**
     * Get prixVoyage
     *
     * @return float
     */
    public function getPrixVoyage()
    {
        return $this->prixVoyage;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Voyage
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
     * Set gare
     *
     * @param \Gestion\GestionBundle\Entity\Gare $gare
     *
     * @return Voyage
     */
    public function setGare(\Gestion\GestionBundle\Entity\Gare $gare)
    {
        $this->gare = $gare;

        return $this;
    }

    /**
     * Get gare
     *
     * @return \Gestion\GestionBundle\Entity\Gare
     */
    public function getGare()
    {
        return $this->gare;
    }

    /**
     * Set lieuDepart
     *
     * @param \Gestion\GestionBundle\Entity\Ville $lieuDepart
     *
     * @return Voyage
     */
    public function setLieuDepart(\Gestion\GestionBundle\Entity\Ville $lieuDepart)
    {
        $this->lieuDepart = $lieuDepart;

        return $this;
    }

    /**
     * Get lieuDepart
     *
     * @return \Gestion\GestionBundle\Entity\Ville
     */
    public function getLieuDepart()
    {
        return $this->lieuDepart;
    }

    /**
     * Set lieuArrivee
     *
     * @param \Gestion\GestionBundle\Entity\Ville $lieuArrivee
     *
     * @return Voyage
     */
    public function setLieuArrivee(\Gestion\GestionBundle\Entity\Ville $lieuArrivee)
    {
        $this->lieuArrivee = $lieuArrivee;

        return $this;
    }

    /**
     * Get lieuArrivee
     *
     * @return \Gestion\GestionBundle\Entity\Ville
     */
    public function getLieuArrivee()
    {
        return $this->lieuArrivee;
    }

    /**
     * Add transaction
     *
     * @param \Gestion\GestionBundle\Entity\Transaction $transaction
     *
     * @return Voyage
     */
    public function addTransaction(\Gestion\GestionBundle\Entity\Transaction $transaction)
    {
        $this->transaction[] = $transaction;

        return $this;
    }

    /**
     * Remove transaction
     *
     * @param \Gestion\GestionBundle\Entity\Transaction $transaction
     */
    public function removeTransaction(\Gestion\GestionBundle\Entity\Transaction $transaction)
    {
        $this->transaction->removeElement($transaction);
    }

    /**
     * Get transaction
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * Set vehicule
     *
     * @param \Gestion\GestionBundle\Entity\Vehicule $vehicule
     *
     * @return Voyage
     */
    public function setVehicule(\Gestion\GestionBundle\Entity\Vehicule $vehicule)
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * Get vehicule
     *
     * @return \Gestion\GestionBundle\Entity\Vehicule
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * Set conducteur
     *
     * @param \Gestion\GestionBundle\Entity\Conducteur $conducteur
     *
     * @return Voyage
     */
    public function setConducteur(\Gestion\GestionBundle\Entity\Conducteur $conducteur = null)
    {
        $this->conducteur = $conducteur;

        return $this;
    }

    /**
     * Get conducteur
     *
     * @return \Gestion\GestionBundle\Entity\Conducteur
     */
    public function getConducteur()
    {
        return $this->conducteur;
    }

    /**
     * Set compagnie
     *
     * @param \Gestion\GestionBundle\Entity\Compagnie $compagnie
     *
     * @return Voyage
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
