<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantRepository")
 * @Vich\Uploadable
 */
class Etudiant{

     /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
    private $adresses;

     /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDeNaissance;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Absence", mappedBy="etudiant")
     */
    private $absences;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $promotion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inscrit=false;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $tel;

    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="etudiant")
     */
    private $inscriptions;

    public function getDateDeNaissance()
    {
        return $this->dateDeNaissance;
    }
    public function setDateDeNaissance(\Datetime $dateDeNaissance = null)
    {
        $this->dateDeNaissance = $dateDeNaissance;

    }
    
    public function __construct()
    {
        $this->absences = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
    }

    /**
     * @return Collection|Absence[]
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absence $absence): self
    {
        if (!$this->absences->contains($absence)) {
            $this->absences[] = $absence;
            $absence->setEtudiant($this);
        }

        return $this;
    }

    public function removeAbsence(Absence $absence): self
    {
        if ($this->absences->contains($absence)) {
            $this->absences->removeElement($absence);
            // set the owning side to null (unless already changed)
            if ($absence->getEtudiant() === $this) {
                $absence->setEtudiant(null);
            }
        }

        return $this;
    }

    public function getPromotion():?string
    {
        return $this->promotion;
    }

    public function setPromotion(?string $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getInscrit(): ?bool
    {
        return $this->inscrit;
    }

    public function setInscrit(bool $inscrit): self
    {
        $this->inscrit = $inscrit;

        return $this;
    } 
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setImageFile($image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getAdresses(): ?string
    {
        return $this->adresses;
    }

    public function setAdresses(?string $adresses): self
    {
        $this->adresses = $adresses;

        return $this;
    }

    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setEtudiant($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getEtudiant() === $this) {
                $inscription->setEtudiant(null);
            }
        }

        return $this;
    }


    public function __toString() {
        return $this->nom.' '.$this->prenom.'[ '.$this->getPromotion().' ]';
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

}