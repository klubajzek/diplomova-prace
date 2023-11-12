<?php

namespace App\Traits\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait Deactivationable
{
    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isDeactivated = true;

    public function isDeactivated(): bool
    {
        return $this->isDeactivated;
    }

    public function deactivate(): void
    {
        $this->isDeactivated = false;
    }

    public function activate(): void
    {
        $this->isDeactivated = true;
    }
}