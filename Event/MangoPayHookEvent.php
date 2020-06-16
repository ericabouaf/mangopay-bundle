<?php

namespace Neyric\MangoPayBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;

class MangoPayHookEvent extends Event
{
    protected $eventType;
    protected $ressourceId;
    protected $date;

    public function __construct(string $eventType, string $ressourceId, string $date)
    {
        $this->eventType = $eventType;
        $this->ressourceId = $ressourceId;
        $this->date = $date;
    }

    public function getEventType(): string
    {
        return $this->eventType;
    }

    public function getRessourceId(): string
    {
        return $this->ressourceId;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}
