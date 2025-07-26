<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\Udhamini;
use App\Models\Watu;
use App\Models\Mwenyekiti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UdhaminiController extends Controller
{
    protected function getMwenyekitiId()
    {
        $mwenyekitiId = session('mwenyekiti_id');
        if (!$mwenyekitiId && Auth::check()) {
            $mwenyekitiId = Auth::user()->mwenyekiti_id;
        }
        
        if (!$mwenyekitiId) {
            return redirect()->route('login')->with('error', 'Unauthorized. Please login again.');
        }
        
        return $mwenyekitiId;
    }

    public function index()
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        if ($mwenyekitiId instanceof \Illuminate\Http\RedirectResponse) {
            return $mwenyekitiId;
        }

        $udhaminiList = Udhamini::with('watu', 'createdBy')
            ->where('created_by', $mwenyekitiId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('Mwenyekiti.Udhamini.index', compact('udhaminiList'));
    }

    public function create()
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        if ($mwenyekitiId instanceof \Illuminate\Http\RedirectResponse) {
            return $mwenyekitiId;
        }

        $watuList = Watu::where('is_active', true)
            ->orderBy('first_name')
            ->get();

        return view('Mwenyekiti.Udhamini.create', compact('watuList'));
    }

    public function store(Request $request)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        if ($mwenyekitiId instanceof \Illuminate\Http\RedirectResponse) {
            return $mwenyekitiId;
        }

        $request->validate([
            'watu_id' => 'required|exists:watu,id',
            'sababu' => 'required|string',
            'muelekeo' => 'required|string',
            'tarehe' => 'required|date',
            'picha' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pichaPath = null;
        if ($request->hasFile('picha')) {
            $pichaPath = $request->file('picha')->store('udhamini', 'public');
        }

        $udhamini = Udhamini::create([
            'watu_id' => $request->watu_id,
            'sababu' => $request->sababu,
            'muelekeo' => $request->muelekeo,
            'tarehe' => $request->tarehe,
            'picha' => $pichaPath,
            'created_by' => $mwenyekitiId,
        ]);

        return redirect()->route('mwenyekiti.udhamini.show', $udhamini->id)
            ->with('success', 'Udhamini created successfully!');
    }

    public function show($id)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        if ($mwenyekitiId instanceof \Illuminate\Http\RedirectResponse) {
            return $mwenyekitiId;
        }

        $udhamini = Udhamini::with('watu', 'createdBy')
            ->where('created_by', $mwenyekitiId)
            ->findOrFail($id);

        return view('Mwenyekiti.Udhamini.show', compact('udhamini'));
    }

    public function print($id)
    {
        // Redirect to PDF generation
        return app(PdfController::class)->generateUdhaminiPdf($id);
    }
}