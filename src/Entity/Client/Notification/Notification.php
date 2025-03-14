<?php

namespace App\Entity\Client\Notification;

use App\Entity\Client\Utilisateur;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Notification
 *
 * @ORM\Table(name="cli_notification")
 * @ORM\Entity
 *
 */
class Notification
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Client\Utilisateur", inversedBy="notifications")
     * @JoinColumn(name="utilisateur", referencedColumnName="id", nullable=true, onDelete="Cascade")
     *
     */
    private $utilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=true)
     *
     */
    private $message;

    /**
     * @var int
     *
     * @ORM\Column(name="slide", type="integer", length=255, nullable=true)
     *
     */
    private $idSlide;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     *
     */
    private $date;

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
     * @param \App\Entity\Client\Utilisateur|null $utilisateur
     *
     * @return Notification
     */
    public function setUtilisateur(\App\Entity\Client\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur.
     *
     * @return \App\Entity\Client\Utilisateur|null
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set message.
     *
     * @param string|null $message
     *
     * @return Notification
     */
    public function setMessage($message = null)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set idSlide.
     *
     * @param int|null $idSlide
     *
     * @return Notification
     */
    public function setIdSlide($idSlide = null)
    {
        $this->idSlide = $idSlide;

        return $this;
    }

    /**
     * Get idSlide.
     *
     * @return int|null
     */
    public function getIdSlide()
    {
        return $this->idSlide;
    }

    /**
     * Set date.
     *
     * @param \DateTime|null $date
     *
     * @return Notification
     */
    public function setDate($date = null)
    {
        $this->date = $date;

        return $this;
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
