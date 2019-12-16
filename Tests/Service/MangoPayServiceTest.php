<?php

namespace Neyric\MangoPayBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;

class MangoPayServiceTest extends KernelTestCase
{
    public function testMangoPayService()
    {
        self::bootKernel();
        $container = self::$container;

        $mangoPayService = $container->get('neyric_mangopay.service');

        $this->assertNotNull($mangoPayService);
        $this->assertNotNull($mangoPayService->api);
    }
}
