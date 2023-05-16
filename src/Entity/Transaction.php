<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $debtorName = null;

    #[ORM\Column(length: 255)]
    private ?string $recipientName = null;

    #[ORM\Column]
    private ?bool $isSent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipientName(): ?string
    {
        return $this->recipientName;
    }

    public function setRecipientName(string $recipientName): self
    {
        $this->recipientName = $recipientName;

        return $this;
    }

    public function getDebtorName(): ?string
    {
        return $this->debtorName;
    }

    public function setDebtorName(?string $debtorName): void
    {
        $this->debtorName = $debtorName;
    }

    public function getIsSent(): ?bool
    {
        return $this->isSent;
    }

    public function setIsSent(?bool $isSent): void
    {
        $this->isSent = $isSent;
    }
}
