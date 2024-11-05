<?php

namespace App\Entity;

use App\Repository\CleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CleRepository::class)]
class Cle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeCle = null;

    #[ORM\Column]
    private ?int $NombreCle = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\ManyToOne(inversedBy: 'cles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeCle(): ?string
    {
        return $this->TypeCle;
    }

    public function setTypeCle(string $TypeCle): static
    {
        $this->TypeCle = $TypeCle;

        return $this;
    }

    public function getNombreCle(): ?int
    {
        return $this->NombreCle;
    }

    public function setNombreCle(int $NombreCle): static
    {
        $this->NombreCle = $NombreCle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }
}
