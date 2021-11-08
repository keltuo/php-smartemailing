<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Util;

use InvalidArgumentException;
use SmartEmailing\Util\Helpers;
use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    /**
     * @dataProvider dateProvider
     * @param string $date
     */
    public function testConvertDate(string $date)
    {
        $this->assertEquals('2021-10-04 00:00:00', Helpers::formatDate($date));
    }

    /**
     * @dataProvider emailProvider
     * @param $email
     */
    public function testValidateEmail(string $email)
    {
        $this->assertTrue(Helpers::validateEmail($email));
    }

    public function testNonValidEmail()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Email [invalid.@email.cz] is not valid!');
        $this->assertFalse(Helpers::validateEmail('invalid.@email.cz'));
    }

    public function emailProvider(): array
    {
        return [
            ['test@email.cz'],
            ['test.test1@email.cz'],
            ['test_email-email@email.cz'],
        ];
    }

    public function dateProvider(): array
    {
        return [
            ['4.10.2021 00:00:00'],
            ['04.10.2021 00:00:00'],
            ['00:00:00 04.10.2021'],
        ];
    }
}
