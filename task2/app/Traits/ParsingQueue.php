<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait ParsingQueue {
    private $document;
    private $url;
    public $tries = 3;

    public function __construct($url) {
        $this->url = $url;
    }

    private function loadDocFromUrl() : void {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpCode !== 200) {
            Log::error("Request to url({$this->url}) has.");
        }

        $doc = new \DOMDocument();
        $res = @$doc->loadHTML($html);

        if (!$res) {
            Log::error("Page requested via url({$this->url}) is invalid.");
            $this->release();
            die;
        }

        $this->document = $doc;
    }
}
