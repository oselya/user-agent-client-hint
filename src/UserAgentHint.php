<?php

declare(strict_types=1);

namespace Oselya\UserAgentClientHint;

class UserAgentHint
{
    private array $headers;

    public function __construct(array $headers)
    {
        $data = [];

        foreach ($headers as $name => $value) {
            $data[strtolower($name)] = $value;
        }

        $this->headers = $data;
    }

    /**
     * Prepare and return value from Sec-CH-UA
     * 
     * @return UserAgent[]
     */
    public function getAgent(): array
    {
        $headerName = strtolower(SEC_CH_UA_HEADER);

        if (!array_key_exists($headerName, $this->headers)) {
            return [];
        }

        return array_map(
            fn ($i) => new UserAgent($i),
            explode(',', $this->headers[$headerName]),
        );
    }

    /**
     * Prepare and return value from Sec-CH-UA-Full-Version-List
     * 
     * @return UserAgent[]
     */
    public function getAgentWithFullVersion(): array
    {
        $headerName = strtolower(SEC_CH_UA_FULL_VERSION_LIST_HEADER);

        if (!array_key_exists($headerName, $this->headers)) {
            return [];
        }

        return array_map(
            fn ($i) => new UserAgent($i),
            explode(',', $this->headers[$headerName]),
        );
    }

    /**
     * Provides the user-agent's underlying CPU architecture, such as ARM or x86.
     */
    public function getArch(): string
    {
        return $this->get(SEC_CH_UA_ARCH_HEADER);
    }

    /**
     * Provides the "bitness" of the user-agent's underlying CPU architecture. 
     * This is the size in bits of an integer or memory address—typically 64 or 32 bits.
     */
    public function getBitness(): string
    {
        return $this->get(SEC_CH_UA_BITNESS_HEADER);
    }

    /**
     * Provides the user-agent's full version string.
     */
    public function getFullVersion(): string
    {
        return $this->get(SEC_CH_UA_FULL_VERSION_HEADER);
    }

    /**
     * Indicates whether the browser is on a mobile device. 
     * It can also be used by a desktop browser to indicate a preference for a "mobile" user experience.
     * 
     * ?1 indicates that the user-agent prefers a mobile experience (true). 
     * ?0 indicates that user-agent does not prefer a mobile experience (false).
     */
    public function isMobile(): bool
    {
        return $this->get(SEC_CH_UA_MOBILE_HEADER) === '?1';
    }

    /**
     * Provides the device model on which the browser is running.
     * For example "Pixel 5".
     */
    public function getModel(): string
    {
        return $this->get(SEC_CH_UA_MODEL_HEADER);
    }

    /**
     * Provides the platform or operating system on which the user agent is running. 
     * For example: "Windows" or "Android".
     */
    public function getPlatform(): string
    {
        return $this->get(SEC_CH_UA_PLATFORM_HEADER);
    }

    /**
     * Provides the version of the operating system on which the user agent is running.
     */
    public function getPlatformVersion(): string
    {
        return $this->get(SEC_CH_UA_PLATFORM_VERSION_HEADER);
    }

    /**
     * Provides information about the form factor of device.
     * For example: "Automotive", "Mobile", "Tablet", "TV", "VR", "XR", "Unknown" 
     */
    public function getFormFactor(): string
    {
        return $this->get(SEC_CH_UA_FORM_FACTOR_HEADER);
    }

    private function get(string $headerName): string
    {
        $headerName = strtolower($headerName);

        if (!array_key_exists($headerName, $this->headers)) {
            return '';
        }

        return sanitize($this->headers[$headerName]);
    }
}
