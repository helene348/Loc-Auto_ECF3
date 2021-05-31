<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 * @UniqueEntity("clientMail", message="Cette adresse mail est déjà prise, choisissez-en une autre")
 * @UniqueEntity("clientLogin", message="Cet identifiant est déjà pris, choisissez-en un autre")
 */
class Client implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $clientInscription;

    /**
     * @ORM\Column(type="json", length=255))
     */
    private $clientRole = ['ROLE_USER'];

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min = 3,
     *      max = 80,
     *      minMessage = "Votre prénom et nom doivent comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom et nom ne peuvent pas faire plus de {{ limit }} caractères"
     * )
     */
    private $clientNom;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min = 15,
     *      max = 100,
     *      minMessage = "Votre adresse doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre adresse ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $clientAdresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *  message="Le format de l'adresse mail n'est pas respecté" 
     * )
     * 
     */
    private $clientMail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(
     *  pattern="/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/",
     *  message="Le format du numéro de téléphone n'est pas respecté"
     * )
     */
    private $clientTelephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 1,
     *      max = 30,
     *      minMessage = "Votre login doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre login ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $clientLogin;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min = 8, minMessage = "Votre mot de passe doit faire au moins {{ limit }} caractères")
     */
    private $clientMdp;

    /**
     * @Assert\Length(min = 8, minMessage = "Votre mot de passe doit faire au moins {{ limit }} caractères")
     * @Assert\IdenticalTo(propertyPath="clientMdp", message = "Vous n'avez pas entré le même mot de passe que précédemment")
     */
    private $confirmMdp;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 5,
     *      max = 30,
     *      minMessage = "Votre numéro de permis doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre numéro de permis ne peut pas faire plus de {{ limit }} caractères"
     * )
     * 
     */
    private $clientNumeroPermis;

    /**
     * @ORM\Column(type="date", nullable=true)
     * 
     * 
     */
    private $clientValiditePermis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientInscription(): ?\DateTimeInterface
    {
        return $this->clientInscription;
    }

    public function setClientInscription(\DateTimeInterface $clientInscription): self
    {
        $this->clientInscription = $clientInscription;

        return $this;
    }

    public function getClientRole(): array
    {
        return $this->clientRole;
        $clientRole[] = 'ROLE_USER';
        return array_unique($clientRole);
    }

    public function setClientRole(string $clientRole): self
    {
        $this->clientRole = $clientRole;

        return $this;
    }

    public function getClientNom(): ?string
    {
        return $this->clientNom;
    }

    public function setClientNom(string $clientNom): self
    {
        $this->clientNom = $clientNom;

        return $this;
    }

    public function getClientAdresse(): ?string
    {
        return $this->clientAdresse;
    }

    public function setClientAdresse(string $clientAdresse): self
    {
        $this->clientAdresse = $clientAdresse;

        return $this;
    }

    public function getClientMail(): ?string
    {
        return $this->clientMail;
    }

    public function setClientMail(string $clientMail): self
    {
        $this->clientMail = $clientMail;

        return $this;
    }

    public function getClientTelephone(): ?string
    {
        return $this->clientTelephone;
    }

    public function setClientTelephone(?string $clientTelephone): self
    {
        $this->clientTelephone = $clientTelephone;

        return $this;
    }

    public function getClientLogin(): ?string
    {
        return $this->clientLogin;
    }

    public function setClientLogin(string $clientLogin): self
    {
        $this->clientLogin = $clientLogin;

        return $this;
    }

    public function getClientMdp(): ?string
    {
        return $this->clientMdp;
    }

    public function setClientMdp(string $clientMdp): self
    {
        $this->clientMdp = $clientMdp;

        return $this;
    }

    public function getConfirmMdp(): ?string
    {
        return $this->confirmMdp;
    }

    public function setConfirmMdp(string $confirmMdp): self
    {
        $this->confirmMdp = $confirmMdp;

        return $this;
    }

    public function getClientNumeroPermis(): ?string
    {
        return $this->clientNumeroPermis;
    }

    public function setClientNumeroPermis(string $clientNumeroPermis): self
    {
        $this->clientNumeroPermis = $clientNumeroPermis;

        return $this;
    }

    public function getClientValiditePermis(): ?\DateTimeInterface
    {
        return $this->clientValiditePermis;
    }

    public function setClientValiditePermis(?\DateTimeInterface $clientValiditePermis): self
    {
        $this->clientValiditePermis = $clientValiditePermis;

        return $this;
    }
    //



    public function getUsername(): ?string
    {
        return $this->clientLogin;
    }

    public function setUsername(string $clientLogin): self
    {
        $this->clientLogin = $clientLogin;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->clientMdp;
    }

    public function setPassword(string $clientMdp): self
    {
        $this->clientMdp = $clientMdp;

        return $this;
    }

    public function eraseCredentials()
    {
        
    }

    public function getSalt()
    {
        
    }
    public function getRoles(): array
    {
        return $this->clientRole;
        $clientRole[] ='ROLE_USER';
        return array_unique($clientRole);
    }
    public function setRoles(array $clientRole): self
    {
        $this->clientRole = $clientRole;
        return $this;
    }

}
