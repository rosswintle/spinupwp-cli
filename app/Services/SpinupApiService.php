<?php

namespace App\Services;

use DeliciousBrains\SpinupWp\Resources\ResourceCollection;
use DeliciousBrains\SpinupWp\SpinupWp;

class SpinupApiService {

    protected string $apiBase = 'https://api.spinupwp.app/v1/';

    private ?string $token = null;

    private ?SpinupWp $api = null;

    public function __construct() {
        $this->token = env('API_TOKEN');

        $this->api = new SpinupWp($this->token);
    }

    public function listServers() : ResourceCollection
    {
        return $this->api->servers->list();
    }

    public function listSites() : ResourceCollection
    {
        return $this->api->sites->list();
    }

}
