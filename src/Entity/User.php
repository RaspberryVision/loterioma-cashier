<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=UserWallet::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $wallet;

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="user", cascade={"PERSIST"})
     */
    private $transactions;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|DiceRound[]
     */
    public function getDiceRounds(): Collection
    {
        return $this->diceRounds;
    }

    public function addDiceRound(DiceRound $diceRound): self
    {
        if (!$this->diceRounds->contains($diceRound)) {
            $this->diceRounds[] = $diceRound;
            $diceRound->setUser($this);
        }

        return $this;
    }

    public function removeDiceRound(DiceRound $diceRound): self
    {
        if ($this->diceRounds->contains($diceRound)) {
            $this->diceRounds->removeElement($diceRound);
            // set the owning side to null (unless already changed)
            if ($diceRound->getUser() === $this) {
                $diceRound->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GameSession[]
     */
    public function getGameSessions(): Collection
    {
        return $this->gameSessions;
    }

    public function addGameSession(GameSession $gameSession): self
    {
        if (!$this->gameSessions->contains($gameSession)) {
            $this->gameSessions[] = $gameSession;
            $gameSession->setUser($this);
        }

        return $this;
    }

    public function removeGameSession(GameSession $gameSession): self
    {
        if ($this->gameSessions->contains($gameSession)) {
            $this->gameSessions->removeElement($gameSession);
            // set the owning side to null (unless already changed)
            if ($gameSession->getUser() === $this) {
                $gameSession->setUser(null);
            }
        }

        return $this;
    }

    public function getWallet(): ?UserWallet
    {
        return $this->wallet;
    }

    public function setWallet(UserWallet $wallet): self
    {
        $this->wallet = $wallet;

        // set the owning side of the relation if necessary
        if ($wallet->getUser() !== $this) {
            $wallet->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setUser($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->contains($transaction)) {
            $this->transactions->removeElement($transaction);
            // set the owning side to null (unless already changed)
            if ($transaction->getUser() === $this) {
                $transaction->setUser(null);
            }
        }

        return $this;
    }
}
