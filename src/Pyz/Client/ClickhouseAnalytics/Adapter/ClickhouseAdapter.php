<?php

namespace Pyz\Client\ClickhouseAnalytics\Adapter;

use ClickHouseDB\Client;

class ClickhouseAdapter
{
    public function __construct(private Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $query
     *
     * @return array
     */
    public function query($query)
    {
        return $this->client->select($query)->rows();
    }
}
