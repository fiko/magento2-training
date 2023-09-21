<?php

declare(strict_types=1);

namespace Fiko\Training\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Fiko\Training\Helper\Data as HelperData;

class Testing extends Command
{
    private $helper;

    public function __construct(HelperData $helper)
    {
        $this->helper = $helper;

        parent::__construct(null);
    }

    protected function configure(): void
    {
        $this->setName('fiko:training');

        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
     protected function execute(InputInterface $input, OutputInterface $output): int
     {
        $output->writeln($this->helper->getName('Borizqy'));

        return 1;
     }
}
