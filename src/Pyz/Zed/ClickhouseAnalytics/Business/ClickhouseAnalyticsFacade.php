<?php

namespace Pyz\Zed\ClickhouseAnalytics\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method ClickhouseAnalyticsBusinessFactory getFactory()
 */
class ClickhouseAnalyticsFacade extends AbstractFacade
{
    public function findMetrics(): array
    {
        return $this
            ->createAdapter()
            ->findMetrics();
    }

    public function getAllUserJourneys(int $interval): array
    {
        return $this->getFactory()->createMetrics()->getAllUserJourneys($interval);
    }
}
a
