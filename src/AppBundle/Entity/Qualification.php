<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Qualification
 *
 * @ORM\Table(name="qualification")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QualificationRepository")
 */
class Qualification
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
     * @var int
     *
     * @ORM\Column(name="annee", type="integer")
     */
    private $annee;


    /**
     *
     * @ORM\ManyToOne(targetEntity="Medecin", cascade={"persist"}, inversedBy="qualifications")
     */
    private $medecin;

    /**
     * @return mixed
     */
    public function getMedecin()
    {
        return $this->medecin;
    }

    /**
     * @param mixed $medecin
     */
    public function setMedecin($medecin)
    {
        $this->medecin = $medecin;
    }


    /**
     * @return Specialite
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * @param mixed $specialite
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;
    }

    /**
     * @return mixed
     */
    public function getUniversite()
    {
        return $this->universite;
    }

    /**
     * @param mixed $universite
     */
    public function setUniversite($universite)
    {
        $this->universite = $universite;
    }

    /**
     *
     * @ORM\ManyToOne(targetEntity="Specialite", cascade={"persist"}, inversedBy="qualifications")
     */
    private $specialite;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Universite", cascade={"persist"}, inversedBy="qualifications")
     */
    private $universite;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set annee.
     *
     * @param int $annee
     *
     * @return Qualification
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee.
     *
     * @return int
     */
    public function getAnnee()
    {
        return $this->annee;
    }
}
