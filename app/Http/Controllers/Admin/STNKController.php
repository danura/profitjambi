<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class STNKController extends Controller
{
    public function index(){
        return view('admin.stnk.index');
    }

    public function listexpire(){
        $customer_id = auth()->user()->customer_id;
        $stnk =  DB::table('fleet_vehicle')
            ->whereDate('fu_tgl_stnk', '<=', Carbon::today())
            ->where('fu_customer_id', $customer_id)->get();
        return response()->json($stnk);
    }
}
