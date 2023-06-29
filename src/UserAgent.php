<?php

declare(strict_types=1);

namespace Oselya\UserAgentClientHint;

/**
 * Strings from Chromium, Chrome, Edge, and Opera desktop browsers are shown below. 
 * Note that they all share the "Chromium" brand, but have an additional brand indicating their origin. 
 * They also have an intentionally incorrect brand string, which may appear in any position and have different text.
 * 
 * Sec-CH-UA: "(Not(A:Brand";v="8", "Chromium";v="98"
 * Sec-CH-UA: " Not A;Brand";v="99", "Chromium";v="96", "Google Chrome";v="96"
 * Sec-CH-UA: " Not A;Brand";v="99", "Chromium";v="96", "Microsoft Edge";v="96"
 * Sec-CH-UA: "Opera";v="81", " Not;A Brand";v="99", "Chromium";v="95"
 */
readonly class UserAgent
{
    public function __construct(private string $value)
    {
    }

    public function getName(): string
    {
        $data = self::parse($this->value);

        if ($data === null) {
            return '';
        }

        return sanitize(trim($data[0], " \n\r\t\v\x00\""));
    }

    public function getVersion(): string
    {
        $data = self::parse($this->value);

        if ($data === null) {
            return '';
        }

        $version = $data[1];
        $version = str_replace('v=', '', $version);
        $version = sanitize($version);

        return trim($version, " \n\r\t\v\x00\"");
    }

    private static function parse(string $value): ?array
    {
        $data = array_map('trim', explode(';', $value));

        if (count($data) != 2) {
            return null;
        }

        return $data;
    }
}
