<?php


namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Statut
 *
 * @ORM\Table(name="statut")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatutRepository")
 */

class Statut
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
     *
     * @ORM\OneToMany(targetEntity="Medecin", mappedBy="statut")
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
     * Set commune
     *
     * @param string $nom
     *
     * @return Statut
     */
    public function setNom($nom)
    {
        $this->nom =  $nom;

        return $this;
    }

    /**
     * Get commune
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
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
        $this->medecins = new ArrayCollection();
    }

    /**
     * Add medecin.
     *
     * @param Medecin $medecin
     *
     * @return Statut
     */
    public function addMedecin(Medecin $medecin)
    {
        $this->medecins[] = $medecin;

        return $this;
    }

    /**
     * Remove medecin.
     *
     * @param Medecin $medecin
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMedecin(Medecin $medecin)
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

    public function nbr()
    {
        $som=0;
        foreach ($this->getMedecins() as $md){
            $som++;
        }
        return $som;
    }
}