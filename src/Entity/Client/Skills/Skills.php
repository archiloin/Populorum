<?php

namespace App\Entity\Client\Skills;

use App\Entity\Client\Skills\Skills;
use App\Entity\Client\Skills\Criteria;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Skills
 *
 * @ORM\Table(name="cli_skills")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Skills\SkillsRepository")
 *
 */
class Skills
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Client\Utilisateur", inversedBy="skills")
     * @JoinColumn(name="utilisateur", referencedColumnName="id", nullable=true, onDelete="Cascade")
     *
     */
    private $utilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     *
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Client\Skills\Criteria", mappedBy="competence", cascade={"persist"})
     *
     */
    private $criteres;

    public function __toString()
    {
        return $this->name;
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


    public function getCriteres()
    {
        return $this->criteres;
    }

    /**
     * Add critere
     *
     * @param Criteria $critere
     *
     * @return Skills
     */
    public function addCritere(Criteria $critere)
    {
        $this->criteres[] = $critere;
        $critere->setCompetence($this);
        return $this;
    }
    /**
     * Remove critere
     *
     * @param Criteria $critere
     */
    public function removeCritere(Criteria $critere)
    {
        $this->criteres->removeElement($critere);
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Skills
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
}
