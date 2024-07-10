<?php

namespace App\Entity\MiniGames\Match;

use App\Repository\MiniGame\Match\MiniGameMatchAnswerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MiniGameMatchAnswerRepository::class)]
class MiniGameMatchAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $answer = null;

    #[ORM\OneToOne(inversedBy: 'miniGameMatchAnswer', cascade: ['persist', 'remove'])]
    private ?MiniGameMatchQuestion $question = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(?string $answer): static
    {
        $this->answer = $answer;

        return $this;
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
}
