<?php

namespace App\Entity;

use App\Repository\DocumentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Documents
 *
 * @ORM\Table(name="documents", indexes={@ORM\Index(name="fk_iduser2", columns={"idNiveau"})})
 * @ORM\Entity(repositoryClass=DocumentsRepository::class)
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
     * @ORM\Column(name="documentName", type="string", length=255, nullable=false)
     */
    private $documentname;

    /**
     * @var string
     *
     * @ORM\Column(name="documentType", type="string", length=255, nullable=false)
     */
    private $documenttype;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="documentDate", type="date", nullable=false, options={"default"="current_timestamp()"})
     */
    private $documentdate = 'current_timestamp()';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="documentCreationDate", type="date", nullable=false, options={"default"="current_timestamp()"})
     */
    private $documentcreationdate = 'current_timestamp()';

    /**
     * @var string
     *
     * @ORM\Column(name="documentImage", type="string", length=255, nullable=false)
     */
    private $documentimage;

    /**
     * @var string
     *
     * @ORM\Column(name="documentUrl", type="string", length=255, nullable=false)
     */
    private $documenturl;

    /**
     * @var int
     *
     * @ORM\Column(name="idTopic", type="integer", nullable=false)
     */
    private $idtopic;

    /**
     * @var int
     *
     * @ORM\Column(name="idSemestre", type="integer", nullable=false)
     */
    private $idsemestre;

    /**
     * @var int
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="isvalid", type="string", length=200, nullable=false, options={"default"="'valid'"})
     */
    private $isvalid = '\'valid\'';

    /**
     * @var \User2
     *
     * @ORM\ManyToOne(targetEntity="User2")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idNiveau", referencedColumnName="iduser")
     * })
     */
    private $idniveau;

    public function getIddoc(): ?int
    {
        return $this->iddoc;
    }

    public function getDocumentname(): ?string
    {
        return $this->documentname;
    }

    public function setDocumentname(string $documentname): static
    {
        $this->documentname = $documentname;

        return $this;
    }

    public function getDocumenttype(): ?string
    {
        return $this->documenttype;
    }

    public function setDocumenttype(string $documenttype): static
    {
        $this->documenttype = $documenttype;

        return $this;
    }

    public function getDocumentdate(): ?\DateTimeInterface
    {
        return $this->documentdate;
    }

    public function setDocumentdate(\DateTimeInterface $documentdate): static
    {
        $this->documentdate = $documentdate;

        return $this;
    }

    public function getDocumentcreationdate(): ?\DateTimeInterface
    {
        return $this->documentcreationdate;
    }

    public function setDocumentcreationdate(\DateTimeInterface $documentcreationdate): static
    {
        $this->documentcreationdate = $documentcreationdate;

        return $this;
    }

    public function getDocumentimage(): ?string
    {
        return $this->documentimage;
    }

    public function setDocumentimage(string $documentimage): static
    {
        $this->documentimage = $documentimage;

        return $this;
    }

    public function getDocumenturl(): ?string
    {
        return $this->documenturl;
    }

    public function setDocumenturl(string $documenturl): static
    {
        $this->documenturl = $documenturl;

        return $this;
    }

    public function getIdtopic(): ?int
    {
        return $this->idtopic;
    }

    public function setIdtopic(int $idtopic): static
    {
        $this->idtopic = $idtopic;

        return $this;
    }

    public function getIdsemestre(): ?int
    {
        return $this->idsemestre;
    }

    public function setIdsemestre(int $idsemestre): static
    {
        $this->idsemestre = $idsemestre;

        return $this;
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

    public function getIsvalid(): ?string
    {
        return $this->isvalid;
    }

    public function setIsvalid(string $isvalid): static
    {
        $this->isvalid = $isvalid;

        return $this;
    }

    public function getIdniveau(): ?User2
    {
        return $this->idniveau;
    }

    public function setIdniveau(?User2 $idniveau): static
    {
        $this->idniveau = $idniveau;

        return $this;
    }


}
