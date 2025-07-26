<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\Udhamini;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generateUdhaminiPdf($id)
    {
        $mwenyekitiId = session('mwenyekiti_id');
        
        $udhamini = Udhamini::with('watu', 'createdBy')
            ->where('created_by', $mwenyekitiId)
            ->findOrFail($id);

        $pdf = Pdf::loadView('pdf.udhamini', compact('udhamini'));
        
        $filename = 'udhamini_' . $udhamini->watu->first_name . '_' . $udhamini->watu->last_name . '.pdf';
        
        return $pdf->download($filename);
    }
}