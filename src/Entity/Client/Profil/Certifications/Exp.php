<?php
namespace App\Entity\Client\Profil\Certifications;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Exp
 * @ORM\Table(name="cli_profil_certification_exp")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Profil\Certifications\ExpRepository")
 */
class Exp
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
     * @ORM\Column(name="business", type="string", length=255)
     *
     * @var string
     */
    private $business;

    /**
     * @ORM\Column(name="job", type="string", length=255)
     *
     * @var string
     */
    private $job;

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
     * @ORM\Column(name="comment", type="string", length=1000, nullable=true)
     *
     * @var string
     */
    private $comment;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setBusiness(?string $business): void
    {
        $this->business = $business;
    }

    public function getBusiness(): ?string
    {
        return $this->business;
    }

    public function setJob(?string $job): void
    {
        $this->job = $job;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    /**
     * Set start.
     *
     * @param \DateTime|null $start
     *
     * @return Exp
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
     * @return Exp
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

    public function setStartedby(?string $startedby): void
    {
        $this->startedby = $startedby;
    }

    public function getStartedby(): ?string
    {
        return $this->startedby;
    }

    /**
     * Set eval.
     *
     * @param \DateTime|null $eval
     *
     * @return Exp
     */
    public function setEval($eval = null)
    {
        $this->eval = $eval;

        return $this;
    }

    /**
     * Get eval.
     *
     * @return \DateTime|null
     */
    public function getEval()
    {
        return $this->eval;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    public function getComment(): ?string
    {
        return $this->comment;
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
     * @return Exp
     */
    public function setIdUtilisateur($idUtilisateur = null)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }
}
