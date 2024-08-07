<?php

namespace App\Entity\MiniGames\Match;

use App\Repository\MiniGames\Match\MiniGameMatchResultItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MiniGameMatchResultItemRepository::class)]
class MiniGameMatchResultItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'miniGameMatchResultItems')]
    private ?MiniGameMatchQuestion $question = null;

    #[ORM\Column(length: 255)]
    private ?string $questionText = null;

    #[ORM\ManyToOne(inversedBy: 'miniGameMatchResultItems')]
    private ?MiniGameMatchAnswer $answer = null;

    #[ORM\Column(length: 255)]
    private ?string $answerText = null;

    #[ORM\ManyToOne(inversedBy: 'miniGameMatchResultItems')]
    private ?MiniGameMatchResult $result = null;

    #[ORM\ManyToOne(inversedBy: 'miniGameMatchResultMistakeItems')]
    private ?MiniGameMatchAnswer $mistakeAnswer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mistakeAnswerText = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isFilled = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?MiniGameMatchQuestion
    {
        return $this->question;
    }

    public function setQuestion(?MiniGameMatchQuestion $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getQuestionText(): ?string
    {
        return $this->questionText;
    }

    public function setQuestionText(string $questionText): static
    {
        $this->questionText = $questionText;

        return $this;
    }

    public function getAnswer(): ?MiniGameMatchAnswer
    {
        return $this->answer;
    }

    public function setAnswer(?MiniGameMatchAnswer $answer): static
    {
        $this->answer = $answer;

        return $this;
    }

    public function getAnswerText(): ?string
    {
        return $this->answerText;
    }

    public function setAnswerText(string $answerText): static
    {
        $this->answerText = $answerText;

        return $this;
    }

    public function getResult(): ?MiniGameMatchResult
    {
        return $this->result;
    }

    public function setResult(?MiniGameMatchResult $result): static
    {
        $this->result = $result;

        return $this;
    }

    public function getMistakeAnswer(): ?MiniGameMatchAnswer
    {
        return $this->mistakeAnswer;
    }

    public function setMistakeAnswer(?MiniGameMatchAnswer $mistakeAnswer): static
    {
        $this->mistakeAnswer = $mistakeAnswer;

        return $this;
    }

    public function getMistakeAnswerText(): ?string
    {
        return $this->mistakeAnswerText;
    }

    public function setMistakeAnswerText(?string $mistakeAnswerText): static
    {
        $this->mistakeAnswerText = $mistakeAnswerText;

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
}
