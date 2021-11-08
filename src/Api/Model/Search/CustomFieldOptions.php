<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Search;

use JetBrains\PhpStorm\Pure;

class CustomFieldOptions extends SingleCustomFieldOptions
{
    #[Pure]
    protected function getSortAllowedValues(): array
    {
        return $this->getDefaultFields();
    }

    #[Pure]
    protected function getFilterAllowedValues(): array
    {
        return $this->getDefaultFields();
    }
}
