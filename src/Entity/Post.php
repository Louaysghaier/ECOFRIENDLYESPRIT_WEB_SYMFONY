<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post", indexes={@ORM\Index(name="fk_iduser1", columns={"idUser"}), @ORM\Index(name="fk_sujet", columns={"idSujet"})})
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPost", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpost;

    /**
     * @var int
     *
     * @ORM\Column(name="nbreComment", type="integer", nullable=false)
     */
    private $nbrecomment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreationp", type="date", nullable=false)
     */
    private $datecreationp;

    /**
     * @var string
     *
     * @ORM\Column(name="nomUser", type="string", length=255, nullable=false)
     */
    private $nomuser;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomUser", type="string", length=255, nullable=false)
     */
    private $prenomuser;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    private $subject;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $image = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionp", type="string", length=255, nullable=false)
     */
    private $descriptionp;

    /**
     * @var \User2
     *
     * @ORM\ManyToOne(targetEntity="User2")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="iduser")
     * })
     */
    private $iduser;

    /**
     * @var \Sujetdiscuss
     *
     * @ORM\ManyToOne(targetEntity="Sujetdiscuss")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSujet", referencedColumnName="idSujet")
     * })
     */
    private $idsujet;

    public function getIdpost(): ?int
    {
        return $this->idpost;
    }

    public function getNbrecomment(): ?int
    {
        return $this->nbrecomment;
    }

    public function setNbrecomment(int $nbrecomment): static
    {
        $this->nbrecomment = $nbrecomment;

        return $this;
    }

    public function getDatecreationp(): ?\DateTimeInterface
    {
        return $this->datecreationp;
    }

    public function setDatecreationp(\DateTimeInterface $datecreationp): static
    {
        $this->datecreationp = $datecreationp;

        return $this;
    }

    public function getNomuser(): ?string
    {
        return $this->nomuser;
    }

    public function setNomuser(string $nomuser): static
    {
        $this->nomuser = $nomuser;

        return $this;
    }

    public function getPrenomuser(): ?string
    {
        return $this->prenomuser;
    }

    public function setPrenomuser(string $prenomuser): static
    {
        $this->prenomuser = $prenomuser;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescriptionp(): ?string
    {
        return $this->descriptionp;
    }

    public function setDescriptionp(string $descriptionp): static
    {
        $this->descriptionp = $descriptionp;

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

    public function getIdsujet(): ?Sujetdiscuss
    {
        return $this->idsujet;
    }

    public function setIdsujet(?Sujetdiscuss $idsujet): static
    {
        $this->idsujet = $idsujet;

        return $this;
    }


}
