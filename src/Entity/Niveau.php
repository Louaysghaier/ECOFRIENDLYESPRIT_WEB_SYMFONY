<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Niveau
 *
 * @ORM\Table(name="niveau")
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
 */
class Niveau
{
    /**
     * @var int
     *
     * @ORM\Column(name="idNiveau", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idniveau;

    /**
     * @var string
     *
     * @ORM\Column(name="niveauName", type="string", length=255, nullable=false)
     */
    private $niveauname;

    public function getIdniveau(): ?int
    {
        return $this->idniveau;
    }

    public function getNiveauname(): ?string
    {
        return $this->niveauname;
    }

    public function setNiveauname(string $niveauname): static
    {
        $this->niveauname = $niveauname;

        return $this;
    }


}
