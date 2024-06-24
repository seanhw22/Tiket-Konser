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
        $search ='';
        $pinned = 0;
        $checked = 0;
        $suggestions = Suggestion::orderBy('pinned', 'desc')->orderBy('checked', 'asc')->get();
        return view('suggestion.index', compact('suggestions', 'search', 'pinned', 'checked'));
    }

    public function search(Request $request){
        $search = $request->search;
        $pinned = $request->pinned;
        $checked = $request->checked;
        if ($search === '') {
            return redirect()->route('suggestionlist');
        }
        $suggestions = Suggestion::where('name', 'like', '%' . $request->search . '%')
            ->orderBy('pinned', 'desc')->orderBy('checked', 'asc')->get();
        if ($suggestions->isEmpty()) {
            return redirect()->route('suggestionlist')
                ->with('failure','Suggestion does not exist.');
        }
        return view('suggestion.index', compact('suggestions', 'search', 'pinned', 'checked'));
    }

    public function sortAsc(Request $request)
    {
        $search = $request->search;
        $pinned = $request->pinned;
        $checked = $request->checked;
        $suggestions = Suggestion::where('name', 'like', '%' . $search . '%')
            ->orderBy('name', 'asc')->orderBy('pinned', 'desc')->orderBy('checked', 'asc')
            ->get();
        return view('suggestion.index', compact('suggestions', 'search', 'pinned', 'checked'));
    }
    public function sortDesc(Request $request)
    {
        $search = $request->search;
        $pinned = $request->pinned;
        $checked = $request->checked;
        $suggestions = Suggestion::where('event_name', 'like', '%' . $search . '%')
            ->orderBy('name', 'desc')->orderBy('pinned', 'desc')->orderBy('checked', 'asc')
            ->get();
        return view('suggestion.index', compact('suggestions', 'search', 'pinned', 'checked'));
    }

    public function retrievePinned(Request $request){
        $search = $request->search;
        $pinned = $request->pinned;
        $checked = $request->checked;
        if ($pinned == 0) {
            $pinned = 1;
            if ($checked == 0) {
                $suggestions = Suggestion::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
                })
                ->where('pinned', true)->where('checked', false)->orderBy('pinned', 'desc')->orderBy('checked', 'asc')
                ->get();
            }
            else if ($checked == 1) {
                $suggestions = Suggestion::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
                })
                ->where('pinned', true)->where('checked', true)->orderBy('pinned', 'desc')->orderBy('checked', 'asc')
                ->get();
            }
        }
        else if ($pinned == 1) {
            $pinned = 0;
            if ($checked == 0) {
                $suggestions = Suggestion::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
                })
                ->where('pinned', false)->where('checked', false)->orderBy('pinned', 'desc')->orderBy('checked', 'asc')
                ->get();
            }
            else if ($checked == 1) {
                $suggestions = Suggestion::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
                })
                ->where('pinned', false)->where('checked', true)->orderBy('pinned', 'desc')->orderBy('checked', 'asc')
                ->get();
            }
        }
        return view('suggestion.index', compact('suggestions', 'search', 'pinned', 'checked'));
    }
    public function retrieveChecked(Request $request){
        $search = $request->search;
        $pinned = $request->pinned;
        $checked = $request->checked;

        if ($checked == 0) {
            $checked = 1;
            if ($pinned == 0) {
                $suggestions = Suggestion::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
                })
                ->where('checked', true)->where('pinned', false)->orderBy('pinned', 'desc')->orderBy('checked', 'asc')
                ->get();
            }
            else if ($pinned == 1) {
                $suggestions = Suggestion::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
                })
                ->where('checked', true)->where('pinned', true)->orderBy('pinned', 'desc')->orderBy('checked', 'asc')
                ->get();
            }
        }
        else if ($checked == 1) {
            $checked = 0;
            if ($pinned == 0) {
                $suggestions = Suggestion::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
                })
                ->where('checked', false)->where('pinned', false)->orderBy('pinned', 'desc')->orderBy('checked', 'asc')
                ->get();
            }
            else if ($pinned == 1) {
                $suggestions = Suggestion::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
                })
                ->where('checked', false)->where('pinned', true)->orderBy('pinned', 'desc')->orderBy('checked', 'asc')
                ->get();
            }
        }
        return view('suggestion.index', compact('suggestions', 'search', 'pinned', 'checked'));
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
