<?php

namespace App\Entity;

use App\Repository\User2Repository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * User2
 *
 * @ORM\Table(name="user2")
 * @ORM\Entity(repositoryClass=User2Repository::class)
 */
class User2
{
    /**
     * @var int
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="nomuser", type="string", length=100, nullable=false)
     */
    private $nomuser;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomuser", type="string", length=100, nullable=false)
     */
    private $prenomuser;

    /**
     * @var string
     *
     * @ORM\Column(name="mailuser", type="string", length=200, nullable=false)
     */
    private $mailuser;

    /**
     * @var string
     *
     * @ORM\Column(name="mdpuser", type="string", length=300, nullable=false)
     */
    private $mdpuser;

    /**
     * @var string
     *
     * @ORM\Column(name="adressuser", type="string", length=200, nullable=false)
     */
    private $adressuser;

    /**
     * @var float
     *
     * @ORM\Column(name="walletuser", type="float", precision=10, scale=0, nullable=false, options={"default"="250"})
     */
    private $walletuser ;

    /**
     * @var string
     *
     * @ORM\Column(name="classeuser", type="string", length=200, nullable=false)
     */
    private $classeuser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="roleuser", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $roleuser = 'NULL';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isBlocked", type="boolean", nullable=true)
     */
    private $isblocked = '0';


/**
     * @ORM\ManyToMany(targetEntity=Event::class)
     * @ORM\JoinTable(name="panier",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="iduser")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="event_id", referencedColumnName="idEvent")}
     * )
     */
    private $panier;

/**
 * @var string|null
 *
 * @ORM\Column(name="phoneNumber", type="string", length=20, nullable=true)
 */
private $phoneNumber;

    public function getIduser(): ?int
    {
        return $this->iduser;
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

    public function getMailuser(): ?string
    {
        return $this->mailuser;
    }

    public function setMailuser(string $mailuser): static
    {
        $this->mailuser = $mailuser;

        return $this;
    }

    public function getMdpuser(): ?string
    {
        return $this->mdpuser;
    }

    public function setMdpuser(string $mdpuser): static
    {
        $this->mdpuser = $mdpuser;

        return $this;
    }

    public function getAdressuser(): ?string
    {
        return $this->adressuser;
    }

    public function setAdressuser(string $adressuser): static
    {
        $this->adressuser = $adressuser;

        return $this;
    }

    public function getWalletuser(): ?float
{
    return $this->walletuser;
}


    public function setWalletuser(float $walletuser)
    {
        $this->walletuser = $walletuser;

        return $this;
    }

    public function getClasseuser(): ?string
    {
        return $this->classeuser;
    }

    public function setClasseuser(string $classeuser): static
    {
        $this->classeuser = $classeuser;

        return $this;
    }

    public function getRoleuser(): ?string
    {
        return $this->roleuser;
    }

    public function setRoleuser(?string $roleuser): static
    {
        $this->roleuser = $roleuser;

        return $this;
    }

    public function isIsblocked(): ?bool
    {
        return $this->isblocked;
    }

    public function setIsblocked(?bool $isblocked): static
    {
        $this->isblocked = $isblocked;

        return $this;
    }



    public function __construct()
    {
        $this->panier = new ArrayCollection();
    }

    /**
     * @return Collection|Event[]
     */
    public function getPanier(): Collection
    {
        return $this->panier;
    }

    public function addPanier(Event $event): self
    {
        if (!$this->panier->contains($event)) {
            $this->panier[] = $event;
        }

        return $this;
    }

    public function removePanier(Event $event): self
    {
        $this->panier->removeElement($event);

        return $this;
    }




    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }
    
    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
    
        return $this;
    }
    











}
