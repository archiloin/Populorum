<?php

namespace App\Entity\Client;

use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Table(name="cli_utilisateur")
 * @ORM\Entity(repositoryClass="App\Repository\Client\UtilisateurRepository")
 * @UniqueEntity(fields="email", message="Cet email est déjà enregistré en base.")
 * @UniqueEntity(fields="username", message="Cet identifiant est déjà enregistré en base")
 */
class Utilisateur implements UserInterface, \Serializable
{
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=90, unique=true, nullable=true)
   */
  private $username;
  /**
   * @ORM\Column(type="string", length=255)
   */
  private $password;
  /**
   * @ORM\Column(type="string", length=90, unique=true)
   * @Assert\NotBlank(message="The email address must be filled", groups={"Inscription"})
   * @Assert\Email()
   */
  private $email;
  /**
   * @ORM\Column(name="is_active", type="boolean")
   */
  private $isActive;
  /**
   * @var array
   * @ORM\Column(type="array")
   */
  private $roles;
    /**
     * @Assert\NotBlank(message="The password must be filled", groups={"inscription"})
     * @Assert\Length(max=96)
     */
    private $plainPassword;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $passwordRequestedAt;
    /**
    * @var string
    *
    * @ORM\Column(type="string", length=255, nullable=true)
    */
    private $token;

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateInscription", type="datetime", length=255, nullable=true)
     *
     */
    private $dateInscription;

     /**
     * @var datetime
     *
     * @ORM\Column(name="lastLogin", type="datetime", length=255, nullable=true)
     *
     */
    private $lastLogin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Client\Utilisateur", mappedBy="client")
     *
     */
    private $salaries;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Client\Profil\Index", cascade={"persist"})
     * @JoinColumn(name="profil", referencedColumnName="id", nullable=true)
     *
     *
     * @Assert\Valid()
     */
    private $profil;

    /**
     * @var string
     * @ORM\Column(name="plan",type="string")
     */
    private $plan;

     /**
     * @var datetime
     *
     * @ORM\Column(name="plan_started_at", type="datetime", length=255, nullable=true)
     *
     */
    private $planStartedAt;

    /**
     * @ORM\Column(name="cgu", type="boolean", nullable=true)
     * @Assert\NotBlank(message="You must accept the general conditions of use", groups={"Inscription"})
     */
    private $cgu;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255, nullable=true)
     *
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="userAgent", type="string", length=255, nullable=true)
     *
     */
    private $userAgent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Client\Support\Report", mappedBy="utilisateur")
     * @JoinColumn(name="report", referencedColumnName="id", nullable=true, onDelete="Cascade")
     *
     */
    private $report;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Client\Notification\Notification", mappedBy="utilisateur")
     * @JoinColumn(name="notification", referencedColumnName="id", nullable=true, onDelete="Cascade")
     *
     */
    private $notifications;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Client\Skills\Skills", mappedBy="utilisateur")
     * @JoinColumn(name="skills", referencedColumnName="id", nullable=true, onDelete="Cascade")
     *
     */
    private $skills;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client\Utilisateur", inversedBy="salaries")
     * @JoinColumn(name="client", referencedColumnName="id", nullable=true, onDelete="Cascade")
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Client\Conge\Absence", mappedBy="utilisateur")
     *
     */
    private $absences;

    public function __construct()
    {
            $this->isActive = true;
            $this->dateInscription = new \DateTime();
            $this->planStartedAt = new \DateTime();
    }

  /*
   * Get id
   */
  public function getId()
  {
    return $this->id;
  }
  public function getUsername()
  {
    return $this->username;
  }
  public function setUsername($username)
  {
    $this->username = $username;
    return $this;
  }
  public function getPassword()
  {
    return $this->password;
  }
  public function setPassword($password)
  {
    $this->password = $password;
    return $this;
  }
  /*
   * Get email
   */
  public function getEmail()
  {
    return $this->email;
  }
  /*
   * Set email
   */
  public function setEmail($email)
  {
    $this->email = $email;
    return $this;
  }
  /*
   * Get isActive
   */
  public function getIsActive()
  {
    return $this->isActive;
  }
  /*
   * Set isActive
   */
  public function setIsActive($isActive)
  {
    $this->isActive = $isActive;
    return $this;
  }
  public function getSalt()
  {
    return null;
  }
  // modifier la méthode getRoles
  public function getRoles()
  {
    return $this->roles;
  }
  public function setRoles(array $roles)
  {
    foreach ($roles as $role)
    {
      if(substr($role, 0, 5) !== 'ROLE_') {
        throw new InvalidArgumentException("Chaque rôle doit commencer par 'ROLE_'");
      }
    }
    $this->roles = $roles;
    return $this;
  }
  public function eraseCredentials()
  {
  }
  /** @see \Serializable::serialize() */
  public function serialize()
  {
    return serialize(array(
      $this->id,
      $this->username,
      $this->password,
      $this->isActive,
    ));
  }
  /** @see \Serializable::unserialize() */
  public function unserialize($serialized)
  {
    list (
      $this->id,
      $this->username,
      $this->password,
      $this->isActive,
    ) = unserialize($serialized);
  }
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }
     /*
     * Get passwordRequestedAt
     */
    public function getPasswordRequestedAt()
    {
        return $this->passwordRequestedAt;
    }
    /*
     * Set passwordRequestedAt
     */
    public function setPasswordRequestedAt($passwordRequestedAt)
    {
        $this->passwordRequestedAt = $passwordRequestedAt;
        return $this;
    }
    /*
     * Get token
     */
    public function getToken()
    {
        return $this->token;
    }
    /*
     * Set token
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Set dateInscription.
     *
     * @param \DateTime|null $dateInscription
     *
     * @return Utilisateur
     */
    public function setDateInscription($dateInscription = null)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription.
     *
     * @return \DateTime|null
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set lastLogin.
     *
     * @param \DateTime|null $lastLogin
     *
     * @return Utilisateur
     */
    public function setLastLogin($lastLogin = null)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin.
     *
     * @return \DateTime|null
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }


     /**
     * Set profil.
     *
     * @param \App\Entity\Client\Profil\Index|null $profil
     *
     * @return Utilisateur
     */
    public function setProfil(\App\Entity\Client\Profil\Index $profil = null)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil.
     *
     * @return \App\Entity\Client\Profil\Index|null
     */
    public function getProfil()
    {
        return $this->profil;
    }

    public function getPlan()
    {
      return $this->plan;
    }
    public function setPlan(string $plan)
    {
      $this->plan = $plan;
      return $this;
    }

    /**
     * Set planStartedAt
     *
     * @param \DateTime|null $planStartedAt
     *
     * @return Utilisateur
     */
    public function setPlanStartedAt($planStartedAt = null)
    {
        $this->planStartedAt = $planStartedAt;

        return $this;
    }

    /**
     * Get planStartedAt
     *
     * @return \DateTime|null
     */
    public function getPlanStartedAt()
    {
        return $this->planStartedAt;
    }

  /*
   * Get cgu
   */
  public function getCgu()
  {
    return $this->cgu;
  }
  /*
   * Set cgu
   */
  public function setCgu($cgu)
  {
    $this->cgu = $cgu;
    return $this;
  }

    /**
     * Set ip.
     *
     * @param string|null $ip
     *
     * @return Utilisateur
     */
    public function setIp($ip = null)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip.
     *
     * @return string|null
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set userAgent.
     *
     * @param string|null $userAgent
     *
     * @return Utilisateur
     */
    public function setUserAgent($userAgent = null)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent.
     *
     * @return string|null
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getSalaries(): Collection
    {
        return $this->salaries;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }


    /**
     * @return Collection|Utilisateur[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }


    /**
     * @return Collection|Utilisateur[]
     */
    public function getReport(): Collection
    {
        return $this->report;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }


    public function getClient(): ?\App\Entity\Client\Utilisateur
    {
        return $this->client;
    }

    public function setClient(?\App\Entity\Client\Utilisateur $client): self
    {
        $this->client = $client;

        return $this;
    }
}
