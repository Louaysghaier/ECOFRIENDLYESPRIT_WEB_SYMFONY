<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $lieuDepart = null;

    #[ORM\Column(length: 255)]
    private ?string $lieuArrive = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateTicket = null;

    #[ORM\Column(length: 255)]
    private ?string $statutTicket = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    private ?Transport $idTransport = null;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLieuDepart(): ?string
    {
        return $this->lieuDepart;
    }

    public function setLieuDepart(string $lieuDepart): static
    {
        $this->lieuDepart = $lieuDepart;

        return $this;
    }

    public function getLieuArrive(): ?string
    {
        return $this->lieuArrive;
    }

    public function setLieuArrive(string $lieuArrive): static
    {
        $this->lieuArrive = $lieuArrive;

        return $this;
    }

    public function getDateTicket(): ?\DateTimeInterface
    {
        return $this->dateTicket;
    }

    public function setDateTicket(\DateTimeInterface $dateTicket): static
    {
        $this->dateTicket = $dateTicket;

        return $this;
    }

    public function getStatutTicket(): ?string
    {
        return $this->statutTicket;
    }

    public function setStatutTicket(string $statutTicket): static
    {
        $this->statutTicket = $statutTicket;

        return $this;
    }

    public function getIdTransport(): ?Transport
    {
        return $this->idTransport;
    }

    public function setIdTransport(?Transport $idTransport): static
    {
        $this->idTransport = $idTransport;

        return $this;
    }
}
