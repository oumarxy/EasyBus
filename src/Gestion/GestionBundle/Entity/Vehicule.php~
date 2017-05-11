<?php

namespace Gestion\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicule
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity(repositoryClass="Gestion\GestionBundle\Repository\VehiculeRepository")
 */
class Vehicule
{
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
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=255, unique=false)
     */
    private $marque;


    /**
     * @var string
     *
     * @ORM\Column(name="immatriculation", type="string", length=255, unique=true)
     */
    private $immatriculation;


    /**
     * @var int
     *
     * @ORM\Column(name="places", type="integer", nullable=true)
     */
    private $places;


    /**
     * @var string
     *
     * @ORM\Column(name="climatisation", type="string", length=255, nullable=true)
     */
    private $climatisation;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tele", type="string", length=255, unique=false)
     */
    private $tele;
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;



    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", nullable=true)
     */
    private $path;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

 

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Vehicule
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set immatriculation
     *
     * @param string $immatriculation
     *
     * @return Vehicule
     */
    public function setImmatriculation($immatriculation)
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    /**
     * Get immatriculation
     *
     * @return string
     */
    public function getImmatriculation()
    {
        return $this->immatriculation;
    }

    /**
     * Set places
     *
     * @param integer $places
     *
     * @return Vehicule
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
     * Set climatisation
     *
     * @param string $climatisation
     *
     * @return Vehicule
     */
    public function setClimatisation($climatisation)
    {
        $this->climatisation = $climatisation;

        return $this;
    }

    /**
     * Get climatisation
     *
     * @return string
     */
    public function getClimatisation()
    {
        return $this->climatisation;
    }

    /**
     * Set tele
     *
     * @param string $tele
     *
     * @return Vehicule
     */
    public function setTele($tele)
    {
        $this->tele = $tele;

        return $this;
    }

    /**
     * Get tele
     *
     * @return string
     */
    public function getTele()
    {
        return $this->tele;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Vehicule
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
     * Set path
     *
     * @param string $path
     *
     * @return Vehicule
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
	
	public function __toString(){
		return $this->getImmatriculation();
	}

    /**
     * Set compagnie
     *
     * @param \Gestion\GestionBundle\Entity\Compagnie $compagnie
     *
     * @return Vehicule
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
