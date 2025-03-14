<?php
namespace App\Entity\Client\Profil\Immigration;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Profil
 * @ORM\Table(name="cli_profil_immigration")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Profil\Immigration\ProfilRepository")
 */
class Profil
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
     * @ORM\Column(name="document", type="string", length=255)
     *
     * @var string
     */
    private $document;

    /**
     * @ORM\Column(name="relation", type="string", length=255)
     *
     * @var string
     */
    private $number;

    /**
     * @var date
     *
     * @ORM\Column(name="publish", type="date", nullable=true)
     *
     */
    private $publish;

    /**
     * @var date
     *
     * @ORM\Column(name="exp", type="date", nullable=true)
     *
     */
    private $exp;

    /**
     * @ORM\Column(name="statut", type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $statut;

    /**
     * @ORM\Column(name="publishedby", type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $publishedby;

    /**
     * @var date
     *
     * @ORM\Column(name="eval", type="date", nullable=true)
     *
     */
    private $eval;

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

    public function setDocument(?string $document): void
    {
        $this->document = $document;
    }

    public function getDocument(): ?string
    {
        return $this->document;
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
     * Set publish.
     *
     * @param \DateTime|null $publish
     *
     * @return Profil
     */
    public function setPublish($publish = null)
    {
        $this->publish = $publish;

        return $this;
    }

    /**
     * Get publish.
     *
     * @return \DateTime|null
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * Set exp.
     *
     * @param \DateTime|null $exp
     *
     * @return Profil
     */
    public function setExp($exp = null)
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * Get exp.
     *
     * @return \DateTime|null
     */
    public function getExp()
    {
        return $this->exp;
    }

    public function setStatut(?string $statut): void
    {
        $this->statut = $statut;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setPublishedby(?string $publishedby): void
    {
        $this->publishedby = $publishedby;
    }

    public function getPublishedby(): ?string
    {
        return $this->publishedby;
    }

    /**
     * Set eval.
     *
     * @param \DateTime|null $eval
     *
     * @return Profil
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
     * @return Profil
     */
    public function setIdUtilisateur($idUtilisateur = null)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }
}
