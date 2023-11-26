<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idComment = null;

    #[ORM\Column]
    private ?int $idPost = null;

    #[ORM\Column]
    private ?int $idUser = null;

    #[ORM\Column(length: 800)]
    #[Assert\NotBlank(message: 'La description ne peut pas être vide.')]
    private ?string $descriptionComment = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateCreationComment = null;

    #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: "comments")]
    #[ORM\JoinColumn(nullable: true)]
    private ?Post $post;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdComment(): ?int
    {
        return $this->idComment;
    }

    public function setIdComment(int $idComment): static
    {
        $this->idComment = $idComment;

        return $this;
    }

    public function getIdPost(): ?int
    {
        return $this->idPost;
    }

    public function setIdPost(int $idPost): static
    {
        $this->idPost = $idPost;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getDescriptionComment(): ?string
    {
        return $this->descriptionComment;
    }

    public function setDescriptionComment(string $descriptionComment): static
    {
        $this->descriptionComment = $descriptionComment;

        return $this;
    }

    public function getDateCreationComment(): ?\DateTimeInterface
    {
        return $this->DateCreationComment;
    }

    public function setDateCreationComment(\DateTimeInterface $DateCreationComment): static
    {
        $this->DateCreationComment = $DateCreationComment;

        return $this;
    }
    public function prePersist()
    {
        $this->DateCreationComment = new \DateTime();
       
    }
    

  

}