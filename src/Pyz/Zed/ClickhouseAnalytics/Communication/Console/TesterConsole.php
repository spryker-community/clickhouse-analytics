<?php

namespace Pyz\Zed\ClickhouseAnalytics\Communication\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Pyz\Zed\ClickhouseAnalytics\Business\ClickhouseAnalyticsFacade getFacade()
 */
class TesterConsole extends \Spryker\Zed\Kernel\Communication\Console\Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'clickhouse:test';

    /**
     * @var string
     */
    public const DESCRIPTION = 'clickhouse test';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription(static::DESCRIPTION);

        parent::configure();
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        var_dump($this->getFacade()->findMetrics(1000));

        return static::CODE_SUCCESS;
    }
}
