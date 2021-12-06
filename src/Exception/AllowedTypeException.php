<?php
declare(strict_types=1);

namespace SmartEmailing\Exception;

use Exception;

class AllowedTypeException extends Exception
{
    public static function check(string $type, array $allowed): void
    {
        if (!\in_array($type, $allowed)) {
            throw new AllowedTypeException(
                \sprintf(
                    'This type [%s] is not allowed. Supported types [%s]',
                    $type,
                    \implode(', ', $allowed)
                )
            );
        }
    }
}
