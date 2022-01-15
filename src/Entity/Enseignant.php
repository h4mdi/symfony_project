<?php

namespace App\Entity;

use App\Repository\EnseignantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnseignantRepository::class)
 */
class Enseignant
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
     * @ORM\Column(type="string", length=10)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $datenaiss;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $grade;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $specialite;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $tel;

    /**
     * @ORM\OneToMany(targetEntity=Calend::class, mappedBy="id_Enseignant")
     */
    private $calends;

    /**
     * @ORM\OneToMany(targetEntity=Pfe::class, mappedBy="ens")
     */
    private $pves;

    public function __construct()
    {
        $this->calends = new ArrayCollection();
        $this->pves = new ArrayCollection();
    }

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDatenaiss(): ?\DateTimeInterface
    {
        return $this->datenaiss;
    }

    public function setDatenaiss(\DateTimeInterface $datenaiss): self
    {
        $this->datenaiss = $datenaiss;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection|Calend[]
     */
    public function getCalends(): Collection
    {
        return $this->calends;
    }

    public function addCalend(Calend $calend): self
    {
        if (!$this->calends->contains($calend)) {
            $this->calends[] = $calend;
            $calend->setIdEnseignant($this);
        }

        return $this;
    }

    public function removeCalend(Calend $calend): self
    {
        if ($this->calends->removeElement($calend)) {
            // set the owning side to null (unless already changed)
            if ($calend->getIdEnseignant() === $this) {
                $calend->setIdEnseignant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pfe[]
     */
    public function getPves(): Collection
    {
        return $this->pves;
    }

    public function addPfe(Pfe $pfe): self
    {
        if (!$this->pves->contains($pfe)) {
            $this->pves[] = $pfe;
            $pfe->setEns($this);
        }

        return $this;
    }

    public function removePfe(Pfe $pfe): self
    {
        if ($this->pves->removeElement($pfe)) {
            // set the owning side to null (unless already changed)
            if ($pfe->getEns() === $this) {
                $pfe->setEns(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->nom.' '.$this->prenom;
    }
}
