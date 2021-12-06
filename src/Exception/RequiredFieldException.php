<?php
declare(strict_types=1);

namespace SmartEmailing\Exception;

use Exception;

class RequiredFieldException extends Exception
{
    public static function check(array $required, array $fields): void
    {
        $errors = [];

        foreach ($required as $field) {
            if (!\array_key_exists($field, $fields) || \is_null($fields[$field])) {
                $errors[] = $field;
            }
        }

        if (\count($errors)>0) {
            throw new RequiredFieldException(
                'These required fields are not set or empty [' . \implode(',', $errors) . ']'
            );
        }
    }
}
