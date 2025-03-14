<?php
namespace App\Entity\Client\Profil\Certifications;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Etudes
 * @ORM\Table(name="cli_profil_certification_etudes")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Profil\Certifications\EtudesRepository")
 */
class Etudes
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
     * @ORM\Column(name="lvl", type="string", length=255)
     *
     * @var string
     */
    private $lvl;

    /**
     * @ORM\Column(name="institute", type="string", length=30, nullable=true)
     *
     * @var string
     */
    private $institute;

    /**
     * @ORM\Column(name="speciality", type="string", length=30, nullable=true)
     *
     * @var string
     */
    private $speciality;

    /**
     * @ORM\Column(name="result", type="string", length=1000, nullable=true)
     *
     * @var string
     */
    private $result;

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

    public function setLvl(?string $lvl): void
    {
        $this->lvl = $lvl;
    }

    public function getLvl(): ?string
    {
        return $this->lvl;
    }

    public function setInstitute(?string $institute): void
    {
        $this->institute = $institute;
    }

    public function getInstitute(): ?string
    {
        return $this->institute;
    }

    public function setSpeciality(?string $speciality): void
    {
        $this->speciality = $speciality;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setResult(?string $result): void
    {
        $this->result = $result;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    /**
     * Set start.
     *
     * @param \DateTime|null $start
     *
     * @return Etudes
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
     * @return Etudes
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
     * @return Etudes
     */
    public function setIdUtilisateur($idUtilisateur = null)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }
}
