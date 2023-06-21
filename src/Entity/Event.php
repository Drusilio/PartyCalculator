<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $uuid;

    #[ORM\Column]
    private bool $isCompleted;

    #[ORM\OneToOne(mappedBy: 'event', cascade: ['persist', 'remove'])]
    private ?Report $eventReport = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Expenditure::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $expenditureList;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'events')]
    private Collection $users;

    public function __construct()
    {
        $this->expenditureList = new ArrayCollection();
        $this->uuid = Uuid::v6();
        $this->users = new ArrayCollection();
        $this->isCompleted = false;
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

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getIsCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function setIsCompleted(bool $isCompleted): void
    {
        $this->isCompleted = $isCompleted;
    }

    public function getEventReport(): ?Report
    {
        return $this->eventReport;
    }

    public function setEventReport(Report $eventReport): self
    {
        // set the owning side of the relation if necessary
        if ($eventReport->getEvent() !== $this) {
            $eventReport->setEvent($this);
        }

        $this->eventReport = $eventReport;

        return $this;
    }

    /**
     * @return Collection<int, Expenditure>
     */
    public function getExpenditureList(): Collection
    {
        return $this->expenditureList;
    }

    public function addExpenditureList(Expenditure $expenditureList): self
    {
        if (!$this->expenditureList->contains($expenditureList)) {
            $this->expenditureList->add($expenditureList);
            $expenditureList->setEvent($this);
        }

        return $this;
    }

    public function removeExpenditureList(Expenditure $expenditureList): self
    {
        if ($this->expenditureList->removeElement($expenditureList)) {
            // set the owning side to null (unless already changed)
            if ($expenditureList->getEvent() === $this) {
                $expenditureList->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addEvent($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeEvent($this);
        }

        return $this;
    }

    public function isUserSubscribed(User $user):bool{
        foreach ($this->getUsers() as $value) {
            if ($value->getUuid() == $user->getUuid()) {
                return true;
            }
        }

        return false;
    }
}
