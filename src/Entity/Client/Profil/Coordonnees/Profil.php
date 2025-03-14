<?php

namespace App\Entity\Client\Profil\Coordonnees;

use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Table(name="cli_profil_coordonnees")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Profil\Coordonnees\ProfilRepository")
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
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="L'adresse est trop courte.",
     *     maxMessage="L'adresse est trop longue.",
     *     groups={"profil"}
     * )
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="addresscontinued", type="string", length=255, nullable=true)
     *
     */
    private $addresscontinued;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=55, nullable=true)
     *
     * @Assert\Length(
     *     min=3,
     *     max=55,
     *     minMessage="La ville renseigné est trop courte.",
     *     maxMessage="La ville renseigné est trop longue.",
     *     groups={"profil"}
     * )
     */
    private $city;

    /**
     * @var integer
     * @ORM\Column(name="postalcode", type="integer", length=10, nullable=true)
     *
     *
     * @Assert\NotBlank(
     * groups={"Profile"}
     * )
     * @Assert\Length(
     *     min=4,
     *     max=10,
     *     minMessage="Le code postal est trop court.",
     *     maxMessage="Le code postal est trop long.",
     *     groups={"Profile"}
     * )
     */
    private $postalcode;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     *
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=true)
     *
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="landline", type="string", length=255, nullable=true)
     *
     */
    private $landline;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     *
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="professionalphone", type="string", length=255, nullable=true)
     *
     */
    private $professionalphone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     *
     */
    private $email;

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
     * Set address.
     *
     * @param string|null $address
     *
     * @return Profil
     */
    public function setAddress($address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set addresscontinued.
     *
     * @param string|null $addresscontinued
     *
     * @return Profil
     */
    public function setAddresscontinued($addresscontinued = null)
    {
        $this->addresscontinued = $addresscontinued;

        return $this;
    }

    /**
     * Get addresscontinued.
     *
     * @return string|null
     */
    public function getAddresscontinued()
    {
        return $this->addresscontinued;
    }

    /**
     * Set city.
     *
     * @param string|null $city
     *
     * @return Profil
     */
    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postalcode.
     *
     * @param int|null $postalcode
     *
     * @return Utilisateur
     */
    public function setPostalcode($postalcode = null)
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    /**
     * Get postalcode.
     *
     * @return int|null
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }

    /**
     * Set country.
     *
     * @param string|null $country
     *
     * @return Profil
     */
    public function setCountry($country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set state.
     *
     * @param string|null $state
     *
     * @return Profil
     */
    public function setState($state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state.
     *
     * @return string|null
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set landline.
     *
     * @param string|null $landline
     *
     * @return Profil
     */
    public function setLandline($landline = null)
    {
        $this->landline = $landline;

        return $this;
    }

    /**
     * Get landline.
     *
     * @return string|null
     */
    public function getLandline()
    {
        return $this->landline;
    }

    /**
     * Set phone.
     *
     * @param string|null $phone
     *
     * @return Profil
     */
    public function setPhone($phone = null)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set professionalphone.
     *
     * @param string|null $professionalphone
     *
     * @return Profil
     */
    public function setProfessionalphone($professionalphone = null)
    {
        $this->professionalphone = $professionalphone;

        return $this;
    }

    /**
     * Get professionalphone.
     *
     * @return string|null
     */
    public function getProfessionalphone()
    {
        return $this->professionalphone;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Profil
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
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
