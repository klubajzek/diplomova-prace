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
