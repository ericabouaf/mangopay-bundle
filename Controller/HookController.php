<?php

namespace Neyric\MangoPayBundle\Controller;

use Neyric\MangoPayBundle\Event\MangoPayHookEvent;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Psr\Log\LoggerInterface;

class HookController
{
    private $logger;
    private $eventDispatcher;

    public function __construct(LoggerInterface $logger, EventDispatcherInterface $eventDispatcher)
    {
        $this->logger = $logger;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Ex: /mangopay/hook_handler?EventType=KYC_SUCCEEDED&RessourceId=123455&Date=4562783947
     */
    public function hookHandlerAction(Request $request): JsonResponse
    {
        $qp = $request->query->all();
        $this->logger->info("Mangopay HookEvent", $qp);

        $eventType = $request->get('EventType');
        $ressourceId = $request->get('RessourceId');
        $date = $request->get('Date');

        $eventName = "MANGOPAY_" . $eventType;
        $event = new MangoPayHookEvent($eventType, $ressourceId, $date);

        $this->eventDispatcher->dispatch($event, $eventName);

        return JsonResponse::create([
            'success' => true
        ]);
    }
}
