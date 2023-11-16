<?php

namespace App\Entity;

use App\Repository\TransportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Transport
 *
 * @ORM\Table(name="transport", indexes={@ORM\Index(name="fk_iduser3", columns={"idUser"})})
 * @ORM\Entity(repositoryClass=TransportRepository::class)
 */
class Transport
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTransport", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtransport;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrePlaces", type="integer", nullable=false)
     */
    private $nbreplaces;

    /**
     * @var string
     *
     * @ORM\Column(name="typeTransport", type="string", length=100, nullable=false)
     */
    private $typetransport;

    /**
     * @var string
     *
     * @ORM\Column(name="disponibilite", type="string", length=100, nullable=false)
     */
    private $disponibilite;

    /**
     * @var string
     *
     * @ORM\Column(name="politiqueBagages", type="string", length=100, nullable=false)
     */
    private $politiquebagages;

    /**
     * @var \User2
     *
     * @ORM\ManyToOne(targetEntity="User2")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="iduser")
     * })
     */
    private $iduser;

    public function getIdtransport(): ?int
    {
        return $this->idtransport;
    }

    public function getNbreplaces(): ?int
    {
        return $this->nbreplaces;
    }

    public function setNbreplaces(int $nbreplaces): static
    {
        $this->nbreplaces = $nbreplaces;

        return $this;
    }

    public function getTypetransport(): ?string
    {
        return $this->typetransport;
    }

    public function setTypetransport(string $typetransport): static
    {
        $this->typetransport = $typetransport;

        return $this;
    }

    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(string $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getPolitiquebagages(): ?string
    {
        return $this->politiquebagages;
    }

    public function setPolitiquebagages(string $politiquebagages): static
    {
        $this->politiquebagages = $politiquebagages;

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
