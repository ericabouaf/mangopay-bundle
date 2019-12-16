<?php

namespace Neyric\MangoPayBundle\Tests\command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HookListCommandTest extends KernelTestCase
{
    public function testHookListCommand()
    {
        self::bootKernel();
        $container = self::$container;

        $application = new Application(self::$kernel);

        $hookListCommand = $container->get('Neyric\MangoPayBundle\Command\HookListCommand');

        $this->assertNotNull($hookListCommand);
    }
}
