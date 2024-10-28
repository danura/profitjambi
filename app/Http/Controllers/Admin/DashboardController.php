<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;


class DashboardController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $customer_id = auth()->user()->customer_id;
        $nextMonth = today()->addMonth();

        $banners =  DB::table('fleet_banner')->where('b_active','0')->get();

        $units =  DB::table('fleet_vehicle')->where('fu_customer_id', $customer_id)->count();
        $services =  DB::table('fleet_vehicle')
            ->whereDate('fu_tgl_next_service', '<=', Carbon::today())
            ->where('fu_customer_id', $customer_id)->count();

        $stnk =  DB::table('fleet_vehicle')
            ->whereDate('fu_tgl_stnk', '<=', Carbon::today())
            ->where('fu_customer_id', $customer_id)->count();

        $insurance =  DB::table('fleet_vehicle')
            ->whereDate('fu_insurance_active', '<=', Carbon::today())
            ->where('fu_customer_id', $customer_id)->count();

        return view('admin.dashboard.index', compact('banners', 'units', 'services', 'stnk', 'insurance'));
    }

    public function getDataBannerID($id){
        $banners =  DB::table('fleet_banner')->where('b_id',$id)->first();
        return response()->json($banners);
    }

    public function ViewDetailUnitID($id){
        #####
        $vehicle = new Vehicle;
        $data = $vehicle->getvehicleByNorangka($norangka);
        return response()->json( $data);
    }

    public function calendarEvents(Request $request)
    {
        $customer_id = auth()->user()->customer_id;
        $posts = vehicle::leftJoin('fleet_customer','fleet_vehicle.fu_customer_id','=','fleet_customer.cust_id')
            ->select(
                array(
                    'fleet_vehicle.*' , 
                    'fleet_customer.cust_name', 
                    DB::raw("TIMESTAMPDIFF(YEAR, fleet_vehicle.fu_tgl_bp, CURDATE()) AS usiaunit"),
                    DB::raw('DATE_FORMAT(fleet_vehicle.fu_tgl_next_service, "%Y-%m-%d") as next_service'),
                )
        );
        $posts = $posts->where('fleet_vehicle.fu_customer_id',$customer_id)->where('fleet_vehicle.fu_active', '<>', '1');
        $posts = $posts->orderBy('fleet_vehicle.fu_tgl_next_service','ASC')->get();
        
        
        $data_cst = array();
        $currdate = date("Y-m-d");
        $now  =  date('Y-m-d');
        foreach($posts as $r){
            $colour = 'orange';
            $data =  array(
                'id'        => $r->fu_no_rangka,
                'title'     => $r->fu_no_pol." [".$r->fu_model."]",
                'start'     => $r->next_service,
                'end'       => $r->next_service,
                'color'     => $colour
            );
            array_push($data_cst, $data);
        }
        return response()->json($data_cst);
    }

}