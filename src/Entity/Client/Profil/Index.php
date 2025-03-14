<?php

namespace App\Entity\Client\Profil;

use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * @ORM\Table(name="cli_profil")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Profil\IndexRepository")
 */
class Index
{
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;



    /**
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Client\Profil\InformationsEntreprise\Profil", cascade={"persist"})
     * @JoinColumn(name="informations_entreprise", referencedColumnName="id", nullable=true)
     *
     * @Assert\Valid()
     */
    private $informationsEntreprise;

    /**
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Client\Profil\InformationsPersonnelles\Profil", cascade={"persist"})
     * @JoinColumn(name="informations_personnelles", referencedColumnName="id", nullable=true)
     *
     * @Assert\Valid()
     */
    private $informationsPersonnelles;

    /**
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Client\Profil\Coordonnees\Profil", cascade={"persist"})
     * @JoinColumn(name="coordonnees", referencedColumnName="id", nullable=true)
     *
     * @Assert\Valid()
     */
    private $coordonnees;


    /**
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Client\Profil\Emploi\Profil", cascade={"persist"})
     * @JoinColumn(name="emploi", referencedColumnName="id", nullable=true)
     *
     * @Assert\Valid()
     */
    private $emploi;

    /*
     * Get id
     */
    public function getId()
    {
      return $this->id;
    }

    /**
     * Set informationsEntreprise.
     *
     * @param \App\Entity\Client\Profil\InformationsEntreprise\Profil|null $informationsEntreprise
     *
     * @return Index
     */
    public function setInformationsEntreprise(\App\Entity\Client\Profil\InformationsEntreprise\Profil $informationsEntreprise = null)
    {
        $this->informationsEntreprise = $informationsEntreprise;

        return $this;
    }

    /**
     * Get informationsEntreprise.
     *
     * @return \App\Entity\Client\Profil\InformationsEntreprise\Profil|null
     */
    public function getInformationsEntreprise()
    {
        return $this->informationsEntreprise;
    }

    /**
     * Set informationsPersonnelles.
     *
     * @param \App\Entity\Client\Profil\InformationsPersonnelles\Profil|null $informationsPersonnelles
     *
     * @return Index
     */
    public function setInformationsPersonnelles(\App\Entity\Client\Profil\InformationsPersonnelles\Profil $informationsPersonnelles = null)
    {
        $this->informationsPersonnelles = $informationsPersonnelles;

        return $this;
    }

    /**
     * Get informationsPersonnelles.
     *
     * @return \App\Entity\Client\Profil\InformationsPersonnelles\Profil|null
     */
    public function getInformationsPersonnelles()
    {
        return $this->informationsPersonnelles;
    }

    /**
     * Set coordonnees.
     *
     * @param \App\Entity\Client\Profil\Coordonnees\Profil|null $coordonnees
     *
     * @return Index
     */
    public function setCoordonnees(\App\Entity\Client\Profil\Coordonnees\Profil $coordonnees = null)
    {
        $this->coordonnees = $coordonnees;

        return $this;
    }

    /**
     * Get coordonnees.
     *
     * @return \App\Entity\Client\Profil\Coordonnees\Profil|null
     */
    public function getCoordonnees()
    {
        return $this->coordonnees;
    }

    /**
     * Set emploi.
     *
     * @param \App\Entity\Client\Profil\Emploi\Profil|null $emploi
     *
     * @return Index
     */
    public function setEmploi(\App\Entity\Client\Profil\Emploi\Profil $emploi = null)
    {
        $this->emploi = $emploi;

        return $this;
    }

    /**
     * Get emploi.
     *
     * @return \App\Entity\Client\Profil\Emploi\Profil|null
     */
    public function getEmploi()
    {
        return $this->emploi;
    }
}
