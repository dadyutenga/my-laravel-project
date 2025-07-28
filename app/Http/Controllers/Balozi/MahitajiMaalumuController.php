<?php

namespace App\Http\Controllers\Balozi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MahitajiMaalumu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MahitajiMaalumuController extends Controller
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

    // Show the form to create a new Mahitaji Maalumu record
    public function create()
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        return view('Balozi.MahitajiMaalumu.create');
    }

    // Store a new Mahitaji Maalumu record
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
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string|max:20',
            'nida_number' => 'required|string|max:20|unique:mahitaji_maalumu,nida_number',
            'disability_type' => 'required|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240', // 10MB max
        ]);

        try {
            DB::beginTransaction();
            
            // Handle PDF file upload if provided
            if ($request->hasFile('pdf_file')) {
                $file = $request->file('pdf_file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('mahitaji_maalumu_pdfs', $filename, 'public');
                $validated['pdf_file_path'] = $path;
            }
            
            $validated['created_by'] = $baloziId;
            
            MahitajiMaalumu::create($validated);
            
            DB::commit();
            
            return redirect()->route('balozi.mahitaji-maalumu.index')
                ->with('success', 'Mahitaji Maalumu record created successfully.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Delete uploaded file if database operation fails
            if (isset($validated['pdf_file_path'])) {
                Storage::disk('public')->delete($validated['pdf_file_path']);
            }
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create Mahitaji Maalumu record. Please try again.');
        }
    }

    // Show all Mahitaji Maalumu records for the logged-in Balozi
    public function index()
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $mahitajiMaalumu = MahitajiMaalumu::where('created_by', $baloziId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Balozi.MahitajiMaalumu.index', compact('mahitajiMaalumu'));
    }

    // Show the form to edit a Mahitaji Maalumu record
    public function edit($id)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $record = MahitajiMaalumu::where('created_by', $baloziId)
            ->findOrFail($id);

        return view('Balozi.MahitajiMaalumu.edit', compact('record'));
    }

    // Update a Mahitaji Maalumu record
    public function update(Request $request, $id)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $record = MahitajiMaalumu::where('created_by', $baloziId)
            ->findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string|max:20',
            'nida_number' => 'required|string|max:20|unique:mahitaji_maalumu,nida_number,' . $id,
            'disability_type' => 'required|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240', // 10MB max
        ]);

        try {
            DB::beginTransaction();
            
            $oldPdfPath = $record->pdf_file_path;
            
            // Handle PDF file upload if provided
            if ($request->hasFile('pdf_file')) {
                $file = $request->file('pdf_file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('mahitaji_maalumu_pdfs', $filename, 'public');
                $validated['pdf_file_path'] = $path;
                
                // Delete old file if it exists
                if ($oldPdfPath) {
                    Storage::disk('public')->delete($oldPdfPath);
                }
            }
            
            $record->update($validated);
            
            DB::commit();
            
            return redirect()->route('balozi.mahitaji-maalumu.index')
                ->with('success', 'Mahitaji Maalumu record updated successfully.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Delete uploaded file if database operation fails
            if (isset($validated['pdf_file_path'])) {
                Storage::disk('public')->delete($validated['pdf_file_path']);
            }
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update Mahitaji Maalumu record. Please try again.');
        }
    }

    // Delete a Mahitaji Maalumu record
    public function destroy($id)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        try {
            DB::beginTransaction();
            
            $record = MahitajiMaalumu::where('created_by', $baloziId)
                ->findOrFail($id);
            
            $pdfPath = $record->pdf_file_path;
            
            $record->delete();
            
            // Delete associated PDF file if it exists
            if ($pdfPath) {
                Storage::disk('public')->delete($pdfPath);
            }
            
            DB::commit();
            
            return redirect()->route('balozi.mahitaji-maalumu.index')
                ->with('success', 'Mahitaji Maalumu record deleted successfully.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to delete Mahitaji Maalumu record. Please try again.');
        }
    }

    // Download PDF file
    public function downloadPdf($id)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $record = MahitajiMaalumu::where('created_by', $baloziId)
            ->findOrFail($id);

        if (!$record->pdf_file_path || !Storage::disk('public')->exists($record->pdf_file_path)) {
            return redirect()->back()->with('error', 'PDF file not found.');
        }

        return Storage::disk('public')->download($record->pdf_file_path);
    }
}