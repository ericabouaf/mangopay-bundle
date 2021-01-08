<?php

namespace Neyric\MangoPayBundle\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RateLimitsCommandTest extends KernelTestCase
{
    public function testHookListCommand()
    {
        self::bootKernel();
        $container = self::$container;

        $application = new Application(self::$kernel);

        $hookListCommand = $container->get('Neyric\MangoPayBundle\Command\RateLimitsCommand');

        $this->assertNotNull($hookListCommand);
    }
}
