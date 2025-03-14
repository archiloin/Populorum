<?php

namespace App\Entity\Client\Conge;

use App\Entity\Client\Utilisateur;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Absence
 *
 * @ORM\Table(name="cli_absence")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Conge\AbsenceRepository")
 */
class Absence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client\Utilisateur", inversedBy="absences")
     * @JoinColumn(name="utilisateur", referencedColumnName="id", nullable=true, onDelete="Cascade")
     */
    private $utilisateur;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="datetime")
     */
    private $debut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fin;

    /**
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Set note.
     *
     * @param string|null $note
     *
     * @return Absence
     */
    public function setNote($note = null)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note.
     *
     * @return string|null
     */
    public function getNote()
    {
        return $this->note;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

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
}
