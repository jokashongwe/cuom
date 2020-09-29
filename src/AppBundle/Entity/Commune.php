<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commune
 *
 * @ORM\Table(name="commune")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommuneRepository")
 */
class Commune
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
     * @ORM\Column(name="commune", type="string", length=50, unique=true)
     */
    private $commune;

//    /**
//     *
//     * @ORM\OneToMany(targetEntity="Medecin", mappedBy="Commune")
//     */
//    private $medecins;


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
     * Set commune
     *
     * @param string $commune
     *
     * @return Commune
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get commune
     *
     * @return string
     */
    public function getCommune()
    {
        return $this->commune;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->commune;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
       // $this->medecins = new \Doctrine\Common\Collections\ArrayCollection();
    }

//    /**
//     * Add medecin.
//     *
//     * @param \AppBundle\Entity\Medecin $medecin
//     *
//     * @return Commune
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
//
//    public function nbr()
//    {
//        $som=0;
//        foreach ($this->getMedecins() as $md){
//            $som++;
//        }
//        return $som;
//    }
}
