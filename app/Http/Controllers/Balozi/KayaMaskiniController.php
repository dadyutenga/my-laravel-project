<?php

namespace App\Http\Controllers\Balozi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KayaMaskini;
use Illuminate\Support\Facades\DB;

class KayaMaskiniController extends Controller
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

    // Show the form to create a new Kaya Maskini record
    public function create()
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        return view('Balozi.KayaMaskini.create');
    }

    // Store a new Kaya Maskini record
    public function store(Request $request)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'street' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'description' => 'required|string',
            'household_count' => 'required|integer|min:1',
            'household_members' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            
            $validated['created_by'] = $baloziId;
            
            KayaMaskini::create($validated);
            
            DB::commit();
            
            return redirect()->route('balozi.kaya-maskini.index')
                ->with('success', 'Kaya Maskini record created successfully.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create Kaya Maskini record. Please try again.');
        }
    }

    // Show all Kaya Maskini records for the logged-in Balozi
    public function index()
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $kayaMaskini = KayaMaskini::where('created_by', $baloziId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Balozi.KayaMaskini.index', compact('kayaMaskini'));
    }

    // Show the form to edit a Kaya Maskini record
    public function edit($id)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $record = KayaMaskini::where('created_by', $baloziId)
            ->findOrFail($id);

        return view('Balozi.KayaMaskini.edit', compact('record'));
    }

    // Update a Kaya Maskini record
    public function update(Request $request, $id)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'street' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'description' => 'required|string',
            'household_count' => 'required|integer|min:1',
            'household_members' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            
            $record = KayaMaskini::where('created_by', $baloziId)
                ->findOrFail($id);
            
            $record->update($validated);
            
            DB::commit();
            
            return redirect()->route('balozi.kaya-maskini.index')
                ->with('success', 'Kaya Maskini record updated successfully.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update Kaya Maskini record. Please try again.');
        }
    }

    // Delete a Kaya Maskini record
    public function destroy($id)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        try {
            DB::beginTransaction();
            
            $record = KayaMaskini::where('created_by', $baloziId)
                ->findOrFail($id);
            
            $record->delete();
            
            DB::commit();
            
            return redirect()->route('balozi.kaya-maskini.index')
                ->with('success', 'Kaya Maskini record deleted successfully.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to delete Kaya Maskini record. Please try again.');
        }
    }
}