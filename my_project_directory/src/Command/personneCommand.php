<?php
// src/AppBundle/Command/personneCommand.php
namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;


// // the "name" and "description" arguments of AsCommand replace the
// // static $defaultName and $defaultDescription properties
// #[AsCommand(
//     name: 'app:read',
//     description: 'Show list of person.',
//     hidden: false,
//     aliases: ['app:read']
// )]
class personneCommand extends Command
{

    protected function configure(): void
    {
        $this
            ->setName('app:read')
            ->setDescription('Show list of person.')
            ->setHelp('This command allows you to show list of person.')
        ;
    }
    
    // protected function execute(InputInterface $input, OutputInterface $output): int
    // {
    //     $output->write('Read person');

    //     return Command::SUCCESS;
    // }

}