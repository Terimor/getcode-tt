<?php

namespace App\Jobs\ParseShop\Brain;

use App\Traits\ParsingQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Exception;
use DOMXPath;

class ParseShopCategoryBrain implements ShouldQueue {
    use InteractsWithQueue, Queueable, SerializesModels, ParsingQueue, Dispatchable;

    public function handle() {
        $this->loadDocFromUrl();

        $xpath = new DOMXPath($this->document);

        $goodsWrapper = $this->document->getElementById('view-grid');
        $entries = $xpath->query("//div[@class='description-wrapper']//a[@itemprop='url']", $goodsWrapper);

        foreach ($entries as $link) {
            ParseShopGoodBrain::dispatch('https://brain.com.ua' . $link->getAttribute('href'));
        }
    }
}
