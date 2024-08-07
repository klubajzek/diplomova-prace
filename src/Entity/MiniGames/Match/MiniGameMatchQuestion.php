<?php

namespace App\Entity\MiniGames\Match;

use App\Repository\MiniGames\Match\MiniGameMatchQuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: MiniGameMatchResultItem::class)]
    private Collection $miniGameMatchResultItems;

    public function __construct()
    {
        $this->miniGameMatchResultItems = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, MiniGameMatchResultItem>
     */
    public function getMiniGameMatchResultItem(): Collection
    {
        return $this->miniGameMatchResultItems;
    }

    public function addMiniGameMatchResultItem(MiniGameMatchResultItem $miniGameMatchResultItems): static
    {
        if (!$this->miniGameMatchResultItems->contains($miniGameMatchResultItems)) {
            $this->miniGameMatchResultItems->add($miniGameMatchResultItems);
            $miniGameMatchResultItems->setQuestion($this);
        }

        return $this;
    }

    public function removeMiniGameMatchResultItem(MiniGameMatchResultItem $miniGameMatchResultItems): static
    {
        if ($this->miniGameMatchResultItems->removeElement($miniGameMatchResultItems)) {
            // set the owning side to null (unless already changed)
            if ($miniGameMatchResultItems->getQuestion() === $this) {
                $miniGameMatchResultItems->setQuestion(null);
            }
        }

        return $this;
    }
}
