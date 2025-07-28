<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\Watu;
use App\Models\Balozi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WatuFetchController extends Controller
{
    protected function getMwenyekitiId()
    {
        $mwenyekitiId = session('mwenyekiti_id');
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }
        
        return $mwenyekitiId;
    }

    public function index(Request $request)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if ($mwenyekitiId instanceof \Illuminate\Http\RedirectResponse) {
            return $mwenyekitiId;
        }

        // Get all Balozi under this Mwenyekiti
        $balozis = Balozi::where('mwenyekiti_id', $mwenyekitiId)
            ->select('id', 'first_name', 'last_name', 'phone')
            ->withCount('watu')
            ->orderBy('first_name')
            ->get();

        // Get selected Balozi ID from request
        $selectedBaloziId = $request->get('balozi_id');
        
        // Initialize variables
        $watu = collect();
        $selectedBalozi = null;
        $stats = [
            'total_people' => 0,
            'males' => 0,
            'females' => 0,
            'children' => 0,
            'adults' => 0,
            'seniors' => 0
        ];

        // If Balozi is selected, get their people
        if ($selectedBaloziId) {
            $selectedBalozi = Balozi::where('id', $selectedBaloziId)
                ->where('mwenyekiti_id', $mwenyekitiId)
                ->first();

            if ($selectedBalozi) {
                $query = Watu::where('created_by', $selectedBaloziId)
                    ->with(['balozi:id,first_name,last_name']);

                // Apply search filter if provided
                if ($request->filled('search')) {
                    $search = $request->get('search');
                    $query->where(function($q) use ($search) {
                        // Search by name (first, middle, last)
                        $q->where('first_name', 'like', "%{$search}%")
                          ->orWhere('last_name', 'like', "%{$search}%")
                          ->orWhere('middle_name', 'like', "%{$search}%")
                          // Search by national ID
                          ->orWhere('national_id', 'like', "%{$search}%")
                          // Search by phone number
                          ->orWhere('phone', 'like', "%{$search}%")
                          // Search by email
                          ->orWhere('email', 'like', "%{$search}%")
                          // Search by location
                          ->orWhere('mtaa', 'like', "%{$search}%")
                          ->orWhere('shina', 'like', "%{$search}%")
                          ->orWhere('street_village', 'like', "%{$search}%")
                          // Combined name search (full name)
                          ->orWhereRaw("CONCAT(first_name, ' ', COALESCE(middle_name, ''), ' ', last_name) LIKE ?", ["%{$search}%"])
                          // Search for partial NIDA numbers
                          ->orWhereRaw("REPLACE(national_id, '-', '') LIKE ?", ["%{$search}%"]);
                    });
                }

                // Apply gender filter
                if ($request->filled('gender')) {
                    $query->where('gender', $request->get('gender'));
                }

                // Apply age filter
                if ($request->filled('age_group')) {
                    $ageGroup = $request->get('age_group');
                    switch ($ageGroup) {
                        case 'children':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) < 18');
                            break;
                        case 'adults':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 18 AND 59');
                            break;
                        case 'seniors':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 60');
                            break;
                    }
                }

                $watu = $query->orderBy('created_at', 'desc')->paginate(20);

                // Calculate statistics
                $allWatu = Watu::where('created_by', $selectedBaloziId)->get();
                $stats = [
                    'total_people' => $allWatu->count(),
                    'males' => $allWatu->where('gender', 'male')->count(),
                    'females' => $allWatu->where('gender', 'female')->count(),
                    'children' => $allWatu->filter(function($person) {
                        return $person->date_of_birth && 
                               \Carbon\Carbon::parse($person->date_of_birth)->age < 18;
                    })->count(),
                    'adults' => $allWatu->filter(function($person) {
                        $age = $person->date_of_birth ? \Carbon\Carbon::parse($person->date_of_birth)->age : 0;
                        return $age >= 18 && $age < 60;
                    })->count(),
                    'seniors' => $allWatu->filter(function($person) {
                        return $person->date_of_birth && 
                               \Carbon\Carbon::parse($person->date_of_birth)->age >= 60;
                    })->count(),
                ];
            }
        }

        return view('Mwenyekiti.Watu.index', compact(
            'balozis', 
            'watu', 
            'selectedBalozi', 
            'selectedBaloziId', 
            'stats'
        ));
    }

    public function show($id)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if ($mwenyekitiId instanceof \Illuminate\Http\RedirectResponse) {
            return $mwenyekitiId;
        }

        // Get the person, but only if they were registered by a Balozi under this Mwenyekiti
        $mtu = Watu::whereHas('balozi', function($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        })
        ->with(['balozi:id,first_name,last_name,phone'])
        ->findOrFail($id);

        return view('Mwenyekiti.Watu.show', compact('mtu'));
    }

    public function export(Request $request)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if ($mwenyekitiId instanceof \Illuminate\Http\RedirectResponse) {
            return $mwenyekitiId;
        }

        $selectedBaloziId = $request->get('balozi_id');
        
        if (!$selectedBaloziId) {
            return redirect()->back()->with('error', 'Chagua Balozi kwanza');
        }

        // Verify Balozi belongs to this Mwenyekiti
        $balozi = Balozi::where('id', $selectedBaloziId)
            ->where('mwenyekiti_id', $mwenyekitiId)
            ->first();

        if (!$balozi) {
            return redirect()->back()->with('error', 'Balozi hajapatikana');
        }

        // Build query with same filters as index method
        $query = Watu::where('created_by', $selectedBaloziId)
            ->with('balozi:id,first_name,last_name');

        // Apply search filter if provided
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('middle_name', 'like', "%{$search}%")
                  ->orWhere('national_id', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mtaa', 'like', "%{$search}%")
                  ->orWhere('shina', 'like', "%{$search}%")
                  ->orWhere('street_village', 'like', "%{$search}%")
                  ->orWhereRaw("CONCAT(first_name, ' ', COALESCE(middle_name, ''), ' ', last_name) LIKE ?", ["%{$search}%"])
                  ->orWhereRaw("REPLACE(national_id, '-', '') LIKE ?", ["%{$search}%"]);
            });
        }

        // Apply gender filter
        if ($request->filled('gender')) {
            $query->where('gender', $request->get('gender'));
        }

        // Apply age filter
        if ($request->filled('age_group')) {
            $ageGroup = $request->get('age_group');
            switch ($ageGroup) {
                case 'children':
                    $query->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) < 18');
                    break;
                case 'adults':
                    $query->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 18 AND 59');
                    break;
                case 'seniors':
                    $query->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 60');
                    break;
            }
        }

        $watu = $query->get();

        // Generate filename with search info
        $filename = "watu_" . $balozi->first_name . "_" . $balozi->last_name;
        if ($request->filled('search')) {
            $filename .= "_search_" . str_replace(' ', '_', $request->get('search'));
        }
        $filename .= "_" . date('Y-m-d') . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($watu) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'ID',
                'Jina la Kwanza',
                'Jina la Kati', 
                'Jina la Mwisho',
                'Jinsia',
                'Tarehe ya Kuzaliwa',
                'Umri',
                'Kitambulisho',
                'Simu',
                'Mtaa',
                'Shina',
                'Namba ya Shina',
                'Balozi',
                'Tarehe ya Usajili'
            ]);

            foreach ($watu as $mtu) {
                $age = $mtu->date_of_birth ? \Carbon\Carbon::parse($mtu->date_of_birth)->age : '';
                
                fputcsv($file, [
                    $mtu->id,
                    $mtu->first_name,
                    $mtu->middle_name,
                    $mtu->last_name,
                    $mtu->gender === 'male' ? 'Mume' : ($mtu->gender === 'female' ? 'Mke' : $mtu->gender),
                    $mtu->date_of_birth,
                    $age,
                    $mtu->national_id,
                    $mtu->phone,
                    $mtu->mtaa,
                    $mtu->shina,
                    $mtu->shina_number,
                    $mtu->balozi ? $mtu->balozi->first_name . ' ' . $mtu->balozi->last_name : '',
                    $mtu->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}