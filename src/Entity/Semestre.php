<?php

namespace App\Entity;

use App\Repository\SemestreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Semestre
 *
 * @ORM\Table(name="semestre")
 * @ORM\Entity(repositoryClass=SemestreRepository::class)
 */
class Semestre
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSemestre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsemestre;

    /**
     * @var string
     *
     * @ORM\Column(name="semestrename", type="string", length=255, nullable=false)
     */
    private $semestrename;

    public function getIdsemestre(): ?int
    {
        return $this->idsemestre;
    }

    public function getSemestrename(): ?string
    {
        return $this->semestrename;
    }

    public function setSemestrename(string $semestrename): static
    {
        $this->semestrename = $semestrename;

        return $this;
    }


}
