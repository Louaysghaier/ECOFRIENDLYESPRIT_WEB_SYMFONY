<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
{
    /**
     * @var int
     *
     * @ORM\Column(name="serviceId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $serviceid;

    /**
     * @var string
     *
     * @ORM\Column(name="serviceName", type="string", length=100, nullable=false)
     */
    private $servicename;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=200, nullable=false)
     */
    private $img;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Orders", mappedBy="serviceid")
     */
    private $orderid = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderid = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getServiceid(): ?int
    {
        return $this->serviceid;
    }

    public function getServicename(): ?string
    {
        return $this->servicename;
    }

    public function setServicename(string $servicename): static
    {
        $this->servicename = $servicename;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getOrderid(): Collection
    {
        return $this->orderid;
    }

    public function addOrderid(Orders $orderid): static
    {
        if (!$this->orderid->contains($orderid)) {
            $this->orderid->add($orderid);
            $orderid->addServiceid($this);
        }

        return $this;
    }

    public function removeOrderid(Orders $orderid): static
    {
        if ($this->orderid->removeElement($orderid)) {
            $orderid->removeServiceid($this);
        }

        return $this;
    }

}
