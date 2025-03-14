<?php

namespace App\Entity\Client\Profil\InformationsPersonnelles;

use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Table(name="cli_profil_informations_personnelles")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Profil\InformationsPersonnelles\ProfilRepository")
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
     * @ORM\Column(name="civilite", type="string", length=3, nullable=true)
     *
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="identifiant", type="string", length=33, nullable=true)
     *
     */
    private $identifiant;


    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=99, nullable=true)
     *
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Le prénom est trop court.",
     *     maxMessage="Le prénom est trop long.",
     *     groups={"profil"}
     * )
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="middlename", type="string", length=99, nullable=true)
     *
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Le nom est trop court.",
     *     maxMessage="Le nom est trop long.",
     * )
     */
    private $middlename;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=99, nullable=true)
     *
     * @Assert\Length(
     *     min=3,
     *     max=99,
     *     minMessage="Le nom est trop court.",
     *     maxMessage="Le nom est trop long.",
     *     groups={"profil"}
     * )
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=99, nullable=true)
     *
     * @Assert\Length(
     *     min=3,
     *     max=99,
     *     minMessage="Le nom est trop court.",
     *     maxMessage="Le nom est trop long.",
     *     groups={"profil"}
     * )
     */
    private $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="familysituation", type="string", length=33, nullable=true)
     *
     */
    private $familysituation;

    /**
     * @var date
     *
     * @ORM\Column(name="dob", type="date", nullable=true)
     *
     */
    private $dob;

    /**
     * @var string
     *
     * @ORM\Column(name="birthplace", type="string", length=255, nullable=true)
     *
     */
    private $birthplace;

    /**
     * @var string
     *
     * @ORM\Column(name="ssn", type="string", length=33, nullable=true)
     *
     */
    private $ssn;

    /**
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Client\Profil\InformationsPersonnelles\Identity", cascade={"persist"})
     * @JoinColumn(name="identity_id", referencedColumnName="id", nullable=true)
     *
     * @Assert\Valid()
     */
    private $identity;

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
     * Set civilite.
     *
     * @param string|null $civilite
     *
     * @return Profil
     */
    public function setCivilite($civilite = null)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite.
     *
     * @return string|null
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set identifiant.
     *
     * @param string|null $identifiant
     *
     * @return Profil
     */
    public function setIdentifiant($identifiant = null)
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    /**
     * Get identifiant.
     *
     * @return string|null
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * Set firstname.
     *
     * @param string|null $firstname
     *
     * @return Profil
     */
    public function setFirstname($firstname = null)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname.
     *
     * @return string|null
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set middlename.
     *
     * @param string|null $middlename
     *
     * @return Profil
     */
    public function setMiddlename($middlename = null)
    {
        $this->middlename = $middlename;

        return $this;
    }

    /**
     * Get middlename.
     *
     * @return string|null
     */
    public function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * Set lastname.
     *
     * @param string|null $lastname
     *
     * @return Profil
     */
    public function setLastname($lastname = null)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname.
     *
     * @return string|null
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set nickname.
     *
     * @param string|null $nickname
     *
     * @return Profil
     */
    public function setNickname($nickname = null)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname.
     *
     * @return string|null
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set familysituation.
     *
     * @param string|null $familysituation
     *
     * @return Profil
     */
    public function setFamilysituation($familysituation = null)
    {
        $this->familysituation = $familysituation;

        return $this;
    }

    /**
     * Get familysituation.
     *
     * @return string|null
     */
    public function getFamilysituation()
    {
        return $this->familysituation;
    }

    /**
     * Set dob.
     *
     * @param \DateTime|null $dob
     *
     * @return Profil
     */
    public function setDob($dob = null)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob.
     *
     * @return \DateTime|null
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set birthplace.
     *
     * @param string|null $birthplace
     *
     * @return Profil
     */
    public function setBirthplace($birthplace = null)
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    /**
     * Get birthplace.
     *
     * @return string|null
     */
    public function getBirthplace()
    {
        return $this->birthplace;
    }

    /**
     * Set ssn.
     *
     * @param string|null $ssn
     *
     * @return Profil
     */
    public function setSsn($ssn = null)
    {
        $this->ssn = $ssn;

        return $this;
    }

    /**
     * Get ssn.
     *
     * @return string|null
     */
    public function getSsn()
    {
        return $this->ssn;
    }


    /**
     * Set identity.
     *
     * @param \App\Entity\Client\Profil\InformationsPersonnelles\Identity|null $identity
     *
     * @return Utilisateur
     */
    public function setIdentity(\App\Entity\Client\Profil\InformationsPersonnelles\Identity $identity = null)
    {
        $this->identity = $identity;

        return $this;
    }

    /**
     * Get identity.
     *
     * @return \App\Entity\Client\Profil\InformationsPersonnelles\Identity|null
     */
    public function getIdentity()
    {
        return $this->identity;
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
