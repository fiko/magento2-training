<?php

declare(strict_types=1);

namespace Fiko\Training\Console\Command;

use Magento\Framework\Exception\LocalizedException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Fiko\Training\Model\CmsPage;

class Testing extends Command
{
    private const NAME = 'name';
    private $cmsPage;

    public function __construct(CmsPage $cmsPage)
    {
        $this->cmsPage = $cmsPage;

        parent::__construct(null);
    }

    protected function configure(): void
    {
        $this->setName('fiko:training');
        $this->setDescription('This is my first training console command.');
        // $this->addOption(
        //     self::NAME,
        //     null,
        //     InputOption::VALUE_REQUIRED,
        //     'Name'
        // );

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
        $tmp = $this->cmsPage->getCmsPageDetails();
        header("Content-Type: application/json;");
        die(json_encode(is_object($tmp) ? get_class_methods($tmp) : $tmp));
         $exitCode = 0;

         if ($name = $input->getOption(self::NAME)) {
             $output->writeln('<info>Provided name is `' . $name . '`</info>');
         }

         $output->writeln('<info>Success message.</info>');
         $output->writeln('<comment>Some comment.</comment>');

         try {
             if (rand(0, 1)) {
                 throw new LocalizedException(__('An error occurred.'));
             }
         } catch (LocalizedException $e) {
             $output->writeln(sprintf(
                 '<error>%s</error>',
                 $e->getMessage()
             ));
             $exitCode = 1;
         }

         return $exitCode;
     }
}
