<?php

namespace Pyz\Client\ClickhouseAnalytics;

use Pyz\Client\ClickhouseAnalytics\Adapter\ClickhouseAdapter;
use Spryker\Client\Kernel\AbstractFactory;

class ClickhouseAnalyticsFactory extends AbstractFactory
{
    public function createClickhouseAdapter(): ClickhouseAdapter
    {
        return new ClickhouseAdapter();
    }
}
