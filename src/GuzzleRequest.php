<?php

namespace EasyHttp\GuzzleLayer;

use EasyHttp\LayerContracts\Common\ClientRequest;

class GuzzleRequest extends ClientRequest
{
    protected array $urlEncodedData = [];
    protected array $serverCookies = [];

    public function hasUrlEncodedData(): bool
    {
        return ! empty($this->urlEncodedData);
    }

    public function getUrlEncodedData(): array
    {
        return $this->urlEncodedData;
    }

    public function setUrlEncodedData(array $urlEncodedData): self
    {
        $this->urlEncodedData = $urlEncodedData;

        return $this;
    }

    public function hasServerCookies(): bool
    {
        return ! empty($this->serverCookies);
    }

    public function getServerCookies(): array
    {
        return $this->serverCookies;
    }

    public function setServerCookies(array $serverCookies): self
    {
        $this->serverCookies = $serverCookies;

        return $this;
    }
}
