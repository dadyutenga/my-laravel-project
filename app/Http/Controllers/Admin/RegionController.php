<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SalimMbise\TanzaniaRegions\TanzaniaRegions;

class RegionController extends Controller
{
    public function getDistricts($region)
    {
        $tanzaniaRegions = new TanzaniaRegions();
        $districts = $tanzaniaRegions->getDistricts($region);
        return response()->json($districts);
    }

    public function getWards($district)
    {
        $tanzaniaRegions = new TanzaniaRegions();
        $wards = $tanzaniaRegions->getWards($district);
        return response()->json($wards);
    }
}
