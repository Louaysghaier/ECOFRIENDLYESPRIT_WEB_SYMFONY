<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="fk_event", columns={"idEvent"}), @ORM\Index(name="fk-iduser", columns={"idUser"})})
 * @ORM\Entity(repositoryClass=ParticipationRepository::class)
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idParticipation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparticipation;

    /**
     * @var string
     *
     * @ORM\Column(name="codeQR", type="string", length=200, nullable=false)
     */
    private $codeqr;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateParticipation", type="date", nullable=true, options={"default"="NULL"})
     */
    private $dateparticipation = 'NULL';

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEvent", referencedColumnName="idEvent")
     * })
     */
    private $idevent;

    /**
     * @var \User2
     *
     * @ORM\ManyToOne(targetEntity="User2")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="iduser")
     * })
     */
    private $iduser;

    public function getIdparticipation(): ?int
    {
        return $this->idparticipation;
    }

    public function getCodeqr(): ?string
    {
        return $this->codeqr;
    }

    public function setCodeqr(string $codeqr): static
    {
        $this->codeqr = $codeqr;

        return $this;
    }

    public function getDateparticipation(): ?\DateTimeInterface
    {
        return $this->dateparticipation;
    }

    public function setDateparticipation(?\DateTimeInterface $dateparticipation): static
    {
        $this->dateparticipation = $dateparticipation;

        return $this;
    }

    public function getIdevent(): ?Event
    {
        return $this->idevent;
    }

    public function setIdevent(?Event $idevent): static
    {
        $this->idevent = $idevent;

        return $this;
    }

    public function getIduser(): ?User2
    {
        return $this->iduser;
    }

    public function setIduser(?User2 $iduser): static
    {
        $this->iduser = $iduser;

        return $this;
    }


}
