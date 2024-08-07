<?php

namespace App\Entity\MiniGames\Drag;

use App\Repository\MiniGames\Drag\MiniGameDragItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MiniGameDragItemRepository::class)]
class MiniGameDragItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstPart = null;

    #[ORM\Column(length: 255)]
    private ?string $secondPart = null;

    #[ORM\Column(length: 255)]
    private ?string $partBetween = null;

    #[ORM\Column(length: 255)]
    private ?string $answer = null;

    #[ORM\OneToMany(mappedBy: 'dragItem', targetEntity: MiniGameDragResultItem::class)]
    private Collection $miniGameDragResultItems;

    public function __construct()
    {
        $this->miniGameDragResultItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstPart(): ?string
    {
        return $this->firstPart;
    }

    public function setFirstPart(string $firstPart): static
    {
        $this->firstPart = $firstPart;

        return $this;
    }

    public function getSecondPart(): ?string
    {
        return $this->secondPart;
    }

    public function setSecondPart(string $secondPart): static
    {
        $this->secondPart = $secondPart;

        return $this;
    }

    public function getPartBetween(): ?string
    {
        return $this->partBetween;
    }

    public function setPartBetween(string $partBetween): static
    {
        $this->partBetween = $partBetween;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): static
    {
        $this->answer = $answer;

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
            $miniGameDragResultItem->setDragItem($this);
        }

        return $this;
    }

    public function removeMiniGameDragResultItem(MiniGameDragResultItem $miniGameDragResultItem): static
    {
        if ($this->miniGameDragResultItems->removeElement($miniGameDragResultItem)) {
            // set the owning side to null (unless already changed)
            if ($miniGameDragResultItem->getDragItem() === $this) {
                $miniGameDragResultItem->setDragItem(null);
            }
        }

        return $this;
    }
}
