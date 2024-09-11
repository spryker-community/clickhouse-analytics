<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\ClickhouseAnalytics\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\ClickhouseAnalytics\Business\ClickhouseAnalyticsFacade getFacade()
 */
class IndexController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction(Request $request): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function userJourneysAction(Request $request): array
    {
        $userId = $request->get('user') ?? null;

        return [
            'selectedUser' => $userId,
            'userJourneys' => $this->getFacade()->getAllUserJourneys(60)
        ];
    }
}
