<?php

namespace Neyric\MangoPayBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Neyric\MangoPayBundle\Service\MangoPayService;

class RateLimitsCommand extends Command
{
    protected static $defaultName = 'neyric_mangopay:ratelimits';

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
        $api = $this->mangoPayService->api;

        // Note: do a random query
        $hooks = $api->Hooks->GetAll();
        
        // This is an arary of 4 RateLimit objects.
        $rateLimits = $api->RateLimits;

        $output->writeln("There were " . $rateLimits[0]->CallsMade . " calls made in the last 15 minutes");
        $output->writeln("You can do " . $rateLimits[0]->CallsRemaining . " more calls in the next 15 minutes");
        $output->writeln("The 15 minutes counter will reset in " . $rateLimits[0]->ResetTimeMillis . " ms\n");

        $output->writeln("There were " . $rateLimits[2]->CallsMade . " calls made in the last 60 minutes");
        $output->writeln("You can do " . $rateLimits[2]->CallsRemaining . " more calls in the next 60 minutes");
        $output->writeln("The 60 minutes counter will reset in " . $rateLimits[1]->ResetTimeMillis . " ms");
    }
}
