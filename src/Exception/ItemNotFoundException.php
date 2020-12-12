<?php

declare(strict_types=1);

namespace App\Exception;

final class ItemNotFoundException extends \RuntimeException
{
    public static function byItemName(string $itemName): self
    {
        return new self(sprintf('Item "%s" not found', $itemName));
    }
}
