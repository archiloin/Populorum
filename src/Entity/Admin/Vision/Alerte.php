<?php

namespace App\Entity\Admin\Vision;

use App\Entity\Client\Utilisateur;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Alerte
 *
 * @ORM\Table(name="adm_alerte")
 * @ORM\Entity
 *
 */
class Alerte
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
     * @ORM\Column(name="utilisateur", type="integer", length=20, nullable=true)
     *
     */
    private $utilisateur;

    /**
     * @var int
     *
     * @ORM\Column(name="niveau", type="integer", length=2, nullable=true)
     *
     */
    private $niveau;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     *
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     *
     */
    private $url;

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
     * @var datetime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     *
     */
    private $date;

    public function __construct()
     {
          $this->date = new \DateTime();
     }

    /*
     * Get id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set utilisateur.
     *
     * @param int|null $utilisateur
     *
     * @return Alerte
     */
    public function setUtilisateur($utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur.
     *
     * @return int|null
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set niveau.
     *
     * @param int|null $niveau
     *
     * @return Alerte
     */
    public function setNiveau($niveau = null)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau.
     *
     * @return int|null
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set type.
     *
     * @param string|null $type
     *
     * @return Alerte
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set url.
     *
     * @param string|null $url
     *
     * @return Alerte
     */
    public function setUrl($url = null)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set ip.
     *
     * @param string|null $ip
     *
     * @return Alerte
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
     * Get date.
     *
     * @return \DateTime|null
     */
    public function getDate()
    {
        return $this->date;
    }
}
