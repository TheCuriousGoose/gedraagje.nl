<?php

namespace App\Http\Controllers;

use App\Models\BehaveYourSelfCount;
use App\Models\Quote;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $behaveYourSelfCount = BehaveYourSelfCount::count();
        $quote = Quote::inRandomOrder()->first();

        return view('pages.home', [
            'behaveYourSelfCount' => $behaveYourSelfCount,
            'quote' => $quote
        ]);
    }
}
