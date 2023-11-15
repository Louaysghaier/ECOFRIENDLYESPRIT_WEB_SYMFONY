<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    

    #[ORM\Column]
    private ?int $idPost = null;

    #[ORM\Column]
    private ?int $idUser = null;

    #[ORM\Column(length: 255)]
    private ?string $Subject = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(length: 800)]
    private ?string $descriptionPost = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ImagePost = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCreationPost = null;

    #[ORM\Column]
    private ?int $nbresComments = null;

    /*#[ORM\OneToMany(mappedBy: 'post', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;
    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }*/

    public function getId(): ?int
    {
        return $this->id;
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
    private $commentCount = 0;

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPost($this);
            $this->nbresComments++;
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
            $this->nbresComments--;
        }
    
        return $this;
    }
}
