<?php

declare(strict_types=1);

namespace App\Exception;

final class ItemNotFoundException extends \RuntimeException
{
    public static function byId(string $id): self
    {
        return new self(sprintf('Item "%s" not found', $id));
    }
}
