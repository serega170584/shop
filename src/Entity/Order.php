<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sessionId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=SessionOrderItem::class, mappedBy="productOrder")
     */
    private $sessionOrderItems;

    /**
     * @ORM\ManyToMany(targetEntity=OrderStatus::class, mappedBy="productOrder")
     */
    private $orderStatuses;

    public function __construct()
    {
        $this->sessionOrderItems = new ArrayCollection();
        $this->orderStatuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    public function setSessionId(string $sessionId): self
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|SessionOrderItem[]
     */
    public function getSessionOrderItems(): Collection
    {
        return $this->sessionOrderItems;
    }

    public function addSessionOrderItem(SessionOrderItem $sessionOrderItem): self
    {
        if (!$this->sessionOrderItems->contains($sessionOrderItem)) {
            $this->sessionOrderItems[] = $sessionOrderItem;
            $sessionOrderItem->setProductOrder($this);
        }

        return $this;
    }

    public function removeSessionOrderItem(SessionOrderItem $sessionOrderItem): self
    {
        if ($this->sessionOrderItems->removeElement($sessionOrderItem)) {
            // set the owning side to null (unless already changed)
            if ($sessionOrderItem->getProductOrder() === $this) {
                $sessionOrderItem->setProductOrder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OrderStatus[]
     */
    public function getOrderStatuses(): Collection
    {
        return $this->orderStatuses;
    }

    public function addOrderStatus(OrderStatus $orderStatus): self
    {
        if (!$this->orderStatuses->contains($orderStatus)) {
            $this->orderStatuses[] = $orderStatus;
            $orderStatus->addProductOrder($this);
        }

        return $this;
    }

    public function removeOrderStatus(OrderStatus $orderStatus): self
    {
        if ($this->orderStatuses->removeElement($orderStatus)) {
            $orderStatus->removeProductOrder($this);
        }

        return $this;
    }
}
