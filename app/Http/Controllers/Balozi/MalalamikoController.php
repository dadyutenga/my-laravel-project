<?php 

namespace App\Http\Controllers\Balozi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Malalamiko;
use Illuminate\Support\Facades\DB;

class MalalamikoController extends Controller
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

    // Show the form to create a new Malalamiko record
    public function create()
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        return view('Balozi.Malalamiko.create');
    }

    // Store a new Malalamiko record
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
            'phone' => 'required|string|max:20',
            'mtaa' => 'required|string|max:255',
            'jinsia' => 'required|in:male,female',
            'malalamiko' => 'required|string',
            'status' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            
            $validated['created_by'] = $baloziId;
            
            Malalamiko::create($validated);
            
            DB::commit();
            
            return redirect()->route('balozi.malalamiko.index')
                ->with('success', 'Malalamiko record created successfully.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create Malalamiko record. Please try again.');
        }
    }

    // Show all Malalamiko records for the logged-in Balozi
    public function index()
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $malalamiko = Malalamiko::where('created_by', $baloziId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Balozi.Malalamiko.index', compact('malalamiko'));
    }

    // Show the form to edit a Malalamiko record
    public function edit($id)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $record = Malalamiko::where('created_by', $baloziId)
            ->findOrFail($id);

        return view('Balozi.Malalamiko.edit', compact('record'));
    }

    // Update a Malalamiko record
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
            'phone' => 'required|string|max:20',
            'mtaa' => 'required|string|max:255',
            'jinsia' => 'required|in:male,female',
            'malalamiko' => 'required|string',
            'status' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            
            $record = Malalamiko::where('created_by', $baloziId)
                ->findOrFail($id);
            
            $record->update($validated);
            
            DB::commit();
            
            return redirect()->route('balozi.malalamiko.index')
                ->with('success', 'Malalamiko record updated successfully.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update Malalamiko record. Please try again.');
        }
    }

    // Delete a Malalamiko record
    public function destroy($id)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        try {
            DB::beginTransaction();
            
            $record = Malalamiko::where('created_by', $baloziId)
                ->findOrFail($id);
            
            $record->delete();
            
            DB::commit();
            
            return redirect()->route('balozi.malalamiko.index')
                ->with('success', 'Malalamiko record deleted successfully.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to delete Malalamiko record. Please try again.');
        }
    }
}