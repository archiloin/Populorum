<?php

namespace App\Entity\Client\Profil\Emploi;

use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="cli_profil_emploi")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Profil\Emploi\ProfilRepository")
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
     * @ORM\Column(name="job", type="string", length=255, nullable=true)
     *
     */
    private $job;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     *
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255, nullable=true)
     *
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="structure", type="string", length=255, nullable=true)
     *
     */
    private $structure;

    /**
     * @var datetime
     *
     * @ORM\Column(name="started_at", type="datetime", length=255, nullable=true)
     *
     */
    private $startedAt;

    /**
     * @var datetime
     *
     * @ORM\Column(name="start", type="datetime", length=255, nullable=true)
     *
     */
    private $start;

    /**
     * @var datetime
     *
     * @ORM\Column(name="end", type="datetime", length=255, nullable=true)
     *
     */
    private $end;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=255, nullable=true)
     *
     */
    private $info;

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
     * Set job.
     *
     * @param string|null $job
     *
     * @return Profil
     */
    public function setJob($job = null)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job.
     *
     * @return string|null
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Profil
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set statut.
     *
     * @param string|null $statut
     *
     * @return Profil
     */
    public function setStatut($statut = null)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut.
     *
     * @return string|null
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set structure.
     *
     * @param string|null $structure
     *
     * @return Profil
     */
    public function setStructure($structure = null)
    {
        $this->structure = $structure;

        return $this;
    }

    /**
     * Get structure.
     *
     * @return string|null
     */
    public function getStructure()
    {
        return $this->structure;
    }

    /**
     * Set startedAt.
     *
     * @param \DateTime|null startedAt
     *
     * @return Profil
     */
    public function setStartedAt($startedAt = null)
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * Get startedAt.
     *
     * @return \DateTime|null
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     * Set start.
     *
     * @param \DateTime|null $start
     *
     * @return Profil
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
     * @return Profil
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
     * Set info.
     *
     * @param string|null $info
     *
     * @return Profil
     */
    public function setInfo($info = null)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info.
     *
     * @return string|null
     */
    public function getInfo()
    {
        return $this->info;
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
