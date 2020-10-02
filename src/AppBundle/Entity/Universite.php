<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Universite
 *
 * @ORM\Table(name="universite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UniversiteRepository")
 */
class Universite
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

//    /**
//     *
//     * @ORM\OneToMany(targetEntity="Medecin", mappedBy="universite")
//     */
//    private $medecins;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Qualification", mappedBy="universite")
     */
    private $qualifications;

    /**
     * @return ArrayCollection
     */
    public function getQualifications()
    {
        return $this->qualifications;
    }

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
     * @return Universite
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
     * @return Universite
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
        //$this->medecins = new \Doctrine\Common\Collections\ArrayCollection();
        $this->qualifications = new ArrayCollection();
    }

//    /**
//     * Add medecin.
//     *
//     * @param \AppBundle\Entity\Medecin $medecin
//     *
//     * @return Universite
//     */
//    public function addMedecin(\AppBundle\Entity\Medecin $medecin)
//    {
//        $this->medecins[] = $medecin;
//
//        return $this;
//    }
//
//    /**
//     * Remove medecin.
//     *
//     * @param \AppBundle\Entity\Medecin $medecin
//     *
//     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
//     */
//    public function removeMedecin(\AppBundle\Entity\Medecin $medecin)
//    {
//        return $this->medecins->removeElement($medecin);
//    }
//
//    /**
//     * Get medecins.
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getMedecins()
//    {
//        return $this->medecins;
//    }

    /**
     * Add qualification.
     *
     * @param Qualification $qualification
     *
     * @return Universite
     */
    public function addQualification(Qualification $qualification)
    {
        $this->$qualification[] = $qualification;

        return $this;
    }

    /**
     * Remove qualification.
     *
     * @param Qualification $qualification
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeQualification(Qualification $qualification)
    {
        return $this->qualifications->removeElement($this);
    }
}
