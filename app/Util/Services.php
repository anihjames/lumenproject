<?php

namespace App\Util;

use GuzzleHttp\Client;

class Service 
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function LoggedInUser()
    {
      return $this->client->endpointRequest('/');   
    }
}