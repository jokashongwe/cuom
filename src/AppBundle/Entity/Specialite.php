<?php

namespace AppBundle\Entity;

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
     * @param \AppBundle\Entity\Medecin $medecin
     *
     * @return Specialite
     */
    public function setMedecin(\AppBundle\Entity\Medecin $medecin = null)
    {
        $this->medecin = $medecin;

        return $this;
    }

    /**
     * Get medecin
     *
     * @return \AppBundle\Entity\Medecin
     */
    public function getMedecin()
    {
        return $this->medecin;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medecin = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add medecin
     *
     * @param \AppBundle\Entity\Medecin $medecin
     *
     * @return Specialite
     */
    public function addMedecin(\AppBundle\Entity\Medecin $medecin)
    {
        $this->medecin[] = $medecin;

        return $this;
    }

    /**
     * Remove medecin
     *
     * @param \AppBundle\Entity\Medecin $medecin
     */
    public function removeMedecin(\AppBundle\Entity\Medecin $medecin)
    {
        $this->medecin->removeElement($medecin);
    }
}
