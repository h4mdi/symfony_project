<?php

namespace App\Entity;

use App\Repository\CalendRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CalendRepository::class)
 */
class Calend
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $debut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fin;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $dall_days;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $bg_color;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $text_color;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $border_color;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class,inversedBy="calends")
     */
    private $id_cours;

    /**
     * @ORM\ManyToOne(targetEntity=Enseignant::class, inversedBy="calends")
     */
    private $id_Enseignant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

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

    public function getDallDays(): ?bool
    {
        return $this->dall_days;
    }

    public function setDallDays(bool $dall_days): self
    {
        $this->dall_days = $dall_days;

        return $this;
    }

    public function getBgColor(): ?string
    {
        return $this->bg_color;
    }

    public function setBgColor(string $bg_color): self
    {
        $this->bg_color = $bg_color;

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->text_color;
    }

    public function setTextColor(string $text_color): self
    {
        $this->text_color = $text_color;

        return $this;
    }

    public function getBorderColor(): ?string
    {
        return $this->border_color;
    }

    public function setBorderColor(string $border_color): self
    {
        $this->border_color = $border_color;

        return $this;
    }

    public function getIdCours(): ?Cours
    {
        return $this->id_cours;
    }

    public function setIdCours(?Cours $id_cours): self
    {
        $this->id_cours = $id_cours;

        return $this;
    }

    public function getIdEnseignant(): ?Enseignant
    {
        return $this->id_Enseignant;
    }

    public function setIdEnseignant(?Enseignant $id_Enseignant): self
    {
        $this->id_Enseignant = $id_Enseignant;

        return $this;
    }
}
