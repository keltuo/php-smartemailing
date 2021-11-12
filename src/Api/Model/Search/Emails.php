<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Search;

use JetBrains\PhpStorm\Pure;

class Emails extends SingleEmail
{
    #[Pure]
    protected function getSortAllowedValues(): array
    {
        return $this->getDefaultFields();
    }
}
