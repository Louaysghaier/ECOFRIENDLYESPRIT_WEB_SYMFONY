<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTicket", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idticket;

    /**
     * @var int
     *
     * @ORM\Column(name="idTransport", type="integer", nullable=false)
     */
    private $idtransport;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuDepart", type="string", length=100, nullable=false)
     */
    private $lieudepart;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuArrive", type="string", length=100, nullable=false)
     */
    private $lieuarrive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTicket", type="date", nullable=false)
     */
    private $dateticket;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dureeEstimeeDuTrajet", type="date", nullable=false)
     */
    private $dureeestimeedutrajet;

    /**
     * @var string
     *
     * @ORM\Column(name="statutTicket", type="string", length=100, nullable=false)
     */
    private $statutticket;

    /**
     * @var string
     *
     * @ORM\Column(name="typeTicket", type="string", length=100, nullable=false)
     */
    private $typeticket;

    public function getIdticket(): ?int
    {
        return $this->idticket;
    }

    public function getIdtransport(): ?int
    {
        return $this->idtransport;
    }

    public function setIdtransport(int $idtransport): static
    {
        $this->idtransport = $idtransport;

        return $this;
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

    public function getLieudepart(): ?string
    {
        return $this->lieudepart;
    }

    public function setLieudepart(string $lieudepart): static
    {
        $this->lieudepart = $lieudepart;

        return $this;
    }

    public function getLieuarrive(): ?string
    {
        return $this->lieuarrive;
    }

    public function setLieuarrive(string $lieuarrive): static
    {
        $this->lieuarrive = $lieuarrive;

        return $this;
    }

    public function getDateticket(): ?\DateTimeInterface
    {
        return $this->dateticket;
    }

    public function setDateticket(\DateTimeInterface $dateticket): static
    {
        $this->dateticket = $dateticket;

        return $this;
    }

    public function getDureeestimeedutrajet(): ?\DateTimeInterface
    {
        return $this->dureeestimeedutrajet;
    }

    public function setDureeestimeedutrajet(\DateTimeInterface $dureeestimeedutrajet): static
    {
        $this->dureeestimeedutrajet = $dureeestimeedutrajet;

        return $this;
    }

    public function getStatutticket(): ?string
    {
        return $this->statutticket;
    }

    public function setStatutticket(string $statutticket): static
    {
        $this->statutticket = $statutticket;

        return $this;
    }

    public function getTypeticket(): ?string
    {
        return $this->typeticket;
    }

    public function setTypeticket(string $typeticket): static
    {
        $this->typeticket = $typeticket;

        return $this;
    }


}
