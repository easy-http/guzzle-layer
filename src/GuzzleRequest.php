<?php

namespace EasyHttp\GuzzleLayer;

use EasyHttp\LayerContracts\Common\ClientRequest;

class GuzzleRequest extends ClientRequest
{
    protected array $urlEncodedData = [];

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
}
