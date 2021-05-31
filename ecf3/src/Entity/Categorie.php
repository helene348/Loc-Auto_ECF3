<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
     *      minMessage = "Le nom de la catégorie doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de la catégorie ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $categorieType;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $cautionPrix;

    /**
     * @ORM\ManyToOne(targetEntity=Jour::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $jours;

    /**
     * @ORM\ManyToOne(targetEntity=WeekEnd::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $weekEnds;

    /**
     * @ORM\ManyToOne(targetEntity=Assurance::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $assurance;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorieType(): ?string
    {
        return $this->categorieType;
    }

    public function setCategorieType(string $categorieType): self
    {
        $this->categorieType = $categorieType;

        return $this;
    }

    public function getCautionPrix(): ?string
    {
        return $this->cautionPrix;
    }

    public function setCautionPrix(string $cautionPrix): self
    {
        $this->cautionPrix = $cautionPrix;

        return $this;
    }

    public function getJours(): ?Jour
    {
        return $this->jours;
    }

    public function setJours(?Jour $jours): self
    {
        $this->jours = $jours;

        return $this;
    }

    public function getWeekEnds(): ?WeekEnd
    {
        return $this->weekEnds;
    }

    public function setWeekEnds(?WeekEnd $weekEnds): self
    {
        $this->weekEnds = $weekEnds;

        return $this;
    }


    public function getAssurance(): ?Assurance
    {
        return $this->assurance;
    }

    public function setAssurance(?Assurance $assurance): self
    {
        $this->assurance = $assurance;

        return $this;
    }
    public function __toString( ) {
        return $this->categorieType;
    }
}

