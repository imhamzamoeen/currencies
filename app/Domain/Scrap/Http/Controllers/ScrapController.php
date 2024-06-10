<?php

namespace App\Domain\Scrap\Http\Controllers;

use App\Domain\Scrap\Services\ScrapService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScrapController extends Controller
{
    public function getCountries(ScrapService $scrapService)
    {
        return $scrapService->getCountries();
    }
}
