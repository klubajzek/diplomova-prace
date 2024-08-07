<?php

namespace App\Entity\MiniGames\Match;

use App\Repository\MiniGames\Match\MiniGameMatchAnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'answer', targetEntity: MiniGameMatchResultItem::class)]
    private Collection $miniGameMatchResultItems;

    #[ORM\OneToMany(mappedBy: 'mistakeAnswer', targetEntity: MiniGameMatchResultItem::class)]
    private Collection $miniGameMatchResultMistakeItems;

    public function __construct()
    {
        $this->miniGameMatchResultItems = new ArrayCollection();
        $this->miniGameMatchResultMistakeItems = new ArrayCollection();
    }

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
            $miniGameMatchResultItems->setAnswer($this);
        }

        return $this;
    }

    public function removeMiniGameMatchResultItem(MiniGameMatchResultItem $miniGameMatchResultItems): static
    {
        if ($this->miniGameMatchResultItems->removeElement($miniGameMatchResultItems)) {
            // set the owning side to null (unless already changed)
            if ($miniGameMatchResultItems->getAnswer() === $this) {
                $miniGameMatchResultItems->setAnswer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MiniGameMatchResultItem>
     */
    public function getMiniGameMatchResultMistakeItems(): Collection
    {
        return $this->miniGameMatchResultMistakeItems;
    }

    public function addMiniGameMatchResultMistakeItem(MiniGameMatchResultItem $miniGameMatchResultMistakeItem): static
    {
        if (!$this->miniGameMatchResultMistakeItems->contains($miniGameMatchResultMistakeItem)) {
            $this->miniGameMatchResultMistakeItems->add($miniGameMatchResultMistakeItem);
            $miniGameMatchResultMistakeItem->setMistakeAnswer($this);
        }

        return $this;
    }

    public function removeMiniGameMatchResultMistakeItem(MiniGameMatchResultItem $miniGameMatchResultMistakeItem): static
    {
        if ($this->miniGameMatchResultMistakeItems->removeElement($miniGameMatchResultMistakeItem)) {
            // set the owning side to null (unless already changed)
            if ($miniGameMatchResultMistakeItem->getMistakeAnswer() === $this) {
                $miniGameMatchResultMistakeItem->setMistakeAnswer(null);
            }
        }

        return $this;
    }
}
