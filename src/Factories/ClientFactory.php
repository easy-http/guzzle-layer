<?php

namespace EasyHttp\GuzzleLayer\Factories;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class ClientFactory
{
    public static function build($handler = null)
    {
        $instance = null;

        if ($handler) {
            $handler  = HandlerStack::create($handler);
            $instance = new Client(['handler' => $handler]);
        } else {
            $instance = new Client();
        }

        return $instance;
    }
}
