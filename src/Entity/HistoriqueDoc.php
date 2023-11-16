<?php

namespace App\Entity;

use App\Repository\HistoriqueDocRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * HistoriqueDoc
 *
 * @ORM\Table(name="historique_doc")
 * @ORM\Entity(repositoryClass=HistoriqueDocRepository::class)
 */
class HistoriqueDoc
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var int
     *
     * @ORM\Column(name="idDoc", type="integer", nullable=false)
     */
    private $iddoc;

    /**
     * @var string
     *
     * @ORM\Column(name="operation", type="string", length=200, nullable=false)
     */
    private $operation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(int $iduser): static
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getIddoc(): ?int
    {
        return $this->iddoc;
    }

    public function setIddoc(int $iddoc): static
    {
        $this->iddoc = $iddoc;

        return $this;
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function setOperation(string $operation): static
    {
        $this->operation = $operation;

        return $this;
    }


}
