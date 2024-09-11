<?php

namespace Pyz\Zed\ClickhouseAnalytics\Business;

use ClickHouseDB\Client;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ClickhouseAnalyticsBusinessFactory extends AbstractBusinessFactory
{
    public function createMetrics(): Metrics
    {
        return new Metrics($this->createClickhouseClient());
    }

    private function createClickhouseClient(): Client
    {
        $client = new Client([
            'host' => 'clickhouse',
            'port' => '8123',
            'username' => 'default',
            'password' => '',

        ]);

        $client->database('analytics');

        return $client;
    }
}
