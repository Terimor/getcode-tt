<?php

namespace App\Jobs\ParseShop\Brain;

use App\Traits\ParsingQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use DOMXPath;
use App\Good;

class ParseShopGoodBrain implements ShouldQueue {
    use InteractsWithQueue, Queueable, SerializesModels, ParsingQueue, Dispatchable;

    public function handle() : void {
        $this->loadDocFromUrl();

        $xpath = new DOMXPath($this->document);

        $sku = null;
        $name = null;
        $brand = null;
        $categories = [];
        $images = [];

        $skuNode = $xpath->query("//div[@id='product_code']/span[@itemprop='sku']");
        Log::info(print_r($skuNode, true));
        if ($skuNode->length) {
            $sku = $skuNode[0]->textContent;
        }

        $nameNode = $xpath->query("//h1[@id='br-pr-1']");
        if ($nameNode->length) {
            $name = $nameNode[0]->textContent;
        }

        $brandNode = @$xpath->query("//span[.='Производитель']/following-sibling::span[1]");
        if ($brandNode->length) {
            $brand = $brandNode[0]->textContent;
        }

        $categoryNodes = $xpath->query("//ul[@class='br-breadcrumbs-list']/li[position() > 2 and position() < last()]/a");
        foreach ($categoryNodes as $categoryNode) {
            $categories[] = $categoryNode->textContent;
        }

        $imageNodes = $xpath->query("//div[@class='product-block-left']//img");
        foreach ($imageNodes as $imageNode) {
            $images[] = $imageNode->getAttribute('src');
        }

        Good::addOrUpdate($sku, $name, $brand, $categories, $images, $this->url);
    }
}
