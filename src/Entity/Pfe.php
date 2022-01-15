<?php

namespace App\Entity;

use App\Repository\PfeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PfeRepository::class)
 */
class Pfe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sujet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $etat;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity=Enseignant::class, inversedBy="pves")
     */
    private $ens;

    /**
     * @ORM\ManyToOne(targetEntity=Etudiant::class)
     */
    private $etud;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $annee;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getEns(): ?Enseignant
    {
        return $this->ens;
    }

    public function setEns(?Enseignant $ens): self
    {
        $this->ens = $ens;

        return $this;
    }

    public function getEtud(): ?Etudiant
    {
        return $this->etud;
    }

    public function setEtud(?Etudiant $etud): self
    {
        $this->etud = $etud;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    // Register Magic Method to Print the name of the State e.g California
    public function __toString() {
        return $this->ens;
    }
}
