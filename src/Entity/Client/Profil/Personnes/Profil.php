<?php
namespace App\Entity\Client\Profil\Personnes;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Profil
 * @ORM\Table(name="cli_profil_personnes")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Profil\Personnes\ProfilRepository")
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
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(name="relation", type="string", length=255)
     *
     * @var string
     */
    private $relation;

    /**
     * @var date
     *
     * @ORM\Column(name="dob", type="date", nullable=true)
     *
     */
    private $dob;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setRelation(?string $relation): void
    {
        $this->relation = $relation;
    }

    public function getRelation(): ?string
    {
        return $this->relation;
    }

    /**
     * Set dob.
     *
     * @param \DateTime|null $dob
     *
     * @return Profil
     */
    public function setDob($dob = null)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob.
     *
     * @return \DateTime|null
     */
    public function getDob()
    {
        return $this->dob;
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
