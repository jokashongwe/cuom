<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Specialite
 *
 * @ORM\Table(name="specialite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SpecialiteRepository")
 */
class Specialite
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
     * @ORM\Column(name="specialite", type="string", length=255)
     */
    private $specialite;

    /**
     *
     *
     * @ORM\ManyToMany(targetEntity="Medecin", cascade={"persist"}, inversedBy="specialites")
     */
    private $medecin;

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
     * Set specialite
     *
     * @param string $specialite
     *
     * @return Specialite
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * Get specialite
     *
     * @return string
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->specialite;
    }

    /**
     * Set medecin
     *
     * @param Medecin $medecin
     *
     * @return Specialite
     */
    public function setMedecin(Medecin $medecin = null)
    {
        $this->medecin = $medecin;

        return $this;
    }

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Qualification", mappedBy="specialite")
     */
    private $qualifications;

    /**
     * @return mixed
     */
    public function getQualifications()
    {
        return $this->qualifications;
    }

    /**
     * Add qualification.
     *
     * @param Qualification $qualification
     *
     * @return Specialite
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

//    /**
//     * Get medecin
//     *
//     * @return ArrayCollection
//     */
//    public function getMedecin()
//    {
//        return $this->medecin;
//    }
    /**
     * Constructor
     */
    public function __construct()
    {
        //$this->medecin = new ArrayCollection();
        $this->qualifications = new ArrayCollection();
    }

//    /**
//     * Add medecin
//     *
//     * @param Medecin $medecin
//     *
//     * @return Specialite
//     */
//    public function addMedecin(Medecin $medecin)
//    {
//        $this->medecin[] = $medecin;
//
//        return $this;
//    }
//
//    /**
//     * Remove medecin
//     *
//     * @param Medecin $medecin
//     */
//    public function removeMedecin(Medecin $medecin)
//    {
//        $this->medecin->removeElement($medecin);
//    }
}
