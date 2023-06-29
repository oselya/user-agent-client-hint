<?php

declare(strict_types=1);

namespace Oselya\UserAgentClientHint;

interface ProviderInterface {
    public function provide(): UserAgentHint;
}