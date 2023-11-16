<?php

namespace App\Entity;

use App\Repository\RateddocRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rateddoc
 *
 * @ORM\Table(name="rateddoc")
 * @ORM\Entity(repositoryClass=RateddocRepository::class)
 */
class Rateddoc
{
    /**
     * @var int
     *
     * @ORM\Column(name="idrateddoc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrateddoc;

    /**
     * @var int
     *
     * @ORM\Column(name="userId", type="integer", nullable=false)
     */
    private $userid;

    /**
     * @var int
     *
     * @ORM\Column(name="rating", type="integer", nullable=false)
     */
    private $rating;

    /**
     * @var int
     *
     * @ORM\Column(name="rateddoc", type="integer", nullable=false)
     */
    private $rateddoc;

    public function getIdrateddoc(): ?int
    {
        return $this->idrateddoc;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): static
    {
        $this->userid = $userid;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getRateddoc(): ?int
    {
        return $this->rateddoc;
    }

    public function setRateddoc(int $rateddoc): static
    {
        $this->rateddoc = $rateddoc;

        return $this;
    }


}
