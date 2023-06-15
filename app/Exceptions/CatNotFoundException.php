<?php

namespace App\Exceptions;

class CatNotFoundException extends \Exception
{
    public const MESSAGE = 'Cat with ID %s was not found.';
    public static function forId($id): self
    {
        return new self(sprintf(static::MESSAGE, $id));
    }
}
