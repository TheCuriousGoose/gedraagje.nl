<?php

namespace App\Http\Controllers;

use App\Models\BehaveYourSelfCount;
use Illuminate\Http\Request;

class BehaveYourselfController extends Controller
{
    public function store()
    {
        BehaveYourSelfCount::create([
            'user_id' => auth()->user()->id
        ]);

        return back()->with('success', 'Successfully added one to the counter');
    }
}
