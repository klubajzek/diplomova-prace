<?php

namespace App\Service\Game;

use App\Repository\Game\GameRepository;

class UniqueCodeGeneratorService
{
    public function __construct(private readonly GameRepository $gameRepository)
    {
    }

    public function __invoke(): string
    {
        $code = $this->generateCode();

        while ($this->gameRepository->findOneBy(['code' => $code]) !== null) {
            $code = $this->generateCode();
        }

        return $code;
    }

    private function generateCode(): string
    {
        return strtoupper(bin2hex(random_bytes(3)));
    }
}