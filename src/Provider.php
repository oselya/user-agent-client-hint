<?php

declare(strict_types=1);

namespace Oselya\UserAgentClientHint;

class Provider implements ProviderInterface
{
    public function provide(): UserAgentHint
    {
        if (function_exists('getallheaders')) {
            $headers = getallheaders();
        } else {
            $headers = self::getAllHeaders();
        }

        return new UserAgentHint($headers);
    }

    private static function getAllHeaders(): array
    {
        $headers = [];

        foreach ($_SERVER as $name => $value) {
            if (str_starts_with($name, 'HTTP_')) {
                $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($name, 5)))));
                $headers[$header] = $value;
            }
        }

        return $headers;
    }
}
