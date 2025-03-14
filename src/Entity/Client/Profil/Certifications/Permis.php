<?php
namespace App\Entity\Client\Profil\Certifications;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Permis
 * @ORM\Table(name="cli_profil_certification_permis")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Profil\Certifications\PermisRepository")
 */
class Permis
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $idUtilisateur;

    /**
     * @ORM\Column(name="type", type="string", length=255)
     *
     * @var string
     */
    private $type;

    /**
     * @ORM\Column(name="number", type="string", length=30, nullable=true)
     *
     * @var string
     */
    private $number;

    /**
     * @var date
     *
     * @ORM\Column(name="start", type="date", nullable=true)
     *
     */
    private $start;

    /**
     * @var date
     *
     * @ORM\Column(name="end", type="date", nullable=true)
     *
     */
    private $end;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * Set start.
     *
     * @param \DateTime|null $start
     *
     * @return Permis
     */
    public function setStart($start = null)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start.
     *
     * @return \DateTime|null
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end.
     *
     * @param \DateTime|null $end
     *
     * @return Permis
     */
    public function setEnd($end = null)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end.
     *
     * @return \DateTime|null
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Get idUtilisateur.
     *
     * @return int
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set idUtilisateur.
     *
     * @param int|null $idUtilisateur
     *
     * @return Permis
     */
    public function setIdUtilisateur($idUtilisateur = null)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }
}
