<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class GeneralServiceController extends Controller
{
    public function index(){
        return view('admin.bengkel.index');
    }

    public function listData(Request $request){
        $customer_id = auth()->user()->customer_id;
        $limit = $request->input('length');
        $start = $request->input('start');

        $posts = vehicle::leftJoin('fleet_customer','fleet_vehicle.fu_customer_id','=','fleet_customer.cust_id')
            ->select(
                array(
                    'fleet_vehicle.*' , 
                    'fleet_customer.cust_name', 
                    DB::raw("TIMESTAMPDIFF(YEAR, fleet_vehicle.fu_tgl_bp, CURDATE()) AS usiaunit"),
                )
        );

        $posts = $posts->where('fleet_vehicle.fu_customer_id',$customer_id)
						->where('fleet_vehicle.fu_active', '<>', '1');

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
				if($post->fu_tgl_next_service < date('Y-m-d')){
					$showDate = '<span class="badge bg-danger w-100">'.$post->fu_tgl_next_service.'</span>';
				}else{
					$showDate = '<span class="badge bg-success w-100">'.$post->fu_tgl_next_service.'</span>';
				}
				
				$start++;
                $nestedData['DT_RowIndex'] = $start;
                $nestedData['norangka'] = '<a href="#" id="getDataCustId" data-id="'.$post->fu_no_rangka.'">'.$post->fu_no_rangka.'
                <br><span class="badge bg-dark w-100">'.$post->fu_no_pol.'</span></a>';
                $nestedData['model'] = '<a href="#" id="getDataCustId" data-id="'.$post->fu_no_rangka.'">'.$post->fu_model." - ".$post->fu_type.'</a>';
                $nestedData['warna'] = $post->fu_color;

                $nestedData['lastservice'] = $post->fu_tgl_last_service;
                $nestedData['nextservice'] = $showDate;
                $nestedData['action'] = '<button type="button" class="btn btn-sm btn-primary" onclick="syncData(\''.$post->fu_no_rangka.'\')"><i class="fas fa-sync"></i> Sinkron Data </button>';
                
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
	
	function proses_sinkron(Request $request){
		$norangka = $request->fu_no_rangka;
		$url = "http://202.77.105.101:1003/centralapi/index.php/agass/HistoryService/getJsonLastService?norangka=".$norangka;
		$getData = json_decode(file_get_contents($url));
		
		foreach($getData as $row){
			$nextservice = Carbon::parse($row->tgl_svc)->addMonth(6)->format('Y-m-d');
			
			DB::table("fleet_vehicle")
				->where("fu_no_rangka", $norangka)
				->update([
					'fu_tgl_last_service' => $row->tgl_svc,
					'fu_tgl_next_service' => $nextservice,
				]);
		}
		
		echo json_encode('200');
	}
	
}
