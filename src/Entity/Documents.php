<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Documents
 *
 * @ORM\Table(name="documents", indexes={@ORM\Index(name="iduser", columns={"iduser"}), @ORM\Index(name="idtopic", columns={"idtopic"})})
 * @ORM\Entity
 */
class Documents
{
    /**
     * @var int
     *
     * @ORM\Column(name="idDoc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddoc;

    /**
     * @var string
     *
     * @ORM\Column(name="document_name", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Le nom du document ne peut pas être vide.")
     * @Assert\Length(max=255, maxMessage="Le nom du document ne peut pas dépasser {{ limit }} caractères.")
     */
    private $documentName;

    /**
     * @var string
     *
     * @ORM\Column(name="document_type", type="string", length=255, nullable=false)
     */
    private $documentType;

    /**
     * @var string
     *
     * @ORM\Column(name="document", type="string", length=255, nullable=false)
     */
    private $document;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", length=255, nullable=false)
     */
    private $niveau;

    /**
     * @var string
     *
     * @ORM\Column(name="semestre", type="string", length=255, nullable=false)
     */
    private $semestre;

    /**
     * @var \Topic
     *
     * @ORM\ManyToOne(targetEntity="Topic")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idtopic", referencedColumnName="idtopic")
     * })
     */
    private $idtopic;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iduser", referencedColumnName="iduser")
     * })
     */
    private $iduser;

    public function getIddoc(): ?int
    {
        return $this->iddoc;
    }

    public function getDocumentName(): ?string
    {
        return $this->documentName;
    }

    public function setDocumentName(string $documentName): static
    {
        $this->documentName = $documentName;

        return $this;
    }

    public function getDocumentType(): ?string
    {
        return $this->documentType;
    }

    public function setDocumentType(string $documentType): static
    {
        $this->documentType = $documentType;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(string $document): static
    {
        $this->document = $document;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getSemestre(): ?string
    {
        return $this->semestre;
    }

    public function setSemestre(string $semestre): static
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getIdtopic(): ?Topic
    {
        return $this->idtopic;
    }

    public function setIdtopic(?Topic $idtopic): static
    {
        $this->idtopic = $idtopic;

        return $this;
    }

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(?User $iduser): static
    {
        $this->iduser = $iduser;

        return $this;
    }


}
