<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 */
class Cours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_h;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $specialite;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Enseignant" ,cascade={"remove"} )
     * @ORM\JoinColumn(nullable=true)
     */
    private $enseigne;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNbH(): ?int
    {
        return $this->nb_h;
    }

    public function setNbH(int $nb_h): self
    {
        $this->nb_h = $nb_h;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }
}
