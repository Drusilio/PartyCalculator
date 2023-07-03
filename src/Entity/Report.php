<?php

namespace App\Entity;

use App\Repository\ReportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ReportRepository::class)]
class Report
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $uuid;

    #[ORM\OneToOne(inversedBy: 'eventReport', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $event = null;

    #[ORM\OneToMany(mappedBy: 'defaultReport', targetEntity: Transaction::class)]
    private Collection $defaultTransactions;

    #[ORM\OneToMany(mappedBy: 'optimalReport', targetEntity: Transaction::class)]
    private Collection $optimalTransactions;

    public function __construct()
    {
        $this->defaultTransactions = new ArrayCollection();
        $this->optimalTransactions = new ArrayCollection();
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

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getDefaultTransactions(): Collection
    {
        return $this->defaultTransactions;
    }

    public function addDefaultTransaction(Transaction $defaultTransaction): self
    {
        if (!$this->defaultTransactions->contains($defaultTransaction)) {
            $this->defaultTransactions->add($defaultTransaction);
            $defaultTransaction->setDefaultReport($this);
        }

        return $this;
    }

    public function setDefaultTransactions(array $defaultTransactions)
    {
        $this->defaultTransactions = new ArrayCollection($defaultTransactions);
    }

    public function removeDefaultTransaction(Transaction $defaultTransaction): self
    {
        if ($this->defaultTransactions->removeElement($defaultTransaction)) {
            // set the owning side to null (unless already changed)
            if ($defaultTransaction->getDefaultReport() === $this) {
                $defaultTransaction->setDefaultReport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getOptimalTransactions(): Collection
    {
        return $this->optimalTransactions;
    }

    public function addOptimalTransaction(Transaction $optimalTransaction): self
    {
        if (!$this->optimalTransactions->contains($optimalTransaction)) {
            $this->optimalTransactions->add($optimalTransaction);
            $optimalTransaction->setOptimalReport($this);
        }

        return $this;
    }

    public function removeOptimalTransaction(Transaction $optimalTransaction): self
    {
        if ($this->optimalTransactions->removeElement($optimalTransaction)) {
            // set the owning side to null (unless already changed)
            if ($optimalTransaction->getOptimalReport() === $this) {
                $optimalTransaction->setOptimalReport(null);
            }
        }

        return $this;
    }
}
