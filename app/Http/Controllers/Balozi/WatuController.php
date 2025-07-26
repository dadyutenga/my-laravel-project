<?php

namespace App\Http\Controllers\Balozi;

use App\Http\Controllers\Controller;
use App\Models\Watu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatuController extends Controller
{
    public function __construct()
    {
        // Middleware to ensure only authenticated Balozi can access these routes
        $this->middleware('auth.balozi');
    }

    public function index()
    {
        // Get the ID of the currently logged-in Balozi from session or Auth
        $baloziId = session('balozi_id');
        if (!$baloziId && Auth::check()) {
            $baloziId = Auth::user()->balozi_id;
        }
        
        if (!$baloziId) {
            return redirect()->route('login')->with('error', 'Unauthorized. Please login again.');
        }
        
        // Only fetch Watu entries created by this Balozi
        $watuEntries = Watu::with('balozi')
            ->where('created_by', $baloziId)
            ->latest()
            ->paginate(10);
            
        return view('Balozi.Watu.ViewWatu', compact('watuEntries'));
    }

    public function create()
    {
        return view('Balozi.Watu.CreateWatu');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'nullable|email|unique:watu,email',
                'phone_number' => 'required|string|max:20',
                'date_of_birth' => 'nullable|date',
                'gender' => 'nullable|string|in:male,female,other',
                'marital_status' => 'nullable|string',
                'occupation' => 'nullable|string|max:255',
                'education_level' => 'nullable|string|max:255',
                'income_range' => 'nullable|string|max:255',
                'health_status' => 'nullable|string|max:255',
                'nida_number' => 'nullable|string|max:50|unique:watu,nida_number',
                'house_no' => 'nullable|string|max:50',
                'mtaa' => 'nullable|string|max:255',
                'region' => 'nullable|string|max:255',
                'district' => 'nullable|string|max:255',
                'ward' => 'nullable|string|max:255',
                'household_count' => 'nullable|integer|min:0',
            ]);

            // Get the ID of the currently logged-in Balozi from session or Auth
            $baloziId = session('balozi_id');
            if (!$baloziId && Auth::check()) {
                $baloziId = Auth::user()->balozi_id;
            }

            if (!$baloziId) {
                throw new \Exception('Unauthorized. Balozi ID not found. Please login again.');
            }

            $watu = new Watu($validated);
            $watu->balozi_id = $baloziId;
            $watu->created_by = $baloziId;
            $watu->is_active = true;
            $watu->save();

            return redirect()->route('balozi.watu.index')->with('success', 'Watu entry created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error creating Watu entry: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        // Get the ID of the currently logged-in Balozi from session or Auth
        $baloziId = session('balozi_id');
        if (!$baloziId && Auth::check()) {
            $baloziId = Auth::user()->balozi_id;
        }
        
        if (!$baloziId) {
            return redirect()->route('login')->with('error', 'Unauthorized. Please login again.');
        }
        
        // Only allow viewing of Watu entries created by this Balozi
        $watu = Watu::with('balozi')
            ->where('created_by', $baloziId)
            ->findOrFail($id);
            
        return view('Balozi.Watu.show', compact('watu'));
    }

    public function edit($id)
    {
        // Get the ID of the currently logged-in Balozi from session or Auth
        $baloziId = session('balozi_id');
        if (!$baloziId && Auth::check()) {
            $baloziId = Auth::user()->balozi_id;
        }
        
        if (!$baloziId) {
            return redirect()->route('login')->with('error', 'Unauthorized. Please login again.');
        }
        
        // Only allow editing of Watu entries created by this Balozi
        $watu = Watu::where('created_by', $baloziId)->findOrFail($id);
        
        return view('Balozi.Watu.EditWatu', compact('watu'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Get the ID of the currently logged-in Balozi from session or Auth
            $baloziId = session('balozi_id');
            if (!$baloziId && Auth::check()) {
                $baloziId = Auth::user()->balozi_id;
            }
            
            if (!$baloziId) {
                return redirect()->route('login')->with('error', 'Unauthorized. Please login again.');
            }
            
            // Only allow updating of Watu entries created by this Balozi
            $watu = Watu::where('created_by', $baloziId)->findOrFail($id);
            
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'nullable|email|unique:watu,email,' . $id,
                'phone_number' => 'required|string|max:20',
                'date_of_birth' => 'nullable|date',
                'gender' => 'nullable|string|in:male,female,other',
                'marital_status' => 'nullable|string',
                'occupation' => 'nullable|string|max:255',
                'education_level' => 'nullable|string|max:255',
                'income_range' => 'nullable|string|max:255',
                'health_status' => 'nullable|string|max:255',
                'nida_number' => 'nullable|string|max:50|unique:watu,nida_number,' . $id,
                'house_no' => 'nullable|string|max:50',
                'mtaa' => 'nullable|string|max:255',
                'region' => 'nullable|string|max:255',
                'district' => 'nullable|string|max:255',
                'ward' => 'nullable|string|max:255',
                'household_count' => 'nullable|integer|min:0',
            ]);

            $watu->update($validated);

            return redirect()->route('balozi.watu.index')->with('success', 'Watu entry updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error updating Watu entry: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Get the ID of the currently logged-in Balozi from session or Auth
            $baloziId = session('balozi_id');
            if (!$baloziId && Auth::check()) {
                $baloziId = Auth::user()->balozi_id;
            }
            
            if (!$baloziId) {
                return redirect()->route('login')->with('error', 'Unauthorized. Please login again.');
            }
            
            // Only allow deletion of Watu entries created by this Balozi
            $watu = Watu::where('created_by', $baloziId)->findOrFail($id);
            $watu->delete();

            return redirect()->route('balozi.watu.index')->with('success', 'Watu entry deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting Watu entry: ' . $e->getMessage());
        }
    }
}
