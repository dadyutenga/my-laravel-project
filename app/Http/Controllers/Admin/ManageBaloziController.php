<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageBaloziController extends Controller
{
    public function manage()
    {
        return view('admin.balozi.manage');
    }
}