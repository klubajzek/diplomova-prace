<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FilemtimeExtension extends AbstractExtension
{

    public function getFunctions() : array
    {
        return [
            new TwigFunction('filemtime', 'filemtime'),
        ];
    }

}