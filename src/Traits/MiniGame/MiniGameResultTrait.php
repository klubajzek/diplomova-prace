<?php

namespace App\Traits\MiniGame;

use App\Entity\Game\GameProfile;
use App\Traits\Entity\Datetimeable;
use Doctrine\ORM\Mapping as ORM;

trait MiniGameResultTrait
{
    use Datetimeable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'miniGameMatchResults')]
    private ?GameProfile $gameProfile = null;

    #[ORM\Column(nullable: true)]
    private ?int $mistakes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameProfile(): ?GameProfile
    {
        return $this->gameProfile;
    }

    public function setGameProfile(?GameProfile $gameProfile): static
    {
        $this->gameProfile = $gameProfile;

        return $this;
    }

    public function getMistakes(): ?int
    {
        return $this->mistakes;
    }

    public function setMistakes(?int $mistakes): static
    {
        $this->mistakes = $mistakes;

        return $this;
    }
}