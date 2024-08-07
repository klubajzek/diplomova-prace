<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class RandomArrayExtension extends AbstractExtension
{

    public function getFunctions() : array
    {
        return [
            new TwigFunction('randomArray', [$this, 'randomArray']),
        ];
    }

    public function randomArray(array $array) : array
    {
        shuffle($array);

        return $array;
    }

}