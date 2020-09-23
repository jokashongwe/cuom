<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Medecin
 *
 * @ORM\Table(name="medecin")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MedecinRepository")
 */
class Medecin
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
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(name="postnom", type="string", length=50)
     */
    private $postnom;

    /**
     * @var string
     * @ORM\Column(name="prenom", type="string", length=50)
     */
    private $prenom;

    /**
     * @var int
     * @ORM\Column(name="annee", type="integer")
     */
    private $annee;

    /**
     * @var string
     * @ORM\Column(name="telephone", type="string", length=50)
     */
    private $telephone;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/*" }, maxSize="100k")
     */
    private $photo;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Specialite", mappedBy="medecin")
     */
    private $specialites;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Hopital", cascade={"persist"}, inversedBy="medecins")
     */
    private $hopital;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Universite", cascade={"persist"}, inversedBy="medecins")
     */
    private $universite;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Commune", cascade={"persist"}, inversedBy="medecins")
     */
    private $Commune;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Statut", cascade={"persist"}, inversedBy="medecins")
     */
    private $statut;



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
     * @return Medecin
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
     * Set postnom
     *
     * @param string $postnom
     *
     * @return Medecin
     */
    public function setPostnom($postnom)
    {
        $this->postnom = $postnom;

        return $this;
    }

    /**
     * Get postnom
     *
     * @return string
     */
    public function getPostnom()
    {
        return $this->postnom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Medecin
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set annee
     *
     * @param integer $annee
     *
     * @return Medecin
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return int
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Medecin
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    public  function __toString(){
        return $this->nom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Medecin
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Medecin
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->specialites = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add specialite
     *
     * @param \AppBundle\Entity\Specialite $specialite
     *
     * @return Medecin
     */
    public function addSpecialite(\AppBundle\Entity\Specialite $specialite)
    {
        $this->specialites[] = $specialite;
        $specialite->setMedecin($this);

        return $this;
    }

    /**
     * Remove specialite
     *
     * @param \AppBundle\Entity\Specialite $specialite
     */
    public function removeSpecialite(\AppBundle\Entity\Specialite $specialite)
    {
        $this->specialites->removeElement($specialite);
    }

    /**
     * Get specialites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecialites()
    {
        return $this->specialites;
    }

    /**
     * Set hopital
     *
     * @param \AppBundle\Entity\Hopital $hopital
     *
     * @return Medecin
     */
    public function setHopital(\AppBundle\Entity\Hopital $hopital = null)
    {
        $this->hopital = $hopital;

        return $this;
    }

    /**
     * Get hopital
     *
     * @return \AppBundle\Entity\Hopital
     */
    public function getHopital()
    {
        return $this->hopital;
    }

    /**
     * Set universite
     *
     * @param \AppBundle\Entity\Universite $universite
     *
     * @return Medecin
     */
    public function setUniversite(\AppBundle\Entity\Universite $universite = null)
    {
        $this->universite = $universite;

        return $this;
    }

    /**
     * Get universite
     *
     * @return \AppBundle\Entity\Universite
     */
    public function getUniversite()
    {
        return $this->universite;
    }

    /**
     * Set commune
     *
     * @param \AppBundle\Entity\Commune $commune
     *
     * @return Medecin
     */
    public function setCommune(\AppBundle\Entity\Commune $commune = null)
    {
        $this->Commune = $commune;

        return $this;
    }

    /**
     * Get commune
     *
     * @return \AppBundle\Entity\Commune
     */
    public function getCommune()
    {
        return $this->Commune;
    }

    /**
     * Set Statut
     *
     * @param Statut|null $statut
     * @return Medecin
     */
    public function setStatut(Statut $statut = null)
    {
        $this->statut = $statut;
        return $this;
    }

    /**
     * Get statut
     *
     * @return Statut
     */
    public function getStatut()
    {
        return $this->statut;
    }
}
