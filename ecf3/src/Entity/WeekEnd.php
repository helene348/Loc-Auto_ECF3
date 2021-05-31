<?php

namespace App\Entity;

use App\Repository\WeekEndRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WeekEndRepository::class)
 */
class WeekEnd
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
    private $wkPrix;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $wkKmPrix;

    /**
     * @ORM\Column(type="time")
     */
    private $wkDebut;

    /**
     * @ORM\Column(type="time")
     */
    private $wkFin;

    /**
     * @ORM\Column(type="date")
     */
    private $wkDatePrix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWkPrix(): ?string
    {
        return $this->wkPrix;
    }

    public function setWkPrix(string $wkPrix): self
    {
        $this->wkPrix = $wkPrix;

        return $this;
    }

    public function getWkKmPrix(): ?string
    {
        return $this->wkKmPrix;
    }

    public function setWkKmPrix(string $wkKmPrix): self
    {
        $this->wkKmPrix = $wkKmPrix;

        return $this;
    }

    public function getWkDebut(): ?\DateTimeInterface
    {
        return $this->wkDebut;
    }

    public function setWkDebut(\DateTimeInterface $wkDebut): self
    {
        $this->wkDebut = $wkDebut;

        return $this;
    }

    public function getWkFin(): ?\DateTimeInterface
    {
        return $this->wkFin;
    }

    public function setWkFin(\DateTimeInterface $wkFin): self
    {
        $this->wkFin = $wkFin;

        return $this;
    }

    public function getWkDatePrix(): ?\DateTimeInterface
    {
        return $this->wkDatePrix;
    }

    public function setWkDatePrix(\DateTimeInterface $wkDatePrix): self
    {
        $this->wkDatePrix = $wkDatePrix;

        return $this;
    }
}
