<?php
declare(strict_types=1);

namespace App\UI\Cli\Command;

use App\Application\Service\TreeExtenderService;
use App\Infrastructure\Loader\JsonLoader;
use App\Infrastructure\Saver\JsonSaver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FillTreeCommand extends Command
{
    const FILES_PATH = 'var/files/';
    protected static $defaultName = 'tree:fill';

    protected function configure(): void
    {
        $this
            ->addOption('treeFile', null, InputOption::VALUE_OPTIONAL, '', 'tree.json')
            ->addOption('listFile', null, InputOption::VALUE_OPTIONAL, '', 'list.json')
            ->setDescription('Fill json tree with property from json list');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $service = new TreeExtenderService(
                new JsonLoader(self::FILES_PATH . $input->getOption('treeFile')),
                new JsonLoader(self::FILES_PATH . $input->getOption('listFile'))
            );
            $service->fillTree();

            $saver = new JsonSaver(self::FILES_PATH . 'result.json', json_encode($service->getNewTree()));
            $saver->saveJsonData();

        } catch (\Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}