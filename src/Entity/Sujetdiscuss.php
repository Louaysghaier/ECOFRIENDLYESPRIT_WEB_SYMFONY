<?php

namespace App\Entity;

use App\Repository\SujetdiscussRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sujetdiscuss
 *
 * @ORM\Table(name="sujetdiscuss")
 * @ORM\Entity(repositoryClass=SujetdiscussRepository::class)
 */
class Sujetdiscuss
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSujet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsujet;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrePost", type="integer", nullable=false)
     */
    private $nbrepost;

    /**
     * @var string
     *
     * @ORM\Column(name="typeSujet", type="string", length=100, nullable=false)
     */
    private $typesujet;

    public function getIdsujet(): ?int
    {
        return $this->idsujet;
    }

    public function getNbrepost(): ?int
    {
        return $this->nbrepost;
    }

    public function setNbrepost(int $nbrepost): static
    {
        $this->nbrepost = $nbrepost;

        return $this;
    }

    public function getTypesujet(): ?string
    {
        return $this->typesujet;
    }

    public function setTypesujet(string $typesujet): static
    {
        $this->typesujet = $typesujet;

        return $this;
    }


}
