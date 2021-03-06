<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 38)]
    private $PER_NOM;

    #[ORM\Column(type: 'string', length: 38, nullable: true)]
    private $PER_PRENOM;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $PER_MAIL;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $PER_TEL_PERSO;

    #[ORM\ManyToOne(targetEntity: Entreprise::class)]
    #[ORM\JoinColumn(nullable: true, onDelete:"SET NULL")]
    private $entreprise;

    #[ORM\ManyToMany(targetEntity: Profil::class, inversedBy: 'personnes')]
    private $profils;

    #[ORM\ManyToMany(targetEntity: Fonction::class, inversedBy: 'personnes')]
    private $fonctions;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $PER_TEL_PRO;

    public function __construct()
    {
        $this->profils = new ArrayCollection();
        $this->fonctions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPERNOM(): ?string
    {
        return $this->PER_NOM;
    }

    public function setPERNOM(string $PER_NOM): self
    {
        $this->PER_NOM = $PER_NOM;

        return $this;
    }

    public function getPERPRENOM(): ?string
    {
        return $this->PER_PRENOM;
    }

    public function setPERPRENOM(string $PER_PRENOM): self
    {
        $this->PER_PRENOM = $PER_PRENOM;

        return $this;
    }

    public function getPERMAIL(): ?string
    {
        return $this->PER_MAIL;
    }

    public function setPERMAIL(?string $PER_MAIL): self
    {
        $this->PER_MAIL = $PER_MAIL;

        return $this;
    }

    public function getPERTELPERSO(): ?string
    {
        return $this->PER_TEL_PERSO;
    }

    public function setPERTELPERSO(?string $PER_TEL_PERSO): self
    {
        $this->PER_TEL_PERSO = $PER_TEL_PERSO;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self 
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * @return Collection<int, Profil>
     */
    public function getProfils(): Collection
    {
        return $this->profils;
    }

    public function addProfil(Profil $profil): self
    {
        if (!$this->profils->contains($profil)) {
            $this->profils[] = $profil;
        }

        return $this;
    }

    public function removeProfil(Profil $profil): self
    {
        $this->profils->removeElement($profil);

        return $this;
    }

    /**
     * @return Collection<int, Fonction>
     */
    public function getFonctions(): Collection
    {
        return $this->fonctions;
    }

    public function addFonction(Fonction $fonction): self
    {
        if (!$this->fonctions->contains($fonction)) {
            $this->fonctions[] = $fonction;
        }

        return $this;
    }

    public function removeFonction(Fonction $fonction): self
    {
        $this->fonctions->removeElement($fonction);

        return $this;
    }

    public function getPERTELPRO(): ?string
    {
        return $this->PER_TEL_PRO;
    }

    public function setPERTELPRO(?string $PER_TEL_PRO): self
    {
        $this->PER_TEL_PRO = $PER_TEL_PRO;

        return $this;
    }
}
