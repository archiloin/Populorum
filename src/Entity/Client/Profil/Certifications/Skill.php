<?php
namespace App\Entity\Client\Profil\Certifications;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Skill
 * @ORM\Table(name="cli_profil_certification_skill")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Profil\Certifications\SkillRepository")
 */
class Skill
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
     * @ORM\Column(name="skill", type="string", length=255)
     *
     * @var string
     */
    private $skill;

    /**
     * @ORM\Column(name="years_exp", type="string", length=30, nullable=true)
     *
     * @var string
     */
    private $yearsExp;

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

    public function setSkill(?string $skill): void
    {
        $this->skill = $skill;
    }

    public function getSkill(): ?string
    {
        return $this->skill;
    }

    public function setYearsExp(?string $yearsExp): void
    {
        $this->yearsExp = $yearsExp;
    }

    public function getYearsExp(): ?string
    {
        return $this->yearsExp;
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
     * @return Skill
     */
    public function setIdUtilisateur($idUtilisateur = null)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }
}
