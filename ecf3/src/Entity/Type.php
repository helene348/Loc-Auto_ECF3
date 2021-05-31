<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
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
     *      minMessage = "Le type doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le type ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $typeNom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeNom(): ?string
    {
        return $this->typeNom;
    }

    public function setTypeNom(string $typeNom): self
    {
        $this->typeNom = $typeNom;

        return $this;
    }
}
