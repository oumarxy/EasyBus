<?php

namespace Gestion\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gare
 *
 * @ORM\Table(name="gare")
 * @ORM\Entity(repositoryClass="Gestion\GestionBundle\Repository\GareRepository")
 */
class Gare
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
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Ville", inversedBy="gare")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ville;
        
     /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Compagnie")
     */
    private $compagnie;

    /**
     * @var string
     *
     * @ORM\Column(name="nomgare", type="string", length=255)
     */
    private $nomGare;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


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
     * Set nomGare
     *
     * @param string $nomGare
     *
     * @return Gare
     */
    public function setNomGare($nomGare)
    {
        $this->nomGare = $nomGare;

        return $this;
    }

    /**
     * Get nomGare
     *
     * @return string
     */
    public function getNomGare()
    {
        return $this->nomGare;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Gare
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set ville
     *
     * @param \Gestion\GestionBundle\Entity\Ville $ville
     *
     * @return Gare
     */
    public function setVille(\Gestion\GestionBundle\Entity\Ville $ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \Gestion\GestionBundle\Entity\Ville
     */
    public function getVille()
    {
        return $this->ville;
    }
    public function __toString() {
        return $this->getNomGare();
    }

  

    /**
     * Set compagnie
     *
     * @param \Gestion\GestionBundle\Entity\Compagnie $compagnie
     *
     * @return Gare
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
