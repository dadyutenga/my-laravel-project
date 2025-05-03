<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mwenyekiti;
use App\Models\MwenyekitiAuth;
use Illuminate\Http\Request;
use SalimMbise\TanzaniaRegions\TanzaniaRegions;

class MwenyekitiController extends Controller
{
    public function create()
    {
        $tanzaniaRegions = new TanzaniaRegions();
        $regions = $tanzaniaRegions->getRegions();
        return view('Admin.mwenyekiti.create', compact('regions'));
    }

    public function manage(Request $request)
    {
        $mwenyekiti = Mwenyekiti::with('auth')->get();
        $mode = $request->query('mode', 'list');
        $id = $request->query('id', null);
        $selectedMwenyekiti = $id ? Mwenyekiti::with('auth')->findOrFail($id) : null;

        return view('admin.mwenyekiti.manage', compact('mwenyekiti', 'mode', 'selectedMwenyekiti'));
    }

    public function createAccount(Request $request)
    {
        $id = $request->query('id', null);
        $mwenyekiti = null;
        if ($id) {
            $mwenyekiti = Mwenyekiti::find($id);
            if (!$mwenyekiti) {
                return redirect()->route('admin.mwenyekiti.createAccount')
                    ->with('error', 'Mwenyekiti not found. Please select a valid Mwenyekiti.');
            }
        }
        return view('Admin.mwenyekiti.manageAcc', compact('mwenyekiti'));
    }

    public function manageAccounts(Request $request)
    {
        $mwenyekiti = Mwenyekiti::with('auth')->get();
        return view('Admin.mwenyekiti.manageAcc', compact('mwenyekiti'));
    }
}