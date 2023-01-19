<?php
// src/AppBundle/Command/personneCommand.php
namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


// // the "name" and "description" arguments of AsCommand replace the
// // static $defaultName and $defaultDescription properties
#[AsCommand(
    name: 'app:read',
    description: 'Show list of person.',
    hidden: false,
    aliases: ['app:read']
)]
class personneCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        $output->writeln('Whoa!');

        return Command::SUCCESS;
    }

}