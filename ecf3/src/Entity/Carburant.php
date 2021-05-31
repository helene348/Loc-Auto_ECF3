<?php

namespace App\Entity;

use App\Repository\CarburantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CarburantRepository::class)
 */
class Carburant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 1,
     *      max = 30,
     *      minMessage = "Le nom du carburant doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom du carburant ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $carburantNom;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $carburantPrix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarburantNom(): ?string
    {
        return $this->carburantNom;
    }

    public function setCarburantNom(string $carburantNom): self
    {
        $this->carburantNom = $carburantNom;

        return $this;
    }

    public function getCarburantPrix(): ?string
    {
        return $this->carburantPrix;
    }

    public function setCarburantPrix(string $carburantPrix): self
    {
        $this->carburantPrix = $carburantPrix;

        return $this;
    }
}
