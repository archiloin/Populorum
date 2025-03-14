<?php

namespace App\Entity\Client\Skills;

use App\Entity\Client\Utilisateur;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Criteria
 *
 * @ORM\Table(name="cli_skills_criteria")
 * @ORM\Entity
 *
 */
class Criteria
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Client\Skills\Skills", inversedBy="criteres", cascade={"persist"})
     * @JoinColumn(name="competence", referencedColumnName="id", nullable=true, onDelete="Cascade")
     *
     */
    private $competence;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     *
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="acquired", type="integer", length=255, nullable=true)
     *
     */
    private $acquired;


    /**
     * @var int
     *
     * @ORM\Column(name="toAcquire", type="integer", length=255, nullable=true)
     *
     */
    private $toAcquire;

    /*
     * Get id
     */
    public function getId()
    {
        return $this->id;
    }


    public function getCompetence(): ?\App\Entity\Client\Skills\Skills
    {
        return $this->competence;
    }

    public function setCompetence(?\App\Entity\Client\Skills\Skills $competence): self
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Criteria
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set acquired.
     *
     * @param int|null $acquired
     *
     * @return Criteria
     */
    public function setAcquired($acquired = null)
    {
        $this->acquired = $acquired;

        return $this;
    }

    /**
     * Get acquired.
     *
     * @return int|null
     */
    public function getAcquired()
    {
        return $this->acquired;
    }

    /**
     * Set toAcquire.
     *
     * @param int|null $toAcquire
     *
     * @return Criteria
     */
    public function setToAcquire($toAcquire = null)
    {
        $this->toAcquire = $toAcquire;

        return $this;
    }

    /**
     * Get toAcquire.
     *
     * @return int|null
     */
    public function getToAcquire()
    {
        return $this->toAcquire;
    }

}
