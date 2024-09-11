<?php

namespace Pyz\Client\ClickhouseAnalytics;

use Spryker\Client\Kernel\AbstractClient;

class ClickhouseAnalyticsClient extends AbstractClient
{
    public function query(string $query, array $parameters = []): array
    {
        return $this->getFactory()
            ->createClickhouseAnalyticsQuery()
            ->query($query, $parameters);
    }
}
