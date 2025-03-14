<?php

namespace App\Entity\Client\Support;

use App\Entity\Client\Utilisateur;
use App\Entity\Client\Support\Report;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;

/**
 * Report
 *
 * @ORM\Table(name="cli_support_report")
 * @ORM\Entity
 * @Vich\Uploadable
 *
 */
class Report
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client\Utilisateur", inversedBy="report")
     * @JoinColumn(name="utilisateur_id", referencedColumnName="id", nullable=true, onDelete="Cascade")
     */
    private $utilisateur;

    /**
    * @var DateTime
    *
    * @ORM\Column(name="date", type="datetime", nullable=true)
    *
    */
    private $date;

    /**
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(name="sujet", type="string", nullable=true)
     */
    private $sujet;

    /**
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Client\Support\PJ", cascade={"persist", "remove"})
     * @JoinColumn(name="pj", referencedColumnName="id", nullable=true)
     *
     * @Assert\Valid()
     */
    private $pj;

    public function __construct()
    {
        $this->date = new \DateTime();
    }
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
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
     * Set date.
     *
     * @param \DateTime|null $date
     *
     * @return Report
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

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Report
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
     * Set sujet.
     *
     * @param string|null $sujet
     *
     * @return Report
     */
    public function setSujet($sujet = null)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet.
     *
     * @return string|null
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set pj.
     *
     * @param \App\Entity\Client\Support\PJ|null $image
     *
     * @return Report
     */
    public function setPJ(\App\Entity\Client\Support\PJ $pj = null)
    {
        $this->pj = $pj;

        return $this;
    }

    /**
     * Get pj.
     *
     * @return \App\Entity\Client\Support\PJ|null
     */
    public function getPJ()
    {
        return $this->pj;
    }
}
