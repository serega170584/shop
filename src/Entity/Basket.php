<?php

namespace App\Entity;

use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BasketRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Basket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $sessionId;

    /**
     * @ORM\OneToMany(targetEntity=BasketItem::class, mappedBy="basket")
     */
    private $basketItems;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->basketItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
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
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
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

    /**
     * @return Collection|BasketItem[]
     */
    public function getBasketItems(): Collection
    {
        return $this->basketItems;
    }

    /**
     * @return int|string
     */
    public function getTotal()
    {
        $total = 0;
        /**
         * @var BasketItem $item
         */
        foreach ($this->basketItems as $item) {
            $total += $item->getProduct()->getPrice();
        }
        return $total;
    }

    public function addBasketItem(BasketItem $basketItem): self
    {
        if (!$this->basketItems->contains($basketItem)) {
            $this->basketItems[] = $basketItem;
            $basketItem->setBasket($this);
        }

        return $this;
    }

    public function removeBasketItem(BasketItem $basketItem): self
    {
        if ($this->basketItems->removeElement($basketItem)) {
            // set the owning side to null (unless already changed)
            if ($basketItem->getBasket() === $this) {
                $basketItem->setBasket(null);
            }
        }

        return $this;
    }

    /**
     * @return ArrayCollection<Product>
     */
    public function getBasketProducts(): ArrayCollection
    {
        return $this->basketItems->map(function (BasketItem $basketItem) {
            return $basketItem->getProduct();
        }) ?? (new ArrayCollection());
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}
