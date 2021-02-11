<?php

namespace App\Entity;

use App\Repository\UserWalletRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserWalletRepository::class)
 */
class UserWallet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="wallet", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="float")
     */
    private $blocked;

    /**
     * UserWallet constructor.
     * @param $amount
     * @param $blocked
     */
    public function __construct($amount = 0, $blocked = 0)
    {
        $this->amount = $amount;
        $this->blocked = $blocked;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getBlocked(): ?float
    {
        return $this->blocked;
    }

    public function setBlocked(float $blocked): self
    {
        $this->blocked = $blocked;

        return $this;
    }
}
