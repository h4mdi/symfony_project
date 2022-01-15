<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 */
class Inscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $au;

    /**
     * @ORM\ManyToOne(targetEntity=etudiant::class, inversedBy="inscriptions")
     */
    private $etudiant;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="inscriptions")
     */
    private $classe;

    /**
     * @ORM\Column(type="float")
     */
    private $moyenne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAu(): ?string
    {
        return $this->au;
    }

    public function setAu(string $au): self
    {
        $this->au = $au;

        return $this;
    }

    public function getEtudiant(): ?etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getMoyenne(): ?float
    {
        return $this->moyenne;
    }

    public function setMoyenne(float $moyenne): self
    {
        $this->moyenne = $moyenne;

        return $this;
    }
}
