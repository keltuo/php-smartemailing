<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Bag;

use SmartEmailing\Api\Model\Contact\Purpose;

class PurposeBag extends AbstractBag
{
    public function add(Purpose $model): PurposeBag
    {
        $this->insertEntry($model);
        return $this;
    }

    public function create(
        int $id,
        ?string $validFrom = null,
        ?string $validTo = null
    ): Purpose
    {
        $model = new Purpose($id, $validFrom, $validTo);
        $this->add($model);
        return $model;
    }
}
