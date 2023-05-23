<?php

namespace App\Entity;

use App\Repository\ExpenditureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpenditureRepository::class)]
class Expenditure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $amountSpent = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'expenditureList')]
    private Collection $subscribeUsers;

    public function __construct()
    {
        $this->subscribeUsers = new ArrayCollection();
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
    public function getSubscribeUsers(): Collection
    {
        return $this->subscribeUsers;
    }

    public function addSubscribeUser(User $subscribeUser): self
    {
        if (!$this->subscribeUsers->contains($subscribeUser)) {
            $this->subscribeUsers->add($subscribeUser);
        }

        return $this;
    }

    public function removeSubscribeUser(User $subscribeUser): self
    {
        $this->subscribeUsers->removeElement($subscribeUser);

        return $this;
    }
}
