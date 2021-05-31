<?php

namespace App\Entity;

use App\Repository\JourRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=JourRepository::class)
 */
class Jour
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
    private $jourPrix;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $jourKmPrix;

    /**
     * @ORM\Column(type="time")
     */
    private $jourDebut;

    /**
     * @ORM\Column(type="time")
     * @Assert\GreaterThan(
     *  propertyPath="jourDebut",
     *  message="L'heure de fin de journée doit être supérieure à l'heure de début"
     * )
     */
    private $jourFin;

    /**
     * @ORM\Column(type="date")
     */
    private $jourDatePrix;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $jourRemise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJourPrix(): ?string
    {
        return $this->jourPrix;
    }

    public function setJourPrix(string $jourPrix): self
    {
        $this->jourPrix = $jourPrix;

        return $this;
    }

    public function getJourKmPrix(): ?string
    {
        return $this->jourKmPrix;
    }

    public function setJourKmPrix(string $jourKmPrix): self
    {
        $this->jourKmPrix = $jourKmPrix;

        return $this;
    }

    public function getJourDebut(): ?\DateTimeInterface
    {
        return $this->jourDebut;
    }

    public function setJourDebut(\DateTimeInterface $jourDebut): self
    {
        $this->jourDebut = $jourDebut;

        return $this;
    }

    public function getJourFin(): ?\DateTimeInterface
    {
        return $this->jourFin;
    }

    public function setJourFin(\DateTimeInterface $jourFin): self
    {
        $this->jourFin = $jourFin;

        return $this;
    }

    public function getJourDatePrix(): ?\DateTimeInterface
    {
        return $this->jourDatePrix;
    }

    public function setJourDatePrix(\DateTimeInterface $jourDatePrix): self
    {
        $this->jourDatePrix = $jourDatePrix;

        return $this;
    }

    public function getJourRemise(): ?string
    {
        return $this->jourRemise;
    }

    public function setJourRemise(?string $jourRemise): self
    {
        $this->jourRemise = $jourRemise;

        return $this;
    }
}
