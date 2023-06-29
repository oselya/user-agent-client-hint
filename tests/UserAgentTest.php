<?php

declare(strict_types=1);

namespace Oselya\UserAgentClientHint\Tests;

use Generator;
use PHPUnit\Framework\TestCase;
use Oselya\UserAgentClientHint\UserAgent;

class UserAgentTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function test(string $value, string $name, string $version): void
    {
        $ua = new UserAgent($value);

        self::assertEquals($name, $ua->getName());
        self::assertEquals($version, $ua->getVersion());
    }

    public function dataProvider(): Generator
    {
        yield ['"Opera";v="81"', 'Opera', '81'];
        yield ['"Chromium";v="96"', 'Chromium', '96'];
        yield ['"Microsoft Edge";v="33"', 'Microsoft Edge', '33'];
        yield ['"Google Chrome";v="104"', 'Google Chrome', '104'];
    }
}
