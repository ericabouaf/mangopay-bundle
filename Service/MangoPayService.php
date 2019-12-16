<?php

namespace Neyric\MangoPayBundle\Service;

use MangoPay;

class MangoPayService
{

    /** @var MangoPay\MangoPayApi */
    public $api;

    public function __construct(
        string $clientId,
        string $clientPassword,
        string $temporaryFolder,
        string $baseUrl,
        bool $debug
    )
    {
        $this->api = new MangoPay\MangoPayApi();

        $this->api->Config->ClientId = $clientId;
        $this->api->Config->ClientPassword = $clientPassword;
        $this->api->Config->TemporaryFolder = $temporaryFolder;
        $this->api->Config->BaseUrl = $baseUrl;
        $this->api->Config->DebugMode = $debug;
    }

}