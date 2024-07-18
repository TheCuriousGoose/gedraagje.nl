<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Tables\QuotesIndexTable;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotesTable = (new QuotesIndexTable)->create();

        return view('pages.quotes.index', [
            'quotesTable' => $quotesTable
        ]);
    }

    public function create()
    {
        return view('pages.quotes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'quote' => 'required|string',
            'quotee_name' => 'required|string',
        ]);

        $validated['user_id'] = auth()->user()->id;

        Quote::create($validated);

        return redirect()->route('quotes.index')->with('success', __('Successfully made the quote'));
    }

    public function edit(Quote $quote)
    {
        return view('pages.quotes.edit', [
            'quote' => $quote
        ]);
    }

    public function update(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'quote' => 'required|string',
            'quotee_name' => 'required|string',
        ]);

        $quote->update($validated);

        return redirect()->route('quotes.index')->with('success', __('Successfully updated the quote'));
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();

        return redirect()->route('quotes.index')->with('success', __('Successfully deleted the quote'));
    }

    public function ajaxSearch(Request $request)
    {
        return response()->json((new QuotesIndexTable)->ajaxSearch($request));
    }
}
