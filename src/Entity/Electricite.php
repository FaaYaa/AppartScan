<?php

namespace App\Entity;

use App\Repository\ElectriciteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElectriciteRepository::class)]
class Electricite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $NumCompteur = null;

    #[ORM\Column]
    private ?int $ReleveHP = null;

    #[ORM\Column]
    private ?int $ReleveHC = null;

    #[ORM\OneToOne(inversedBy: 'electricite', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCompteur(): ?int
    {
        return $this->NumCompteur;
    }

    public function setNumCompteur(int $NumCompteur): static
    {
        $this->NumCompteur = $NumCompteur;

        return $this;
    }

    public function getReleveHP(): ?int
    {
        return $this->ReleveHP;
    }

    public function setReleveHP(int $ReleveHP): static
    {
        $this->ReleveHP = $ReleveHP;

        return $this;
    }

    public function getReleveHC(): ?int
    {
        return $this->ReleveHC;
    }

    public function setReleveHC(int $ReleveHC): static
    {
        $this->ReleveHC = $ReleveHC;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): static
    {
        $this->location = $location;

        return $this;
    }
}
