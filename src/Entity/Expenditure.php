<?php

namespace App\Entity;

use App\Repository\ExpenditureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ExpenditureRepository::class)]
class Expenditure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $uuid;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column]
    private float $amountSpent;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'expenditureList')]
    private Collection $subscribers;

    #[ORM\ManyToOne(inversedBy: 'expenditureList')]
    #[ORM\JoinColumn(nullable: false)]
    private Event $event;

    #[ORM\ManyToOne(inversedBy: 'expenditures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $expensist = null;

    public function __construct()
    {
        $this->subscribers = new ArrayCollection();
        $this->uuid = Uuid::v6();
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAmountSpent(): ?float
    {
        return $this->amountSpent;
    }

    public function setAmountSpent(float $amountSpent): self
    {
        $this->amountSpent = $amountSpent;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getSubscribers(): Collection
    {
        return $this->subscribers;
    }

    public function addSubscribers(User $subscribeUser): self
    {
        if (!$this->subscribers->contains($subscribeUser)) {
            $this->subscribers->add($subscribeUser);
        }

        return $this;
    }

    public function removeSubscribers(User $subscribeUser): self
    {
        $this->subscribers->removeElement($subscribeUser);

        return $this;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function setEvent(
        Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getExpensist(): ?User
    {
        return $this->expensist;
    }

    public function setExpensist(?User $expensist): self
    {
        $this->expensist = $expensist;

        return $this;
    }
}
