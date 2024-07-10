<?php

namespace App\Entity\Game;

use App\Entity\MiniGames\Match\MiniGameMatchResult;
use App\Entity\User\User;
use App\Repository\User\GameProfileRepository;
use App\Traits\Entity\Datetimeable;
use App\Traits\Entity\Deactivationable;
use App\Traits\Entity\ID;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameProfileRepository::class)]
class GameProfile
{
    use ID, Datetimeable, Deactivationable;

    #[ORM\Column(nullable: true)]
    private ?int $position = null;

    #[ORM\Column(nullable: true)]
    private ?int $wood = null;

    #[ORM\Column(nullable: true)]
    private ?int $stone = null;

    #[ORM\Column(nullable: true)]
    private ?int $food = null;

    #[ORM\OneToOne(inversedBy: 'gameProfile', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'gameProfiles')]
    private ?Game $game = null;

    #[ORM\OneToMany(mappedBy: 'gameProfile', targetEntity: MiniGameMatchResult::class)]
    private Collection $miniGameMatchResults;

    public function __construct()
    {
        $this->miniGameMatchResults = new ArrayCollection();
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getWood(): ?int
    {
        return $this->wood;
    }

    public function setWood(?int $wood): static
    {
        $this->wood = $wood;

        return $this;
    }

    public function getStone(): ?int
    {
        return $this->stone;
    }

    public function setStone(?int $stone): static
    {
        $this->stone = $stone;

        return $this;
    }

    public function getFood(): ?int
    {
        return $this->food;
    }

    public function setFood(?int $food): static
    {
        $this->food = $food;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return Collection<int, MiniGameMatchResult>
     */
    public function getMiniGameMatchResults(): Collection
    {
        return $this->miniGameMatchResults;
    }

    public function addMiniGameMatchResult(MiniGameMatchResult $miniGameMatchResult): static
    {
        if (!$this->miniGameMatchResults->contains($miniGameMatchResult)) {
            $this->miniGameMatchResults->add($miniGameMatchResult);
            $miniGameMatchResult->setGameProfile($this);
        }

        return $this;
    }

    public function removeMiniGameMatchResult(MiniGameMatchResult $miniGameMatchResult): static
    {
        if ($this->miniGameMatchResults->removeElement($miniGameMatchResult)) {
            // set the owning side to null (unless already changed)
            if ($miniGameMatchResult->getGameProfile() === $this) {
                $miniGameMatchResult->setGameProfile(null);
            }
        }

        return $this;
    }
}
