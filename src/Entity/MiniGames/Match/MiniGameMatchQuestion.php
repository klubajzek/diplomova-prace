<?php

namespace App\Entity\MiniGames\Match;

use App\Repository\MiniGame\Match\MiniGameMatchQuestionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MiniGameMatchQuestionRepository::class)]
class MiniGameMatchQuestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $question = null;

    #[ORM\OneToOne(mappedBy: 'question', cascade: ['persist', 'remove'])]
    private ?MiniGameMatchAnswer $miniGameMatchAnswer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(?string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getMiniGameMatchAnswer(): ?MiniGameMatchAnswer
    {
        return $this->miniGameMatchAnswer;
    }

    public function setMiniGameMatchAnswer(?MiniGameMatchAnswer $miniGameMatchAnswer): static
    {
        // unset the owning side of the relation if necessary
        if ($miniGameMatchAnswer === null && $this->miniGameMatchAnswer !== null) {
            $this->miniGameMatchAnswer->setQuestion(null);
        }

        // set the owning side of the relation if necessary
        if ($miniGameMatchAnswer !== null && $miniGameMatchAnswer->getQuestion() !== $this) {
            $miniGameMatchAnswer->setQuestion($this);
        }

        $this->miniGameMatchAnswer = $miniGameMatchAnswer;

        return $this;
    }
}
