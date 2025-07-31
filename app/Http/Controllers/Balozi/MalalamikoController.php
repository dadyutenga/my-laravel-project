<?php

namespace App\Http\Controllers\Balozi;

use App\Http\Controllers\Controller;
use App\Models\Malalamiko;
use Illuminate\Http\Request;

class MalalamikoController extends Controller
{
    /**
     * Get the current Balozi's ID from session
     */
    private function getBaloziId()
    {
        return session('balozi_id'); // Changed from Auth::id() to session
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Balozi.Malalamiko.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $baloziId = $this->getBaloziId();
        
        // Check if Balozi is logged in
        if (!$baloziId) {
            return redirect()->route('balozi.login')->with('error', 'Tafadhali ingia kwanza');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'mtaa' => 'required|string|max:255',
            'jinsia' => 'required|in:male,female', // REVERTED: Back to what your form sends
            'malalamiko' => 'required|string',
        ]);

        // Add the Balozi ID and set default status
        $validated['created_by'] = $baloziId;
        $validated['status'] = 'pending'; // Default status

        Malalamiko::create($validated);

        return redirect()->route('balozi.malalamiko.index')
            ->with('success', 'Lalamiko limehifadhiwa kikamilifu');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baloziId = $this->getBaloziId();
        
        if (!$baloziId) {
            return redirect()->route('balozi.login')->with('error', 'Tafadhali ingia kwanza');
        }

        $malalamiko = Malalamiko::where('created_by', $baloziId)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('Balozi.Malalamiko.index', compact('malalamiko'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $baloziId = $this->getBaloziId();
        
        if (!$baloziId) {
            return redirect()->route('balozi.login')->with('error', 'Tafadhali ingia kwanza');
        }

        $malalamiko = Malalamiko::findOrFail($id);
        
        // Ensure the record belongs to the current Balozi
        if ($malalamiko->created_by !== $baloziId) {
            abort(403, 'Hauruhusiwi kubadilisha lalamiko hili');
        }

        return view('Balozi.Malalamiko.edit', compact('malalamiko'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $baloziId = $this->getBaloziId();
        
        if (!$baloziId) {
            return redirect()->route('balozi.login')->with('error', 'Tafadhali ingia kwanza');
        }

        $malalamiko = Malalamiko::findOrFail($id);
        
        // Ensure the record belongs to the current Balozi
        if ($malalamiko->created_by !== $baloziId) {
            abort(403, 'Hauruhusiwi kubadilisha lalamiko hili');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'mtaa' => 'required|string|max:255',
            'jinsia' => 'required|in:Me,Ke,Male,Female,M,F', // FIXED: Same here
            'malalamiko' => 'required|string',
        ]);

        $malalamiko->update($validated);

        return redirect()->route('balozi.malalamiko.index')
            ->with('success', 'Lalamiko limebadilishwa kikamilifu');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $baloziId = $this->getBaloziId();
        
        if (!$baloziId) {
            return redirect()->route('balozi.login')->with('error', 'Tafadhali ingia kwanza');
        }

        $malalamiko = Malalamiko::findOrFail($id);
        
        // Ensure the record belongs to the current Balozi
        if ($malalamiko->created_by !== $baloziId) {
            abort(403, 'Hauruhusiwi kufuta lalamiko hili');
        }

        $malalamiko->delete();

        return redirect()->route('balozi.malalamiko.index')
            ->with('success', 'Lalamiko limefutwa kikamilifu');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $baloziId = $this->getBaloziId();
        
        if (!$baloziId) {
            return redirect()->route('balozi.login')->with('error', 'Tafadhali ingia kwanza');
        }

        $malalamiko = Malalamiko::where('id', $id)
            ->where('created_by', $baloziId)
            ->firstOrFail();

        return view('Balozi.Malalamiko.show', compact('malalamiko'));
    }
}