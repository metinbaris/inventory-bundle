<?php

namespace MetinBaris\InventoryBundle\Command;

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
            ->addArgument('stockCsvDirectory', InputArgument::REQUIRED, 'Path to the stock CSV directory');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $stockCsvDirectory = $input->getArgument('stockCsvDirectory');

        // TODO command logic here, given path read CSV
        return Command::SUCCESS;
    }
}
