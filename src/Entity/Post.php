<?php

namespace App\Entity;

use App\Entity\Comment;
use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    private ?int $idPost = null;

    #[ORM\Column]
    private ?int $idUser = null;

    #[ORM\Column(length: 255)]
    private ?string $Subject = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le titre ne peut pas être vide.')]
    private ?string $Title = null;

    #[ORM\Column(length: 800)]
    #[Assert\NotBlank(message: 'La description ne peut pas être vide.')]
    private ?string $descriptionPost = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ImagePost = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCreationPost = null;

    #[ORM\Column]
    private ?int $nbresComments = 0;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;
    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getIdPost(): ?int
    {
        return $this->idPost;
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

    public function getSubject(): ?string
    {
        return $this->Subject;
    }

    public function setSubject(string $Subject): static
    {
        $this->Subject = $Subject;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescriptionPost(): ?string
    {
        return $this->descriptionPost;
    }

    public function setDescriptionPost(string $descriptionPost): static
    {
        $this->descriptionPost = $descriptionPost;

        return $this;
    }

    public function getImagePost(): ?string
    {
        return $this->ImagePost;
    }

    public function setImagePost(?string $ImagePost): static
    {
        $this->ImagePost = $ImagePost;

        return $this;
    }

    public function getDateCreationPost(): ?\DateTimeInterface
    {
        return $this->dateCreationPost;
    }

    public function setDateCreationPost(\DateTimeInterface $dateCreationPost): static
    {
        $this->dateCreationPost = $dateCreationPost;

        return $this;
    }

    public function getNbresComments(): ?int
    {
        return $this->nbresComments;
    }

    public function setNbresComments(int $nbresComments): static
    {
        $this->nbresComments = $nbresComments;

        return $this;
    }

    public function prePersist()
    {
        $this->dateCreationPost = new \DateTime();
       
    }


    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPost($this);
            $this->nbresComments++; // Incrémentation du nombre de commentaires
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
            $this->nbresComments--; // Décrémentation du nombre de commentaires
        }

        return $this;
    }
    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

}