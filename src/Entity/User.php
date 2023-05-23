<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'debtor', targetEntity: Transaction::class, orphanRemoval: true)]
    private Collection $userDebts;

    #[ORM\OneToMany(mappedBy: 'recipient', targetEntity: Transaction::class, orphanRemoval: true)]
    private Collection $requestedTransactions;

    #[ORM\Column]
    private string $paymentMethods;

    #[ORM\ManyToMany(targetEntity: Expenditure::class, mappedBy: 'subscribeUsers')]
    private Collection $expenditureList;
    public function __construct()
    {
        $this->expenditureList = new ArrayCollection();
        $this->userDebts = new ArrayCollection();
        $this->requestedTransactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUserDebts(): Collection
    {
        return $this->userDebts;
    }

    public function addUserDebt(Transaction $userDebt): self
    {
        if (!$this->userDebts->contains($userDebt)) {
            $this->userDebts->add($userDebt);
            $userDebt->setDebtor($this);
        }

        return $this;
    }

    public function removeUserDebt(Transaction $userDebt): self
    {
        if ($this->userDebts->removeElement($userDebt)) {
            // set the owning side to null (unless already changed)
            if ($userDebt->getDebtor() === $this) {
                $userDebt->setDebtor(null);
            }
        }

        return $this;
    }

    public function getRequestedTransactions(): Collection
    {
        return $this->requestedTransactions;
    }

    public function addRequestedTransaction(Transaction $requestedTransaction): self
    {
        if (!$this->requestedTransactions->contains($requestedTransaction)) {
            $this->requestedTransactions->add($requestedTransaction);
            $requestedTransaction->setRecipient($this);
        }

        return $this;
    }

    public function removeRequestedTransaction(Transaction $requestedTransaction): self
    {
        if ($this->requestedTransactions->removeElement($requestedTransaction)) {
            // set the owning side to null (unless already changed)
            if ($requestedTransaction->getRecipient() === $this) {
                $requestedTransaction->setRecipient(null);
            }
        }

        return $this;
    }

    public function getPaymentMethods(): string
    {
        return $this->paymentMethods;
    }

    public function setPaymentMethods(string $paymentMethods): self
    {
        $this->paymentMethods = $paymentMethods;

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
            $expenditureList->addSubscribeUser($this);
        }

        return $this;
    }

    public function removeExpenditureList(Expenditure $expenditureList): self
    {
        if ($this->expenditureList->removeElement($expenditureList)) {
            $expenditureList->removeSubscribeUser($this);
        }

        return $this;
    }
}