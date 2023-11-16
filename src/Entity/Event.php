<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEvent", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevent;

    /**
     * @var string
     *
     * @ORM\Column(name="LieuEvent", type="string", length=100, nullable=false)
     */
    private $lieuevent;

    /**
     * @var string
     *
     * @ORM\Column(name="dateDebutEvent", type="string", length=100, nullable=false)
     */
    private $datedebutevent;

    /**
     * @var string
     *
     * @ORM\Column(name="Durée", type="string", length=255, nullable=false)
     */
    private $durée;

    /**
     * @var string
     *
     * @ORM\Column(name="nbmaxParticipant", type="string", length=100, nullable=false)
     */
    private $nbmaxparticipant;

    /**
     * @var string
     *
     * @ORM\Column(name="PrixTicket", type="string", length=100, nullable=false)
     */
    private $prixticket;

    /**
     * @var string
     *
     * @ORM\Column(name="nomEvent", type="string", length=100, nullable=false)
     */
    private $nomevent;

    /**
     * @var string
     *
     * @ORM\Column(name="typeEvent", type="string", length=100, nullable=false)
     */
    private $typeevent;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEvent", type="string", length=100, nullable=false)
     */
    private $descriptionevent;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=false)
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Datecreation", type="date", nullable=false)
     */
    private $datecreation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="iduser", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $iduser = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="valid", type="string", length=255, nullable=true, options={"default"="'valid'"})
     */
    private $valid = '\'valid\'';

    public function getIdevent(): ?int
    {
        return $this->idevent;
    }

    public function getLieuevent(): ?string
    {
        return $this->lieuevent;
    }

    public function setLieuevent(string $lieuevent): static
    {
        $this->lieuevent = $lieuevent;

        return $this;
    }

    public function getDatedebutevent(): ?string
    {
        return $this->datedebutevent;
    }

    public function setDatedebutevent(string $datedebutevent): static
    {
        $this->datedebutevent = $datedebutevent;

        return $this;
    }

    public function getDurée(): ?string
    {
        return $this->durée;
    }

    public function setDurée(string $durée): static
    {
        $this->durée = $durée;

        return $this;
    }

    public function getNbmaxparticipant(): ?string
    {
        return $this->nbmaxparticipant;
    }

    public function setNbmaxparticipant(string $nbmaxparticipant): static
    {
        $this->nbmaxparticipant = $nbmaxparticipant;

        return $this;
    }

    public function getPrixticket(): ?string
    {
        return $this->prixticket;
    }

    public function setPrixticket(string $prixticket): static
    {
        $this->prixticket = $prixticket;

        return $this;
    }

    public function getNomevent(): ?string
    {
        return $this->nomevent;
    }

    public function setNomevent(string $nomevent): static
    {
        $this->nomevent = $nomevent;

        return $this;
    }

    public function getTypeevent(): ?string
    {
        return $this->typeevent;
    }

    public function setTypeevent(string $typeevent): static
    {
        $this->typeevent = $typeevent;

        return $this;
    }

    public function getDescriptionevent(): ?string
    {
        return $this->descriptionevent;
    }

    public function setDescriptionevent(string $descriptionevent): static
    {
        $this->descriptionevent = $descriptionevent;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): static
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(?int $iduser): static
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getValid(): ?string
    {
        return $this->valid;
    }

    public function setValid(?string $valid): static
    {
        $this->valid = $valid;

        return $this;
    }


}
