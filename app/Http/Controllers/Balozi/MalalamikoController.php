<?php 

namespace App\Http\Controllers\Balozi;


use  App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Malalamiko;
use Illuminate\Support\Facades\DB;

class MalalamikoController extends Controller
{
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


    public function create()
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        return view('Balozi.Malalamiko.create');
    }
}

?>