<?php

declare(strict_types=1);

namespace App\Exception;

final class InvalidItemException extends \RuntimeException
{
    public static function negativeItemValue(): self
    {
        return new self('Item value cannot be negative');
    }
}
