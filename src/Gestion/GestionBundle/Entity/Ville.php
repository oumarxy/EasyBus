<?php

namespace Gestion\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="Gestion\GestionBundle\Repository\VilleRepository")
 */
class Ville {

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
     * @ORM\OneToMany(targetEntity="Gestion\GestionBundle\Entity\Gare", mappedBy="ville")
     */
    private $gare;

    /**
     * @var string
     *
     * @ORM\Column(name="nomVille", type="string", length=255, unique=true)
     */
    private $nomVille;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nomVille
     *
     * @param string $nomVille
     *
     * @return Ville
     */
    public function setNomVille($nomVille) {
        $this->nomVille = $nomVille;

        return $this;
    }

    /**
     * Get nomVille
     *
     * @return string
     */
    public function getNomVille() {
        return $this->nomVille;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gare = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add gare
     *
     * @param \Gestion\GestionBundle\Entity\Gare $gare
     *
     * @return Ville
     */
    public function addGare(\Gestion\GestionBundle\Entity\Gare $gare)
    {
        $this->gare[] = $gare;

        return $this;
    }

    /**
     * Remove gare
     *
     * @param \Gestion\GestionBundle\Entity\Gare $gare
     */
    public function removeGare(\Gestion\GestionBundle\Entity\Gare $gare)
    {
        $this->gare->removeElement($gare);
    }

    /**
     * Get gare
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGare()
    {
        return $this->gare;
    }
    public function __toString() {
        return $this->getNomVille();
    }

    /**
     * Set compagnie
     *
     * @param \Gestion\GestionBundle\Entity\Compagnie $compagnie
     *
     * @return Ville
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
