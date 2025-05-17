<?php

namespace App\Http\Controllers\Balozi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MaendeleoYaSiku;

class DailyprogressController extends Controller
{
    // Get the ID of the currently logged-in Balozi from session or Auth
    protected function getBaloziId()
    {
        $baloziId = session('balozi_id');
        if (!$baloziId && Auth::check()) {
            $baloziId = Auth::user()->balozi_id;
        }
        
        if (!$baloziId) {
            return redirect()->route('login')->with('error', 'Unauthorized. Please login again.');
        }
        
        return $baloziId;
    }

    // Show the form to create a new daily progress entry
    public function create()
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        return view('Balozi.Dailyprogress.create');
    }

    // Store a new daily progress entry
    public function store(Request $request)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $validated = $request->validate([
            'tarehe' => 'required|date',
            'maelezo' => 'required|string',
            'maoni' => 'nullable|string',
        ]);

        $validated['created_by'] = $baloziId;

        MaendeleoYaSiku::create($validated);

        return redirect()->route('balozi.daily-progress.index')
            ->with('success', 'Daily progress has been saved successfully');
    }

    // Show all daily progress entries for the logged-in Balozi
    public function index()
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $dailyProgress = MaendeleoYaSiku::where('created_by', $baloziId)
            ->orderBy('tarehe', 'desc')
            ->get();

        return view('Balozi.Dailyprogress.index', compact('dailyProgress'));
    }
}
