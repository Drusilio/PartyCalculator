<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $uuid;

    #[ORM\Column]
    private ?bool $isSent = null;

    #[ORM\ManyToOne(inversedBy: 'userDebts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $debtor = null;

    #[ORM\ManyToOne(inversedBy: 'requestedTransactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $recipient = null;

    #[ORM\ManyToOne(inversedBy: 'defaultTransactions')]
    private ?Report $defaultReport = null;

    #[ORM\ManyToOne(inversedBy: 'optimalTransactions')]
    private ?Report $optimalReport = null;

    #[ORM\Column]
    private float $amountSpent;

    public function __construct()
    {
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

    public function getAmountSpent(): float
    {
        return $this->amountSpent;
    }

    public function setAmountSpent(float $amountSpent): self
    {
        $this->amountSpent = $amountSpent;

        return $this;
    }

    public function getIsSent(): ?bool
    {
        return $this->isSent;
    }

    public function setIsSent(?bool $isSent): void
    {
        $this->isSent = $isSent;
    }

    public function getDebtor(): ?User
    {
        return $this->debtor;
    }

    public function setDebtor(?User $debtor): self
    {
        $this->debtor = $debtor;

        return $this;
    }

    public function getRecipient(): ?User
    {
        return $this->recipient;
    }

    public function setRecipient(?User $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function getDefaultReport(): ?Report
    {
        return $this->defaultReport;
    }

    public function setDefaultReport(?Report $defaultReport): self
    {
        $this->defaultReport = $defaultReport;

        return $this;
    }

    public function getOptimalReport(): ?Report
    {
        return $this->optimalReport;
    }

    public function setOptimalReport(?Report $optimalReport): self
    {
        $this->optimalReport = $optimalReport;

        return $this;
    }
}
