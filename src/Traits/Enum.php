<?php

namespace App\Traits;

use ReflectionEnum;

trait Enum
{
    public static function names() : array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values() : array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array() : array
    {
        return array_combine(self::values(), self::names());
    }

    public static function tryFromName(string $name) : ?static
    {
        $reflection = new ReflectionEnum(static::class);

        try {
            return $reflection->hasCase($name)
                ? $reflection->getCase($name)->getValue()
                : null;
        } catch (\ReflectionException $e) {
            return null;
        }
    }

}