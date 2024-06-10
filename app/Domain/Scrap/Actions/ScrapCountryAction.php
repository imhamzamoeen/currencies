<?php

namespace App\Domain\Scrap\Actions;

use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ScrapCountryAction
{
    const SCRAP_URL = 'https://www.exchangerates.org.uk/US-Dollar-USD-currency-table.html';

    public static function handle(Client $client): void
    {
        $header = [];
        $rows = [];
        $updatedAt = now()->toDateTimeString();

        $crawler = $client->request('GET', self::SCRAP_URL);

        $crawler->filter('.currencypage-mini')->each(function ($node) use (&$rows, &$updatedAt) {
            $node->filter('tr')->each(function ($node) use (&$rows, &$updatedAt) {
                $row = [];

                $node->filter('td')->each(function ($node) use (&$row, &$updatedAt) {
                    $text = $node->text();

                    if (Str::contains($text, 'updated', true)) {
                        try {
                            $trimmedText = Str::replace('updated: ', '', $text, false);
                            $updatedAt = Carbon::parse($trimmedText)->toDateTimeString();

                            dd($updatedAt);
                        } catch (\Exception $e) {
                            dd($e->getMessage());
                        }
                    }

                    if (filled($text)) {
                        $row[] = $node->text();
                    }
                });

                if (count($row) == 7) {
                    $rows[] = $row;
                }
            });
        });

        $header = Arr::pull($rows, 0);

        dd($header, $rows);
    }
}
