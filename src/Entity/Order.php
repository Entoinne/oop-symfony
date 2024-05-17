<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $UpdatedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $customer = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?float $total = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $paidAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shippingAddress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shippingMethod = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $invoiceAddress = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $shippingMethodSetAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $invoiceAddressSetAt = null;

    /**
     * @var Collection<int, OrderItem>
     */
    #[ORM\OneToMany(targetEntity: OrderItem::class, mappedBy: 'relatedOrder', cascade: ['persist'])]
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTime $UpdatedAt): static
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(string $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getPaidAt(): ?\DateTime
    {
        return $this->paidAt;
    }

    public function setPaidAt(?\DateTime $paidAt): static
    {
        $this->paidAt = $paidAt;

        return $this;
    }

    public function getShippingAddress(): ?string
    {
        return $this->shippingAddress;
    }

    public function setShippingAddress(?string $shippingAddress): static
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    public function getShippingMethod(): ?string
    {
        return $this->shippingMethod;
    }

    public function setShippingMethod(?string $shippingMethod): static
    {
        $this->shippingMethod = $shippingMethod;

        return $this;
    }

    public function getInvoiceAddress(): ?string
    {
        return $this->invoiceAddress;
    }

    public function setInvoiceAddress(?string $invoiceAddress): static
    {
        $this->invoiceAddress = $invoiceAddress;

        return $this;
    }

    public function getShippingMethodSetAt(): ?\DateTime
    {
        return $this->shippingMethodSetAt;
    }

    public function setShippingMethodSetAt(?\DateTime $shippingMethodSetAt): static
    {
        $this->shippingMethodSetAt = $shippingMethodSetAt;

        return $this;
    }

    public function getInvoiceAddressSetAt(): ?\DateTime
    {
        return $this->invoiceAddressSetAt;
    }

    public function setInvoiceAddressSetAt(?\DateTime $invoiceAddressSetAt): static
    {
        $this->invoiceAddressSetAt = $invoiceAddressSetAt;

        return $this;
    }

    /**
     * @return Collection<int, OrderItem>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(OrderItem $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setRelatedOrder($this);
        }

        return $this;
    }

    public function removeItem(OrderItem $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getRelatedOrder() === $this) {
                $item->setRelatedOrder(null);
            }
        }

        return $this;
    }
}
