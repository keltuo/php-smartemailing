<?php
declare(strict_types=1);

namespace SmartEmailing\Util;

use DateTime;
use InvalidArgumentException;
use function Symfony\Component\String\u;

class Helpers
{
    public static function formatDate(string $date, string $format = 'Y-m-d H:i:s'): string
    {
        return (new DateTime($date))->format($format);
    }

    public static function validateEmail(string $email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('Email [%s] is not valid!', $email));
        }
        return true;
    }

    public static function replaceUrlParameters(string $uri, array $parameters): string
    {
        foreach ($parameters as $key => $value) {
            $uri = str_replace((string)u($key)->prepend(':')->lower(), (string)$value, $uri);
        }
        return $uri;
    }
}
