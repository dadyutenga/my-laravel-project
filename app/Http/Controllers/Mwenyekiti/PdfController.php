<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\Udhamini;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function generateUdhaminiPdf($id)
    {
        $mwenyekitiId = session('mwenyekiti_id');
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }
        
        $udhamini = Udhamini::with('watu', 'createdBy')
            ->where('created_by', $mwenyekitiId)
            ->findOrFail($id);

        // Convert image to base64 for PDF if it exists
        $imageData = null;
        if ($udhamini->picha && Storage::disk('public')->exists($udhamini->picha)) {
            $imagePath = storage_path('app/public/' . $udhamini->picha);
            if (file_exists($imagePath)) {
                $imageData = base64_encode(file_get_contents($imagePath));
                $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                $udhamini->imageDataUri = 'data:image/' . $imageType . ';base64,' . $imageData;
            }
        }

        // Configure PDF options
        $pdf = Pdf::loadView('pdf.udhamini', compact('udhamini'))
                  ->setPaper('a4', 'portrait')
                  ->setOptions([
                      'isHtml5ParserEnabled' => true,
                      'isPhpEnabled' => true,
                      'defaultFont' => 'DejaVu Sans'
                  ]);
        
        $filename = 'udhamini_' . str_replace(' ', '_', $udhamini->watu->first_name) . '_' . str_replace(' ', '_', $udhamini->watu->last_name) . '_' . date('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }
}