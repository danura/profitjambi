<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AsuransiController extends Controller
{
    public function index(){
        return view('admin.asuransi.index');
    }


    public function listdata(Request $request){
        $customer_id = auth()->user()->customer_id;
        $limit = $request->input('length');
        $start = $request->input('start');

        $posts = vehicle::leftJoin('fleet_customer','fleet_vehicle.fu_customer_id','=','fleet_customer.cust_id')
            ->select(
                array(
                    'fleet_vehicle.*' , 
                    'fleet_customer.cust_name', 
                    DB::raw("TIMESTAMPDIFF(YEAR, fleet_vehicle.fu_insurance_active, CURDATE()) AS usiaasuransi"),
                )
        );

         $posts = $posts->whereDate('fleet_vehicle.fu_insurance_active', '<=', Carbon::today());

        $posts = $posts->where('fleet_vehicle.fu_customer_id',$customer_id)
						->where('fleet_vehicle.fu_active', '<>', '1'); //0=>ditampilkan, 1=>dihapus

        if($request->input('unitmodel')!='') {
            $posts = $posts->where('fleet_vehicle.fu_model',$request->input('unitmodel'));
        }

        if($request->input('unittype')!='') {
            $posts = $posts->where('fleet_vehicle.fu_type',$request->input('unittype'));
        }

        $counter =  $posts->count();
        $posts = $posts->orderBy('fleet_vehicle.fu_id','DESC');
        $posts = $posts->offset($start);
        $posts = $posts->limit($limit);
        $posts = $posts->get();

        $totalFiltered =   $counter;

        $data = array();
        if(!empty($posts))
        {
            $lastid = 0;
            foreach ($posts as $post)
            {
				$btnView = '<a class="btn btn-primary btn-sm" type="button" onclick="getDetailUnit('.$post->fu_id.')"><i class="fas fa-eye"></i> Detail</button>';
   
				$start++;

                if($post->usiaasuransi > 3) $usiaunit = "<span class='badge bg-danger w-100'>".$post->usiaasuransi." Tahun</span>";
                else $usiaunit = "<span class='badge bg-info w-100'>".$post->usiaasuransi." Tahun</span>";
               
                $nestedData['DT_RowIndex'] = $start;
                $nestedData['norangka'] = '<a href="#" id="getDataCustId" data-id="'.$post->fu_no_rangka.'">'.$post->fu_no_rangka.'
                <br><span class="badge bg-warning w-100">'.$post->fu_no_pol.'</span></a>';;
                $nestedData['model'] = '<a href="#" id="getDataCustId" data-id="'.$post->fu_no_rangka.'">'.$post->fu_model." - ".$post->fu_type.'</a>';
                $nestedData['warna'] = $post->fu_color;
                $nestedData['tglasuransi']  =  $post->fu_insurance_active."<br>".$usiaunit;
                $data[] = $nestedData;
            }
        }

         $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalFiltered),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
}
