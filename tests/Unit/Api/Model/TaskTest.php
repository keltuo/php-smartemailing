<?php

namespace SmartEmailing\Test\Unit\Api\Model;

use PHPUnit\Framework\TestCase;
use SmartEmailing\Api\Model\Bag\AttachmentBag;
use SmartEmailing\Api\Model\Bag\ReplaceBag;
use SmartEmailing\Api\Model\Recipient;
use SmartEmailing\Api\Model\Task;

class TaskTest extends TestCase
{
    public function testToArray()
    {
        $class = new Task(new Recipient('email@address.cz'));
        $this->assertEquals([
            'recipient' => new Recipient('email@address.cz'),
            'replace' => new ReplaceBag(),
            'attachments' => new AttachmentBag()
        ], $class->toArray());

    }
}
