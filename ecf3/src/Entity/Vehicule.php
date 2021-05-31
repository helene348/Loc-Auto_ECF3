<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=VehiculeRepository::class)
 */
class Vehicule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *  pattern="/^[A-Z]{2}-[0-9]{3}-[A-Z]{2}$/",
     *  message="Le format de la plaque d'immatriculation n'est pas respecté"
     * )
     */
    private $vehiculeImmatriculation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 1,
     *      max = 30,
     *      minMessage = "Le modèle doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Le modèle ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $vehiculeModele;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 1,
     *      max = 30,
     *      minMessage = "La marque doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "La marque ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $vehiculeMarque;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(
     *      max = 100,
     *      maxMessage = "Les équipements ne peuvent pas faire plus de {{ limit }} caractères"
     * )
     */
    private $vehiculeEquipements;

    /**
     * @ORM\Column(type="integer")
     * @Assert\LessThan(
     *  value = 1000,
     *  message="Le volume du réservoir doit être inférieur à 1000 litres"
     * )
     * @Assert\GreaterThan(
     *  value = 2,
     *  message="Le volume du réservoir doit être supérieur à 2 litres"
     * )
     */
    private $vehiculeTailleReservoir;

    /**
     * @ORM\Column(type="date")
     */
    private $vehiculeDateAchat;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\GreaterThan(
     *  propertyPath="vehiculeDateAchat",
     *  message="La date de vente doit être supérieure à la date d'achat"
     * )
     */
    private $vehiculeDateVente;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $agences;

    /**
     * @ORM\ManyToOne(targetEntity=Carburant::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $carburants;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $types;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehiculeImmatriculation(): ?string
    {
        return $this->vehiculeImmatriculation;
    }

    public function setVehiculeImmatriculation(string $vehiculeImmatriculation): self
    {
        $this->vehiculeImmatriculation = $vehiculeImmatriculation;

        return $this;
    }

    public function getVehiculeModele(): ?string
    {
        return $this->vehiculeModele;
    }

    public function setVehiculeModele(string $vehiculeModele): self
    {
        $this->vehiculeModele = $vehiculeModele;

        return $this;
    }

    public function getVehiculeMarque(): ?string
    {
        return $this->vehiculeMarque;
    }

    public function setVehiculeMarque(string $vehiculeMarque): self
    {
        $this->vehiculeMarque = $vehiculeMarque;

        return $this;
    }

    public function getVehiculeEquipements(): ?string
    {
        return $this->vehiculeEquipements;
    }

    public function setVehiculeEquipements(?string $vehiculeEquipements): self
    {
        $this->vehiculeEquipements = $vehiculeEquipements;

        return $this;
    }

    public function getVehiculeTailleReservoir(): ?int
    {
        return $this->vehiculeTailleReservoir;
    }

    public function setVehiculeTailleReservoir(int $vehiculeTailleReservoir): self
    {
        $this->vehiculeTailleReservoir = $vehiculeTailleReservoir;

        return $this;
    }

    public function getVehiculeDateAchat(): ?\DateTimeInterface
    {
        return $this->vehiculeDateAchat;
    }

    public function setVehiculeDateAchat(\DateTimeInterface $vehiculeDateAchat): self
    {
        $this->vehiculeDateAchat = $vehiculeDateAchat;

        return $this;
    }

    public function getVehiculeDateVente(): ?\DateTimeInterface
    {
        return $this->vehiculeDateVente;
    }

    public function setVehiculeDateVente(?\DateTimeInterface $vehiculeDateVente): self
    {
        $this->vehiculeDateVente = $vehiculeDateVente;

        return $this;
    }

    public function getCategories(): ?Categorie
    {
        return $this->categories;
    }

    public function setCategories(?Categorie $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getAgences(): ?Agence
    {
        return $this->agences;
    }

    public function setAgences(?Agence $agences): self
    {
        $this->agences = $agences;

        return $this;
    }

    public function getCarburants(): ?Carburant
    {
        return $this->carburants;
    }

    public function setCarburants(?Carburant $carburants): self
    {
        $this->carburants = $carburants;

        return $this;
    }

    public function getTypes(): ?Type
    {
        return $this->types;
    }

    public function setTypes(?Type $types): self
    {
        $this->types = $types;

        return $this;
    }
    public function __toString() {
        return $this->vehiculeMarque;
    }
}
