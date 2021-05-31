<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AppAssert;
use AppBundle\Validator\Constraints\TelephoneRegex;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=AgenceRepository::class)
 * @UniqueEntity("agenceMail", message="Cette adresse mail est déjà prise, choisissez-en une autre")
 */
class Agence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min = 15,
     *      max = 100,
     *      minMessage = "Votre adresse doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre adresse ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $agenceAdresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *  pattern="/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/",
     *  message="Le format du numéro de téléphone n'est pas respecté"
     * )
     */
    private $agenceTelephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *  message="Le format de l'adresse mail n'est pas respecté" 
     * )
     */
    private $agenceMail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgenceAdresse(): ?string
    {
        return $this->agenceAdresse;
    }

    public function setAgenceAdresse(string $agenceAdresse): self
    {
        $this->agenceAdresse = $agenceAdresse;

        return $this;
    }

    public function getAgenceTelephone(): ?string
    {
        return $this->agenceTelephone;
    }

    public function setAgenceTelephone(string $agenceTelephone): self
    {
        $this->agenceTelephone = $agenceTelephone;

        return $this;
    }

    public function getAgenceMail(): ?string
    {
        return $this->agenceMail;
    }

    public function setAgenceMail(string $agenceMail): self
    {
        $this->agenceMail = $agenceMail;

        return $this;
    }
}
