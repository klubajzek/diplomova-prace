<?php

namespace App\Entity\Game;

use App\Repository\Game\GameProfileBuildingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameProfileBuildingRepository::class)]
class GameProfileBuilding
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'gameProfileBuildings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GameProfile $gameProfile = null;

    #[ORM\Column(length: 255)]
    private ?string $position = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $people = null;

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

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPeople(): ?string
    {
        return $this->people;
    }

    public function setPeople(string $people): static
    {
        $this->people = $people;

        return $this;
    }
}
