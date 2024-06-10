<?php

namespace App\Domain\Scrap\Services;

use App\Domain\Scrap\Actions\ScrapCountryAction;
use Goutte\Client;

class ScrapService
{
    public function __construct(
        protected Client $client
    ) {
    }

    public function getCountries()
    {
        return ScrapCountryAction::handle($this->client);
    }
}
