<?php

declare(strict_types=1);

namespace App\Exception;

final class InvalidCartException extends \RuntimeException
{
    public static function negativeCartItems(): self
    {
        return new self('No of Items in cart cannot be negative');
    }
}
