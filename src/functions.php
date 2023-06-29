<?php

declare(strict_types=1);

namespace Oselya\UserAgentClientHint;

function sanitize(string $value): string
{
    return trim(preg_replace('/[[:^print:]]/', '', $value));
}

