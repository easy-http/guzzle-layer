<?php

namespace EasyHttp\GuzzleLayer\Concerns;

trait NeedsParseHeaders
{
    protected function parseHeaders(array $headers): array
    {
        $_headers = [];

        foreach ($headers as $key => $value) {
            /**
             * RFC 7230, section 3.2.2 allows multiple Set-Cookie headers
             * @see https://datatracker.ietf.org/doc/html/rfc7230#section-3.2.2
             */
            if (strtolower($key) === 'set-cookie') {
                $_headers[$key] = $value;
                continue;
            }

            $_headers[$key] = array_shift($value);
        }

        return $_headers;
    }
}
