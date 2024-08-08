<?php

namespace App\Entity\Game;

use App\Entity\MiniGames\Drag\MiniGameDragResult;
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

    #[ORM\OneToMany(mappedBy: 'gameProfile', targetEntity: MiniGameDragResult::class)]
    private Collection $miniGameDragResults;

    #[ORM\OneToMany(mappedBy: 'gameProfile', targetEntity: GameProfileBuilding::class)]
    private Collection $gameProfileBuildings;

    #[ORM\Column(nullable: true)]
    private ?bool $hideMatchHelpModal = null;

    #[ORM\Column(nullable: true)]
    private ?bool $hideDragHelpModal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $totalMistakes = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $totalCorrectAnswers = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $totalFilled = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $totalScore = null;

    public function __construct()
    {
        $this->miniGameMatchResults = new ArrayCollection();
        $this->miniGameDragResults = new ArrayCollection();
        $this->gameProfileBuildings = new ArrayCollection();
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
        return $this->wood != null ? $this->wood : 0;
    }

    public function setWood(?int $wood): static
    {
        $this->wood = $wood;

        return $this;
    }

    public function getStone(): ?int
    {
        return $this->stone != null ? $this->stone : 0;
    }

    public function setStone(?int $stone): static
    {
        $this->stone = $stone;

        return $this;
    }

    public function getFood(): ?int
    {
        return $this->food != null ? $this->food : 0;
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

    /**
     * @return Collection<int, MiniGameDragResult>
     */
    public function getMiniGameDragResults(): Collection
    {
        return $this->miniGameDragResults;
    }

    public function addMiniGameDragResult(MiniGameDragResult $miniGameDragResult): static
    {
        if (!$this->miniGameDragResults->contains($miniGameDragResult)) {
            $this->miniGameDragResults->add($miniGameDragResult);
            $miniGameDragResult->setGameProfile($this);
        }

        return $this;
    }

    public function removeMiniGameDragResult(MiniGameDragResult $miniGameDragResult): static
    {
        if ($this->miniGameDragResults->removeElement($miniGameDragResult)) {
            // set the owning side to null (unless already changed)
            if ($miniGameDragResult->getGameProfile() === $this) {
                $miniGameDragResult->setGameProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GameProfileBuilding>
     */
    public function getGameProfileBuildings(): Collection
    {
        return $this->gameProfileBuildings;
    }

    public function addGameProfileBuilding(GameProfileBuilding $gameProfileBuilding): static
    {
        if (!$this->gameProfileBuildings->contains($gameProfileBuilding)) {
            $this->gameProfileBuildings->add($gameProfileBuilding);
            $gameProfileBuilding->setGameProfile($this);
        }

        return $this;
    }

    public function removeGameProfileBuilding(GameProfileBuilding $gameProfileBuilding): static
    {
        if ($this->gameProfileBuildings->removeElement($gameProfileBuilding)) {
            // set the owning side to null (unless already changed)
            if ($gameProfileBuilding->getGameProfile() === $this) {
                $gameProfileBuilding->setGameProfile(null);
            }
        }

        return $this;
    }

    public function isHideMatchHelpModal(): ?bool
    {
        return $this->hideMatchHelpModal;
    }

    public function setHideMatchHelpModal(?bool $hideMatchHelpModal): static
    {
        $this->hideMatchHelpModal = $hideMatchHelpModal;

        return $this;
    }

    public function isHideDragHelpModal(): ?bool
    {
        return $this->hideDragHelpModal;
    }

    public function setHideDragHelpModal(?bool $hideDragHelpModal): static
    {
        $this->hideDragHelpModal = $hideDragHelpModal;

        return $this;
    }

    public function getTotalMistakes(): ?string
    {
        return $this->totalMistakes;
    }

    public function setTotalMistakes(?string $totalMistakes): static
    {
        $this->totalMistakes = $totalMistakes;

        return $this;
    }

    public function getTotalCorrectAnswers(): ?string
    {
        return $this->totalCorrectAnswers;
    }

    public function setTotalCorrectAnswers(?string $totalCorrectAnswers): static
    {
        $this->totalCorrectAnswers = $totalCorrectAnswers;

        return $this;
    }

    public function getTotalFilled(): ?string
    {
        return $this->totalFilled;
    }

    public function setTotalFilled(?string $totalFilled): static
    {
        $this->totalFilled = $totalFilled;

        return $this;
    }

    public function getTotalScore(): ?string
    {
        return $this->totalScore;
    }

    public function setTotalScore(?string $totalScore): static
    {
        $this->totalScore = $totalScore;

        return $this;
    }
}
