<?php

namespace App\Entity\MiniGames\Drag;

use App\Repository\MiniGames\Drag\MiniGameDragResultRepository;
use App\Traits\MiniGame\MiniGameResultTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MiniGameDragResultRepository::class)]
class MiniGameDragResult
{
    use MiniGameResultTrait;
}
