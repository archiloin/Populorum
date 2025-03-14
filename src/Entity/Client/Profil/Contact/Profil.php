<?php
namespace App\Entity\Client\Profil\Contact;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Profil
 * @ORM\Table(name="cli_profil_contact")
 * @ORM\Entity(repositoryClass="App\Repository\Client\Profil\Contact\ProfilRepository")
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
     * @ORM\Column(name="landline", type="string", length=15,  nullable=true)
     *
     * @var string
     */
    private $landline;

    /**
     * @ORM\Column(name="phone", type="string", length=15, nullable=true)
     *
     * @var string
     */
    private $phone;

    /**
     * @ORM\Column(name="professionalphone", type="string", length=15,  nullable=true)
     *
     * @var string
     */
    private $professionalphone;

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

    public function setLandline(?string $landline): void
    {
        $this->landline = $landline;
    }

    public function getLandline(): ?string
    {
        return $this->landline;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setProfessionalphone(?string $professionalphone): void
    {
        $this->professionalphone = $professionalphone;
    }

    public function getProfessionalphone(): ?string
    {
        return $this->professionalphone;
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
