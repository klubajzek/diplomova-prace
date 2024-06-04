<?php

namespace App\Entity\Game;

use App\Repository\Game\GameRepository;
use App\Traits\Entity\Datetimeable;
use App\Traits\Entity\Deactivationable;
use App\Traits\Entity\ID;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    use ID, Datetimeable, Deactivationable;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: GameProfile::class)]
    private Collection $gameProfiles;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    public function __construct()
    {
        $this->gameProfiles = new ArrayCollection();
    }

    /**
     * @return Collection<int, GameProfile>
     */
    public function getGameProfiles(): Collection
    {
        return $this->gameProfiles;
    }

    public function addGameProfile(GameProfile $gameProfile): static
    {
        if (!$this->gameProfiles->contains($gameProfile)) {
            $this->gameProfiles->add($gameProfile);
            $gameProfile->setGame($this);
        }

        return $this;
    }

    public function removeGameProfile(GameProfile $gameProfile): static
    {
        if ($this->gameProfiles->removeElement($gameProfile)) {
            // set the owning side to null (unless already changed)
            if ($gameProfile->getGame() === $this) {
                $gameProfile->setGame(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }
}
