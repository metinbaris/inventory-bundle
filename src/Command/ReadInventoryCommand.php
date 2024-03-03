<?php

namespace MetinBaris\InventoryBundle\Command;

use MetinBaris\InventoryBundle\Service\InventoryCsvService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReadInventoryCommand extends Command
{
    protected static $defaultName = 'metinbaris:read-inventory';

    protected function configure()
    {
        $this->setName(self::$defaultName)
            ->setDescription('Reads inventory data from given CSV file.')
            ->addArgument('path', InputArgument::REQUIRED, 'Path to the stock CSV file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $csvFilePath = $input->getArgument('path');

        $inventoryCsvService = new InventoryCsvService();
        try {
            $inventoryCsvService->update($csvFilePath);
            $output->writeln('<info>Successfuly updated</info>');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");
            return Command::FAILURE;
        }
    }
}
