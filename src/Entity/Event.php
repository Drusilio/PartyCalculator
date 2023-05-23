<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $isCompleted = null;

    #[ORM\ManyToOne]
    private ?Expenditure $expenditureList = null;

    #[ORM\OneToOne(mappedBy: 'event', cascade: ['persist', 'remove'])]
    private ?Report $eventReport = null;

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

    public function getIsCompleted(): ?bool
    {
        return $this->isCompleted;
    }

    public function setIsCompleted(?bool $isCompleted): void
    {
        $this->isCompleted = $isCompleted;
    }

    public function getExpenditureList(): ?Expenditure
    {
        return $this->expenditureList;
    }

    public function setExpenditureList(?Expenditure $expenditureList): self
    {
        $this->expenditureList = $expenditureList;

        return $this;
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
}
