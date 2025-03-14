<?php
namespace App\Entity\Client\Profil\Certifications;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Langues
 * @ORM\Table(name="cli_profil_certification_langues")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Profil\Certifications\LanguesRepository")
 */
class Langues
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
     * @ORM\Column(name="langues", type="string", length=255)
     *
     * @var string
     */
    private $langues;

    /**
     * @ORM\Column(name="lvl", type="string", length=255)
     *
     * @var string
     */
    private $lvl;

    /**
     * @ORM\Column(name="skill", type="string", length=30, nullable=true)
     *
     * @var string
     */
    private $skill;

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

    public function setLangues(?string $langues): void
    {
        $this->langues = $langues;
    }

    public function getLangues(): ?string
    {
        return $this->langues;
    }

    public function setLvl(?string $lvl): void
    {
        $this->lvl = $lvl;
    }

    public function getLvl(): ?string
    {
        return $this->lvl;
    }

    public function setSkill(?string $skill): void
    {
        $this->skill = $skill;
    }

    public function getSkill(): ?string
    {
        return $this->skill;
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
     * @return Langues
     */
    public function setIdUtilisateur($idUtilisateur = null)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }
}
