<?php

declare(strict_types=1);

namespace Oselya\UserAgentClientHint\Tests;

use Generator;
use PHPUnit\Framework\TestCase;
use Oselya\UserAgentClientHint\Provider;
use Oselya\UserAgentClientHint\UserAgent;

class ProviderTest extends TestCase 
{
    public function test(): void
    {
        $provider = new Provider();

        $_SERVER['HTTP_SEC_CH_UA_ARCH'] = 'ARM';
        $_SERVER['HTTP_SEC_CH_UA_BITNESS'] = '64';
        $_SERVER['HTTP_SEC_CH_UA_FULL_VERSION'] = '96.0.4664.110';
        $_SERVER['HTTP_SEC_CH_UA_MOBILE'] = '?1';
        $_SERVER['HTTP_SEC_CH_UA_MODEL'] = 'Pixel 3';
        $_SERVER['HTTP_SEC_CH_UA_PLATFORM'] = 'Linux';
        $_SERVER['HTTP_SEC_CH_UA_PLATFORM_VERSION'] = '10.0.0';
        $_SERVER['HTTP_SEC_CH_UA_FORM_FACTOR'] = 'Phone';
        $_SERVER['HTTP_SEC_CH_UA'] = '"Opera";v="81", " Not;A Brand";v="99", "Chromium";v="95"';
        $_SERVER['HTTP_SEC_CH_UA_FULL_VERSION_LIST'] = '" Not A;Brand";v="99.0.0.0", "Chromium";v="98.0.4750.0", "Google Chrome";v="98.0.4750.0"';

        $hint = $provider->provide();

        self::assertEquals('ARM', $hint->getArch());
        self::assertEquals('64', $hint->getBitness());
        self::assertEquals('96.0.4664.110', $hint->getFullVersion());
        self::assertTrue($hint->isMobile());
        self::assertEquals('Pixel 3', $hint->getModel());
        self::assertEquals('Linux', $hint->getPlatform());
        self::assertEquals('10.0.0', $hint->getPlatformVersion());
        self::assertEquals('Phone', $hint->getFormFactor());
        self::assertCount(3, $hint->getAgent());
        self::assertCount(3, $hint->getAgentWithFullVersion());
        self::assertContainsOnlyInstancesOf(UserAgent::class, $hint->getAgent());
        self::assertContainsOnlyInstancesOf(UserAgent::class, $hint->getAgentWithFullVersion());

        $firstUa = $hint->getAgent()[0];

        self::assertEquals('Opera', $firstUa->getName());
        self::assertEquals('81', $firstUa->getVersion());
    }
}