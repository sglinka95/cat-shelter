<?php

namespace App\Exceptions;

class DepartmentNotFoundException extends \Exception
{
    public const MESSAGE = 'Department with ID %s was not found.';
    public static function forId($id): self
    {
        return new self(sprintf(static::MESSAGE, $id));
    }
}
