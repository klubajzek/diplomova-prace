<?php

namespace App\Entity\MiniGames\Drag;

use App\Entity\Game\GameProfile;
use App\Repository\MiniGames\Drag\MiniGameDragResultRepository;
use App\Traits\MiniGame\MiniGameResultTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MiniGameDragResultRepository::class)]
class MiniGameDragResult
{
    use MiniGameResultTrait;

    #[ORM\Column(length: 255)]
    private ?string $resource = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $correctAnswers = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $notFilled = null;

    #[ORM\OneToMany(mappedBy: 'result', targetEntity: MiniGameDragResultItem::class)]
    private Collection $miniGameDragResultItems;

    #[ORM\OneToMany(mappedBy: 'result', targetEntity: MiniGameDragResultItemMistake::class)]
    private Collection $miniGameDragResultItemMistakes;

    #[ORM\OneToMany(mappedBy: 'result', targetEntity: MiniGameDragResultItemCorrect::class)]
    private Collection $miniGameDragResultItemCorrects;

    #[ORM\ManyToOne(inversedBy: 'miniGameDragResults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GameProfile $gameProfile = null;

    public function __construct()
    {
        $this->miniGameDragResultItems = new ArrayCollection();
        $this->miniGameDragResultItemMistakes = new ArrayCollection();
        $this->miniGameDragResultItemCorrects = new ArrayCollection();
    }

    public function getResource(): ?string
    {
        return $this->resource;
    }

    public function setResource(string $resource): static
    {
        $this->resource = $resource;

        return $this;
    }

    public function getCorrectAnswers(): ?string
    {
        return $this->correctAnswers;
    }

    public function setCorrectAnswers(?string $correctAnswers): static
    {
        $this->correctAnswers = $correctAnswers;

        return $this;
    }

    public function getNotFilled(): ?string
    {
        return $this->notFilled;
    }

    public function setNotFilled(?string $notFilled): static
    {
        $this->notFilled = $notFilled;

        return $this;
    }

    /**
     * @return Collection<int, MiniGameDragResultItem>
     */
    public function getMiniGameDragResultItems(): Collection
    {
        return $this->miniGameDragResultItems;
    }

    public function addMiniGameDragResultItem(MiniGameDragResultItem $miniGameDragResultItem): static
    {
        if (!$this->miniGameDragResultItems->contains($miniGameDragResultItem)) {
            $this->miniGameDragResultItems->add($miniGameDragResultItem);
            $miniGameDragResultItem->setResult($this);
        }

        return $this;
    }

    public function removeMiniGameDragResultItem(MiniGameDragResultItem $miniGameDragResultItem): static
    {
        if ($this->miniGameDragResultItems->removeElement($miniGameDragResultItem)) {
            // set the owning side to null (unless already changed)
            if ($miniGameDragResultItem->getResult() === $this) {
                $miniGameDragResultItem->setResult(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MiniGameDragResultItemMistake>
     */
    public function getMiniGameDragResultItemMistakes(): Collection
    {
        return $this->miniGameDragResultItemMistakes;
    }

    public function addMiniGameDragResultItemMistake(MiniGameDragResultItemMistake $miniGameDragResultItemMistake): static
    {
        if (!$this->miniGameDragResultItemMistakes->contains($miniGameDragResultItemMistake)) {
            $this->miniGameDragResultItemMistakes->add($miniGameDragResultItemMistake);
            $miniGameDragResultItemMistake->setResult($this);
        }

        return $this;
    }

    public function removeMiniGameDragResultItemMistake(MiniGameDragResultItemMistake $miniGameDragResultItemMistake): static
    {
        if ($this->miniGameDragResultItemMistakes->removeElement($miniGameDragResultItemMistake)) {
            // set the owning side to null (unless already changed)
            if ($miniGameDragResultItemMistake->getResult() === $this) {
                $miniGameDragResultItemMistake->setResult(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MiniGameDragResultItemCorrect>
     */
    public function getMiniGameDragResultItemCorrects(): Collection
    {
        return $this->miniGameDragResultItemCorrects;
    }

    public function addMiniGameDragResultItemCorrect(MiniGameDragResultItemCorrect $miniGameDragResultItemCorrect): static
    {
        if (!$this->miniGameDragResultItemCorrects->contains($miniGameDragResultItemCorrect)) {
            $this->miniGameDragResultItemCorrects->add($miniGameDragResultItemCorrect);
            $miniGameDragResultItemCorrect->setResult($this);
        }

        return $this;
    }

    public function removeMiniGameDragResultItemCorrect(MiniGameDragResultItemCorrect $miniGameDragResultItemCorrect): static
    {
        if ($this->miniGameDragResultItemCorrects->removeElement($miniGameDragResultItemCorrect)) {
            // set the owning side to null (unless already changed)
            if ($miniGameDragResultItemCorrect->getResult() === $this) {
                $miniGameDragResultItemCorrect->setResult(null);
            }
        }

        return $this;
    }

    public function getGameProfile(): ?GameProfile
    {
        return $this->gameProfile;
    }

    public function setGameProfile(?GameProfile $gameProfile): static
    {
        $this->gameProfile = $gameProfile;

        return $this;
    }
}
