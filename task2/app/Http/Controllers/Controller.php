<?php

namespace App\Http\Controllers;

use App\Jobs\ParseShop\Brain\ParseShopCategoryBrain;
use App\Jobs\ParseShop\Brain\ParseShopGoodBrain;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Good;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        return view('index');
    }

    public function submit(Request $request) {
        $link = $request->input('link');
        $link = filter_var($link, FILTER_VALIDATE_URL);

        if (!$link || !Str::startsWith($link, 'https://brain.com.ua')) {
            Session::flash('message', 'Link is not valid.');
            return redirect()->route('home');
        }

        if (strpos($link, '/category/')) {
            ParseShopCategoryBrain::dispatch($link);
        } else {
            ParseShopGoodBrain::dispatch($link);
        }

        Session::flash('message', 'Task is proccessing.');
        return redirect()->route('home');
    }

    public function goodList() {
        $goods = Good::orderBy('id', 'desc')->paginate(30);

        return view('good_list', ['goods' => $goods]);
    }

    public function goodItem(int $goodId) {
        $good = Good::find($goodId);

        return view('good_item', ['good' => $good]);
    }
}
