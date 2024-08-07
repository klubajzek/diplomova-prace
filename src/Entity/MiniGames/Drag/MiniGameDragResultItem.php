<?php

namespace App\Entity\MiniGames\Drag;

use App\Repository\MiniGames\Drag\MiniGameDragResultItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MiniGameDragResultItemRepository::class)]
class MiniGameDragResultItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'miniGameDragResultItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MiniGameDragItem $dragItem = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mistakeFirstPart = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mistakeBetweenPart = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mistakeSecondPart = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mistakeAnswer = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isFilled = null;

    #[ORM\ManyToOne(inversedBy: 'miniGameDragResultItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MiniGameDragResult $result = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDragItem(): ?MiniGameDragItem
    {
        return $this->dragItem;
    }

    public function setDragItem(?MiniGameDragItem $dragItem): static
    {
        $this->dragItem = $dragItem;

        return $this;
    }

    public function getMistakeFirstPart(): ?string
    {
        return $this->mistakeFirstPart;
    }

    public function setMistakeFirstPart(?string $mistakeFirstPart): static
    {
        $this->mistakeFirstPart = $mistakeFirstPart;

        return $this;
    }

    public function getMistakeBetweenPart(): ?string
    {
        return $this->mistakeBetweenPart;
    }

    public function setMistakeBetweenPart(?string $mistakeBetweenPart): static
    {
        $this->mistakeBetweenPart = $mistakeBetweenPart;

        return $this;
    }

    public function getMistakeSecondPart(): ?string
    {
        return $this->mistakeSecondPart;
    }

    public function setMistakeSecondPart(?string $mistakeSecondPart): static
    {
        $this->mistakeSecondPart = $mistakeSecondPart;

        return $this;
    }

    public function getMistakeAnswer(): ?string
    {
        return $this->mistakeAnswer;
    }

    public function setMistakeAnswer(?string $mistakeAnswer): static
    {
        $this->mistakeAnswer = $mistakeAnswer;

        return $this;
    }

    public function isIsFilled(): ?bool
    {
        return $this->isFilled;
    }

    public function setIsFilled(?bool $isFilled): static
    {
        $this->isFilled = $isFilled;

        return $this;
    }

    public function getResult(): ?MiniGameDragResult
    {
        return $this->result;
    }

    public function setResult(?MiniGameDragResult $result): static
    {
        $this->result = $result;

        return $this;
    }
}
