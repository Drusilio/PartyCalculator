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

    #[ORM\Column]
    private ?bool $isSent = null;

    #[ORM\ManyToOne(inversedBy: 'userDebts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $debtor = null;

    #[ORM\ManyToOne(inversedBy: 'requestedTransactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $recipient = null;

    public function getId(): ?int
    {
        return $this->id;
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
}
