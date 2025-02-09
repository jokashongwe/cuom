<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Hopital
 *
 * @ORM\Table(name="hopital")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HopitalRepository")
 */
class Hopital
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;


    /**
     *
     * @ORM\OneToMany(targetEntity="Medecin", mappedBy="hopital")
     */
    private $medecins;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Hopital
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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Hopital
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->nom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medecins = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add medecin.
     *
     * @param \AppBundle\Entity\Medecin $medecin
     *
     * @return Hopital
     */
    public function addMedecin(\AppBundle\Entity\Medecin $medecin)
    {
        $this->medecins[] = $medecin;

        return $this;
    }

    /**
     * Remove medecin.
     *
     * @param \AppBundle\Entity\Medecin $medecin
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMedecin(\AppBundle\Entity\Medecin $medecin)
    {
        return $this->medecins->removeElement($medecin);
    }

    /**
     * Get medecins.
     *
     * @return Collection
     */
    public function getMedecins()
    {
        return $this->medecins;
    }
}
