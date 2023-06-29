<?php

declare(strict_types=1);

namespace Oselya\UserAgentClientHint;

/**
 * @link https://wicg.github.io/ua-client-hints/#http-ua-hints
 * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Client_hints#user-agent_client_hints
 */

const ACCEPT_CH_HEADER = 'Accept-CH';
const SEC_CH_UA_HEADER = 'Sec-CH-UA';
const SEC_CH_UA_ARCH_HEADER = 'Sec-CH-UA-Arch';
const SEC_CH_UA_BITNESS_HEADER = 'Sec-CH-UA-Bitness';
const SEC_CH_UA_FULL_VERSION_LIST_HEADER = 'Sec-CH-UA-Full-Version-List';
const SEC_CH_UA_FULL_VERSION_HEADER = 'Sec-CH-UA-Full-Version';
const SEC_CH_UA_MOBILE_HEADER = 'Sec-CH-UA-Mobile';
const SEC_CH_UA_MODEL_HEADER = 'Sec-CH-UA-Model';
const SEC_CH_UA_PLATFORM_HEADER = 'Sec-CH-UA-Platform';
const SEC_CH_UA_PLATFORM_VERSION_HEADER = 'Sec-CH-UA-Platform-Version';
const SEC_CH_UA_FORM_FACTOR_HEADER = 'Sec-CH-UA-Form-Factor';
