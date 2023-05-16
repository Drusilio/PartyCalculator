<?php

namespace App\Entity;

use App\Repository\ExpenditureRepository;
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
}
