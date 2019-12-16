<?php

namespace Neyric\MangoPayBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

use Neyric\MangoPayBundle\Service\MangoPayService;

class HookListCommand extends Command
{
    protected static $defaultName = 'neyric_mangopay:hooks:list';

    private $mangoPayService;

    public function __construct(MangoPayService $mangoPayService) {
        $this->mangoPayService = $mangoPayService;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('List MangoPay hooks');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $hooks = $this->mangoPayService->api->Hooks->GetAll();

        $table = new Table($output);
        $table
            ->setHeaders(['EventType', 'Url', 'Status', 'Validity'])
            ->setRows(array_map(function($hook) {
                return [ $hook->EventType, $hook->Url, $hook->Status, $hook->Validity ];
            }, $hooks))
        ;
        $table->render();

    }
}
