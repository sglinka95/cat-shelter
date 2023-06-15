<?php

namespace App\Exceptions;

class EmployeeNotFoundException extends \Exception
{
    public const MESSAGE = 'Employee with ID %s was not found.';
    public static function forId($id): self
    {
        return new self(sprintf(static::MESSAGE, $id));
    }
}
