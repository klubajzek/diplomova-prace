<?php

namespace App\Entity\MiniGames\Match;


use App\Repository\MiniGames\Match\MiniGameMatchResultRepository;
use App\Traits\MiniGame\MiniGameResultTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MiniGameMatchResultRepository::class)]
class MiniGameMatchResult
{
    use MiniGameResultTrait;
}
