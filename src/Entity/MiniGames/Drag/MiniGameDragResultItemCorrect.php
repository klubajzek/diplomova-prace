<?php

namespace App\Entity\MiniGames\Drag;

use App\Repository\MiniGames\Drag\MiniGameDragResultItemCorrectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MiniGameDragResultItemCorrectRepository::class)]
class MiniGameDragResultItemCorrect
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'miniGameDragResultItemCorrects')]
    private ?MiniGameDragResult $result = null;

    #[ORM\Column(length: 255)]
    private ?string $firstPart = null;

    #[ORM\Column(length: 255)]
    private ?string $betweenPart = null;

    #[ORM\Column(length: 255)]
    private ?string $secondPart = null;

    #[ORM\Column(length: 255)]
    private ?string $answer = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFirstPart(): ?string
    {
        return $this->firstPart;
    }

    public function setFirstPart(string $firstPart): static
    {
        $this->firstPart = $firstPart;

        return $this;
    }

    public function getBetweenPart(): ?string
    {
        return $this->betweenPart;
    }

    public function setBetweenPart(string $betweenPart): static
    {
        $this->betweenPart = $betweenPart;

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

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): static
    {
        $this->answer = $answer;

        return $this;
    }
}
