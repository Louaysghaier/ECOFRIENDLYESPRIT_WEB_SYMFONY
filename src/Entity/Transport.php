<?php

namespace App\Entity;

use App\Repository\TransportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransportRepository::class)]
class Transport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbrePlaces = null;

    #[ORM\Column(length: 255)]
    private ?string $typeTransport = null;

    #[ORM\Column(length: 255)]
    private ?string $disponibilite = null;

    #[ORM\OneToMany(mappedBy: 'idTransport', targetEntity: Ticket::class)]
    private Collection $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrePlaces(): ?int
    {
        return $this->nbrePlaces;
    }

    public function setNbrePlaces(int $nbrePlaces): static
    {
        $this->nbrePlaces = $nbrePlaces;

        return $this;
    }

    public function getTypeTransport(): ?string
    {
        return $this->typeTransport;
    }

    public function setTypeTransport(string $typeTransport): static
    {
        $this->typeTransport = $typeTransport;

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

    /**
     * @return Collection<int, Ticket>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): static
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets->add($ticket);
            $ticket->setIdTransport($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): static
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getIdTransport() === $this) {
                $ticket->setIdTransport(null);
            }
        }

       
       
 return $this;

}
public function __toString()
{
    return $this->getTypeTransport();
}

}
