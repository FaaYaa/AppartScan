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

    /**
     * @var Collection<int, Cle>
     */
    #[ORM\OneToMany(targetEntity: Cle::class, mappedBy: 'location')]
    private Collection $cles;

    #[ORM\OneToOne(mappedBy: 'location', cascade: ['persist', 'remove'])]
    private ?Electricite $electricite = null;

    #[ORM\OneToOne(mappedBy: 'location', cascade: ['persist', 'remove'])]
    private ?Gaz $gaz = null;

    /**
     * @var Collection<int, Piece>
     */
    #[ORM\OneToMany(targetEntity: Piece::class, mappedBy: 'location')]
    private Collection $pieces;

    public function __construct()
    {
        $this->Chauffages = new ArrayCollection();
        $this->eauChaudeSanitaires = new ArrayCollection();
        $this->cles = new ArrayCollection();
        $this->pieces = new ArrayCollection();
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

    /**
     * @return Collection<int, Cle>
     */
    public function getCles(): Collection
    {
        return $this->cles;
    }

    public function addCle(Cle $cle): static
    {
        if (!$this->cles->contains($cle)) {
            $this->cles->add($cle);
            $cle->setLocation($this);
        }

        return $this;
    }

    public function removeCle(Cle $cle): static
    {
        if ($this->cles->removeElement($cle)) {
            // set the owning side to null (unless already changed)
            if ($cle->getLocation() === $this) {
                $cle->setLocation(null);
            }
        }

        return $this;
    }

    public function getElectricite(): ?Electricite
    {
        return $this->electricite;
    }

    public function setElectricite(Electricite $electricite): static
    {
        // set the owning side of the relation if necessary
        if ($electricite->getLocation() !== $this) {
            $electricite->setLocation($this);
        }

        $this->electricite = $electricite;

        return $this;
    }

    public function getGaz(): ?Gaz
    {
        return $this->gaz;
    }

    public function setGaz(Gaz $gaz): static
    {
        // set the owning side of the relation if necessary
        if ($gaz->getLocation() !== $this) {
            $gaz->setLocation($this);
        }

        $this->gaz = $gaz;

        return $this;
    }

    /**
     * @return Collection<int, Piece>
     */
    public function getPieces(): Collection
    {
        return $this->pieces;
    }

    public function addPiece(Piece $piece): static
    {
        if (!$this->pieces->contains($piece)) {
            $this->pieces->add($piece);
            $piece->setLocation($this);
        }

        return $this;
    }

    public function removePiece(Piece $piece): static
    {
        if ($this->pieces->removeElement($piece)) {
            // set the owning side to null (unless already changed)
            if ($piece->getLocation() === $this) {
                $piece->setLocation(null);
            }
        }

        return $this;
    }
}
