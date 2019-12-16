<?php

namespace Neyric\MangoPayBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HookControllerTest extends WebTestCase
{
    public function testHookHandlerAction()
    {
        $client = static::createClient();
        $client->request('GET', '/mangopay_webook/hook_handler?EventType=KYC_DUMMY_EVENT&RessourceId=123455&Date=4562783947');

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}
