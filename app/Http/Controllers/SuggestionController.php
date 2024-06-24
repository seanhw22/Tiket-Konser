<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function index()
    {
        $suggestions = Suggestion::orderBy('pinned', 'desc')->orderBy('checked', 'asc')->get();
        return view('suggestion.index', compact('suggestions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        Suggestion::create($request->all());
        return redirect()->route('index')
            ->with('success', 'Pesan anda telah terkirim. Terima kasih.');
    }

    public function showDetails($id){
        $suggestion = Suggestion::find($id);
        return view('suggestion.details', compact('suggestion'));
    }

    public function pinSuggestion($id)
    {
        $suggestion = Suggestion::find($id);
        $suggestion->pinned = true;
        $suggestion->save();
        return redirect()->route('suggestionlist')
            ->with('success', 'Suggestion pinned successfully');
    }

    public function checkSuggestion($id)
    {
        $suggestion = Suggestion::find($id);
        $suggestion->checked = true;
        $suggestion->save();
        return redirect()->route('suggestionlist')
            ->with('success', 'Suggestion checked successfully');
    }

    public function unpinSuggestion($id){
        $suggestion = Suggestion::find($id);
        $suggestion->pinned = false;
        $suggestion->save();
        return redirect()->route('suggestionlist')
            ->with('success', 'Suggestion unpinned successfully');
    }

    public function uncheckSuggestion($id){
        $suggestion = Suggestion::find($id);
        $suggestion->checked = false;
        $suggestion->save();
        return redirect()->route('suggestionlist')
            ->with('success', 'Suggestion unchecked successfully');
    }
    public function destroy($id)
    {
        $suggestion = Suggestion::find($id);
        $suggestion->delete();
        return redirect()->route('suggestionlist')
            ->with('success', 'Suggestion deleted successfully');
    }
}
