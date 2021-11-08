<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Search;

use JetBrains\PhpStorm\Pure;

class CustomFields extends SingleCustomFields
{
    #[Pure]
    protected function getSortAllowedValues(): array
    {
        return $this->getSelectAllowedValues();
    }

    #[Pure]
    protected function getFilterAllowedValues(): array
    {
        return $this->getSelectAllowedValues();
    }

    protected function getExpandAllowedValues(): array
    {
        return [
            self::CUSTOM_FIELD_OPTIONS
        ];
    }
}
