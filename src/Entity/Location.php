<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(nullable: true)]
    private ?int $NbreRadiateur = null;

    #[ORM\Column]
    private ?bool $Chaudiere = null;

    #[ORM\Column]
    private ?bool $ChauffeEau = null;

    /**
     * @var Collection<int, Chauffage>
     */
    #[ORM\ManyToMany(targetEntity: Chauffage::class, inversedBy: 'locations')]
    private Collection $Chauffages;

    #[ORM\ManyToOne(inversedBy: 'Appartements')]
    private ?Internet $internet = null;

    /**
     * @var Collection<int, EauChaudeSanitaire>
     */
    #[ORM\ManyToMany(targetEntity: EauChaudeSanitaire::class, mappedBy: 'locations')]
    private Collection $eauChaudeSanitaires;

    public function __construct()
    {
        $this->Chauffages = new ArrayCollection();
        $this->eauChaudeSanitaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getNbreRadiateur(): ?int
    {
        return $this->NbreRadiateur;
    }

    public function setNbreRadiateur(?int $NbreRadiateur): static
    {
        $this->NbreRadiateur = $NbreRadiateur;

        return $this;
    }

    public function isChaudiere(): ?bool
    {
        return $this->Chaudiere;
    }

    public function setChaudiere(bool $Chaudiere): static
    {
        $this->Chaudiere = $Chaudiere;

        return $this;
    }

    public function isChauffeEau(): ?bool
    {
        return $this->ChauffeEau;
    }

    public function setChauffeEau(bool $ChauffeEau): static
    {
        $this->ChauffeEau = $ChauffeEau;

        return $this;
    }

    /**
     * @return Collection<int, Chauffage>
     */
    public function getChauffages(): Collection
    {
        return $this->Chauffages;
    }

    public function addChauffage(Chauffage $chauffage): static
    {
        if (!$this->Chauffages->contains($chauffage)) {
            $this->Chauffages->add($chauffage);
        }

        return $this;
    }

    public function removeChauffage(Chauffage $chauffage): static
    {
        $this->Chauffages->removeElement($chauffage);

        return $this;
    }

    public function getInternet(): ?Internet
    {
        return $this->internet;
    }

    public function setInternet(?Internet $internet): static
    {
        $this->internet = $internet;

        return $this;
    }

    /**
     * @return Collection<int, EauChaudeSanitaire>
     */
    public function getEauChaudeSanitaires(): Collection
    {
        return $this->eauChaudeSanitaires;
    }

    public function addEauChaudeSanitaire(EauChaudeSanitaire $eauChaudeSanitaire): static
    {
        if (!$this->eauChaudeSanitaires->contains($eauChaudeSanitaire)) {
            $this->eauChaudeSanitaires->add($eauChaudeSanitaire);
            $eauChaudeSanitaire->addLocation($this);
        }

        return $this;
    }

    public function removeEauChaudeSanitaire(EauChaudeSanitaire $eauChaudeSanitaire): static
    {
        if ($this->eauChaudeSanitaires->removeElement($eauChaudeSanitaire)) {
            $eauChaudeSanitaire->removeLocation($this);
        }

        return $this;
    }
}
