<?php

namespace App\Entity\Client\Profil\InformationsEntreprise;

use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Table(name="cli_profil_informations_entreprise")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Profil\InformationsEntreprise\ProfilRepository")
 */
class Profil
{
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_entreprise", type="string", length=255)
     *
     * @Assert\NotBlank(message="The company name must be entered", groups={"profil", "inscription"})
     * )
     */
    private $nomEntreprise;

    /**
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Client\Profil\InformationsEntreprise\Logo", cascade={"persist"})
     * @JoinColumn(name="logo", referencedColumnName="id", nullable=true)
     *
     * @Assert\Valid()
     */
    private $logo;

    /**
     * @var int
     *
     * @ORM\Column(name="idupdate", type="integer", length=33, nullable=true)
     *
     */
    private $idupdate;

    /**
     * @var string
     *
     * @ORM\Column(name="nameupdate", type="string", length=255, nullable=true)
     *
     */
    private $nameupdate;

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateupdate", type="datetime", length=255, nullable=true)
     *
     */
    private $dateupdate;

    /*
     * Get id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set NomEntreprise.
     *
     * @param string $nomEntreprise
     *
     * @return User
     */
    public function setNomEntreprise($nomEntreprise)
    {
        $this->nomEntreprise = mb_strtoupper($nomEntreprise, 'UTF-8');

        return $this;
    }

    /**
     * Get nomEntreprise.
     *
     * @return string
     */
    public function getNomEntreprise()
    {
        return $this->nomEntreprise;
    }

    /**
     * Set logo.
     *
     * @param \App\Entity\Client\Profil\InformationsEntreprise\Logo|null $logo
     *
     * @return Index
     */
    public function setLogo(\App\Entity\Client\Profil\InformationsEntreprise\Logo $logo = null)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo.
     *
     * @return \App\Entity\Client\Profil\InformationsEntreprise\Logo|null
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set idupdate.
     *
     * @param int|null $idupdate
     *
     * @return Profil
     */
    public function setIdupdate($idupdate = null)
    {
        $this->idupdate = $idupdate;

        return $this;
    }

    /**
     * Get idupdate.
     *
     * @return int|null
     */
    public function getIdupdate()
    {
        return $this->idupdate;
    }

    /**
     * Set nameupdate.
     *
     * @param string|null $nameupdate
     *
     * @return Profil
     */
    public function setNameupdate($nameupdate = null)
    {
        $this->nameupdate = $nameupdate;

        return $this;
    }

    /**
     * Get nameupdate.
     *
     * @return string|null
     */
    public function getNameupdate()
    {
        return $this->nameupdate;
    }

    /**
     * Set dateupdate.
     *
     * @param \DateTime|null $dateupdate
     *
     * @return Profil
     */
    public function setDateupdate($dateupdate = null)
    {
        $this->dateupdate = $dateupdate;

        return $this;
    }

    /**
     * Get dateupdate.
     *
     * @return \DateTime|null
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
    }

}
