<?php

namespace App\Entity\MiniGames\Match;


use App\Repository\MiniGames\Match\MiniGameMatchResultRepository;
use App\Traits\MiniGame\MiniGameResultTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MiniGameMatchResultRepository::class)]
class MiniGameMatchResult
{
    use MiniGameResultTrait;

    #[ORM\OneToMany(mappedBy: 'result', targetEntity: MiniGameMatchResultItem::class)]
    private Collection $miniGameMatchResultItems;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resource = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $correctAnswers = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $notFilled = null;

    public function __construct()
    {
        $this->miniGameMatchResultItems = new ArrayCollection();
    }

    /**
     * @return Collection<int, MiniGameMatchResultItem>
     */
    public function getMiniGameMatchResultItems(): Collection
    {
        return $this->miniGameMatchResultItems;
    }

    public function addMiniGameMatchResultItem(MiniGameMatchResultItem $miniGameMatchResultItems): static
    {
        if (!$this->miniGameMatchResultItems->contains($miniGameMatchResultItems)) {
            $this->miniGameMatchResultItems->add($miniGameMatchResultItems);
            $miniGameMatchResultItems->setResult($this);
        }

        return $this;
    }

    public function removeMiniGameMatchResultItem(MiniGameMatchResultItem $miniGameMatchResultItems): static
    {
        if ($this->miniGameMatchResultItems->removeElement($miniGameMatchResultItems)) {
            // set the owning side to null $miniGameMatchResultItems
            if ($miniGameMatchResultItems->getResult() === $this) {
                $miniGameMatchResultItems->setResult(null);
            }
        }

        return $this;
    }

    public function getResource(): ?string
    {
        return $this->resource;
    }

    public function setResource(?string $resource): static
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
}
