<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $quoteCount = Quote::count();

        return view('pages.dashboard', [
            'quoteCount' => $quoteCount
        ]);
    }
}
