<?php

namespace App\Entity;

use App\Repository\ReserverRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReserverRepository::class)
 */
class Reserver
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\GreaterThanOrEqual("today")
     */
    private $reservationDebutPrevu;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\GreaterThan(propertyPath="reservationDebutPrevu")
     */
    private $reservationFinPrevue;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $reservationDebutEffectif;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\GreaterThan(
     *  propertyPath="reservationDebutEffectif",
     *  message="La date de rendu du véhicule doit être supérieure à la date de prise "
     * )
     */
    private $reservationFinEffective;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Assert\LessThan(
     *  value = 500000,
     *  message="Le kilométrage ne doit pas être supérieur à 500 000 kms"
     * )
     */
    private $reservationKmDebut;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Assert\GreaterThan(
     *  propertyPath="reservationKmDebut",
     *  message="Le kilométrage de retour doit être plus élevé que celui relevé lors du départ du véhicule"
     * )
     * @Assert\LessThan(
     *  value = 500000,
     *  message="Le kilométrage ne doit pas être supérieur à 500 000 kms"
     * )
     * 
     */
    private $reservationKmFin;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     * @Assert\LessThanOrEqual(
     *  propertyPath="vehicule.vehiculeTailleReservoir",
     *  message="Le volume de carburant ne peut pas être supérieur à la taile du réservoir"
     * )
     */
    private $reservationReservoirFin;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Vehicule::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservationDebutPrevu(): ?\DateTimeInterface
    {
        return $this->reservationDebutPrevu;
    }

    public function setReservationDebutPrevu(\DateTimeInterface $reservationDebutPrevu): self
    {
        $this->reservationDebutPrevu = $reservationDebutPrevu;

        return $this;
    }

    public function getReservationFinPrevue(): ?\DateTimeInterface
    {
        return $this->reservationFinPrevue;
    }

    public function setReservationFinPrevue(\DateTimeInterface $reservationFinPrevue): self
    {
        $this->reservationFinPrevue = $reservationFinPrevue;

        return $this;
    }

    public function getReservationDebutEffectif(): ?\DateTimeInterface
    {
        return $this->reservationDebutEffectif;
    }

    public function setReservationDebutEffectif(\DateTimeInterface $reservationDebutEffectif): self
    {
        $this->reservationDebutEffectif = $reservationDebutEffectif;

        return $this;
    }

    public function getReservationFinEffective(): ?\DateTimeInterface
    {
        return $this->reservationFinEffective;
    }

    public function setReservationFinEffective(\DateTimeInterface $reservationFinEffective): self
    {
        $this->reservationFinEffective = $reservationFinEffective;

        return $this;
    }

    public function getReservationKmDebut(): ?string
    {
        return $this->reservationKmDebut;
    }

    public function setReservationKmDebut(string $reservationKmDebut): self
    {
        $this->reservationKmDebut = $reservationKmDebut;

        return $this;
    }

    public function getReservationKmFin(): ?string
    {
        return $this->reservationKmFin;
    }

    public function setReservationKmFin(string $reservationKmFin): self
    {
        $this->reservationKmFin = $reservationKmFin;

        return $this;
    }

    public function getReservationReservoirFin(): ?string
    {
        return $this->reservationReservoirFin;
    }

    public function setReservationReservoirFin(string $reservationReservoirFin): self
    {
        $this->reservationReservoirFin = $reservationReservoirFin;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }
    public function __toString() {
        return $this->reservationDebutPrevu;
    }
}
