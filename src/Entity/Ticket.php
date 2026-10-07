<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\DTO\Ticket\TicketListOutput;
use App\Entity\Impl\AbstractEntity;
use App\Repository\TicketRepository;
use App\State\Ticket\TicketCollectionProvider;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/tickets',
            security: "is_granted('ROLE_USER')",
            output: TicketListOutput::class,
            provider: TicketCollectionProvider::class,
        ),
    ])]
#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket extends AbstractEntity
{


    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private ?Uuid $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Trip $trip = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cart $cart = null;

    /**
     * @var int $price Le prix du ticket en centimes.
     */
    #[ORM\Column()]
    private int $price;


    public function __construct()
    {
        $this->id = Uuid::v7();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getTrip(): ?Trip
    {
        return $this->trip;
    }

    public function setTrip(?Trip $trip): static
    {
        $this->trip = $trip;
        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): static
    {
        $this->cart = $cart;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;
        return $this;
    }

}
