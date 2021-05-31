<?php

namespace App\Entity;

use App\Repository\AssuranceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AssuranceRepository::class)
 */
class Assurance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $assurancePrixJour;

    /**
     * @ORM\Column(type="date")
     */
    private $assuranceDatePrix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssurancePrixJour(): ?string
    {
        return $this->assurancePrixJour;
    }

    public function setAssurancePrixJour(string $assurancePrixJour): self
    {
        $this->assurancePrixJour = $assurancePrixJour;

        return $this;
    }

    public function getAssuranceDatePrix(): ?\DateTimeInterface
    {
        return $this->assuranceDatePrix;
    }

    public function setAssuranceDatePrix(\DateTimeInterface $assuranceDatePrix): self
    {
        $this->assuranceDatePrix = $assuranceDatePrix;

        return $this;
    }

}
