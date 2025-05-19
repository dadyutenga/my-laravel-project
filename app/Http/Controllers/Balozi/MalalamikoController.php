<?php

namespace App\Http\Controllers\Balozi;

use App\Http\Controllers\Controller;
use App\Models\Malalamiko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MalalamikoController extends Controller
{
    /**
     * Get the current Balozi's ID
     */
    private function getBaloziId()
    {
        return Auth::id();
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
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'mtaa' => 'required|string|max:255',
            'jinsia' => 'required|string|max:255',
            'malalamiko' => 'required|string',
            'status' => 'required|in:pending,resolved',
        ]);

        $validated['created_by'] = $this->getBaloziId();

        Malalamiko::create($validated);

        return redirect()->route('balozi.malalamiko.index')
            ->with('success', 'Malalamiko record created successfully');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baloziId = $this->getBaloziId();
        $malalamiko = Malalamiko::where('created_by', $baloziId)->get();
        return view('Balozi.Malalamiko.index', compact('malalamiko'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $malalamiko = Malalamiko::findOrFail($id);
        
        // Ensure the record belongs to the current user
        if ($malalamiko->created_by !== $this->getBaloziId()) {
            abort(403, 'Unauthorized action');
        }

        return view('Balozi.Malalamiko.edit', compact('malalamiko'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $malalamiko = Malalamiko::findOrFail($id);
        
        // Ensure the record belongs to the current user
        if ($malalamiko->created_by !== $this->getBaloziId()) {
            abort(403, 'Unauthorized action');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'mtaa' => 'required|string|max:255',
            'jinsia' => 'required|string|max:255',
            'malalamiko' => 'required|string',
            'status' => 'required|in:pending,resolved',
        ]);

        $malalamiko->update($validated);

        return redirect()->route('balozi.malalamiko.index')
            ->with('success', 'Malalamiko record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $malalamiko = Malalamiko::findOrFail($id);
        
        // Ensure the record belongs to the current user
        if ($malalamiko->created_by !== $this->getBaloziId()) {
            abort(403, 'Unauthorized action');
        }

        $malalamiko->delete();

        return redirect()->route('balozi.malalamiko.index')
            ->with('success', 'Malalamiko record deleted successfully');
    }
}