<?php

namespace App\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:test',
    description: '',
    hidden: false
)]
class Test extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('test');
        return Command::SUCCESS;
    }
}