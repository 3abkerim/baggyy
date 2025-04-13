<?php

namespace App\Services;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class ProductScrapperService
{
    public function scrape(string $url): array
    {
        try {
            $client = new HttpBrowser(HttpClient::create());
            $crawler = $client->request('GET', $url);

            $title = $crawler->filterXPath('//meta[@property="og:title"]')->attr('content') ?? '';
            $image = $crawler->filterXPath('//meta[@property="og:image"]')->attr('content') ?? '';
            $price = $crawler->filterXPath('//meta[@property="product:price:amount"]')->attr('content') ?? null;

            return [
                'productName' => $title,
                'productImage' => $image,
                'price' => $price,
                'productUrl' => $url,
            ];
        } catch (\Throwable $e) {
            // Log the error or notify
            return [];
        }

    }

}