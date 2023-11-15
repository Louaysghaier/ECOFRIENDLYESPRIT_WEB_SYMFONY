<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idUser = null;

    #[ORM\Column(length: 255)]
    private ?string $NomUser = null;

    #[ORM\Column(length: 255)]
    private ?string $PrenomUser = null;

    #[ORM\Column(length: 255)]
    private ?string $mailUser = null;

    #[ORM\Column(length: 255)]
    private ?string $mdpUser = null;

    #[ORM\Column(length: 255)]
    private ?string $AdresseUser = null;

    #[ORM\Column(length: 255)]
    private ?string $ClasseUser = null;

    #[ORM\Column]
    private ?bool $isBlocked = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getNomUser(): ?string
    {
        return $this->NomUser;
    }

    public function setNomUser(string $NomUser): static
    {
        $this->NomUser = $NomUser;

        return $this;
    }

    public function getPrenomUser(): ?string
    {
        return $this->PrenomUser;
    }

    public function setPrenomUser(string $PrenomUser): static
    {
        $this->PrenomUser = $PrenomUser;

        return $this;
    }

    public function getMailUser(): ?string
    {
        return $this->mailUser;
    }

    public function setMailUser(string $mailUser): static
    {
        $this->mailUser = $mailUser;

        return $this;
    }

    public function getMdpUser(): ?string
    {
        return $this->mdpUser;
    }

    public function setMdpUser(string $mdpUser): static
    {
        $this->mdpUser = $mdpUser;

        return $this;
    }

    public function getAdresseUser(): ?string
    {
        return $this->AdresseUser;
    }

    public function setAdresseUser(string $AdresseUser): static
    {
        $this->AdresseUser = $AdresseUser;

        return $this;
    }

    public function getClasseUser(): ?string
    {
        return $this->ClasseUser;
    }

    public function setClasseUser(string $ClasseUser): static
    {
        $this->ClasseUser = $ClasseUser;

        return $this;
    }

    public function isIsBlocked(): ?bool
    {
        return $this->isBlocked;
    }

    public function setIsBlocked(bool $isBlocked): static
    {
        $this->isBlocked = $isBlocked;

        return $this;
    }
    
    public function getUser(): ?string
    {
        return $this->username;
    }
   
   
}
