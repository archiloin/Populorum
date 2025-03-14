<?php

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Table(name="adm_utilisateur")
 * @ORM\Entity(repositoryClass="App\Repository\Admin\UtilisateurRepository")
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
   * @ORM\Column(type="string", length=90, unique=true)
   */
  private $username;
  /**
   * @ORM\Column(type="string", length=255)
   */
  private $password;
  /**
   * @ORM\Column(type="string", length=90, unique=true)
   * @Assert\NotBlank(message="L'adresse mail doit être renseignée", groups={"Inscription"})
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
     * @Assert\NotBlank(message="Le mot de passe doit être renseignée", groups={"Inscription"})
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

    public function __construct()
    {
            $this->isActive = true;
            $this->roles = ['ROLE_ARCHITECT'];
            $this->dateInscription = new \DateTime();
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
    $this->setUsername($email);

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
    if (!in_array('ROLE_ADMIN', $roles))
    {
      $roles[] = 'ROLE_ADMIN';
    }
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
}
