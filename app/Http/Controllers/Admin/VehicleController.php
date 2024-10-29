<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use DB;


class VehicleController extends Controller
{
    public function index()
    {
        return view('admin.unit.index');
    }

    public function CountOffmonth($datein){
        $monthsSubscribed = 0;
        if(!empty($datein)){
            $subscriptionStartDate = Carbon::parse($datein);
            $currentDate = Carbon::now();
            $monthsSubscribed = $subscriptionStartDate->diffInMonths($currentDate);
        }
        return $monthsSubscribed; 
    }

    public function storedata(Request $request){
        if($request->buyonat=='1'){
            $list  =  json_decode($this->getDataUnitRankAPi($request->norangka));
            if(!empty($list->modelid)){
                $addunitapi = array(
                    'fu_customer_id'        => auth()->user()->customer_id,
                    'fu_no_rangka'          => $request->norangka,
                    'fu_no_pol'             => $list->nopol,
                    'fu_model'              => $list->modelid,
                    'fu_type'               => $list->type,
                    'fu_color'              => $list->warnaindo,
                    'fu_tgl_spk'            => $list->tanggalspk,
                    'fu_tgl_bp'             => $list->tglfaktur,
                    'fu_tgl_bpkb'           => $list->tglbpkb,
                    'fu_tgl_stnk'           => $list->tglstnk,
                );
                DB::table('fleet_vehicle')->insert($addunitapi);
                $responses = '200';
            }else{
                $responses = '404';
            }
        }else{
            $addmanual = array(
                'fu_customer_id'        => auth()->user()->customer_id,
                'fu_no_rangka'          => $request->othnorangka,
                'fu_no_pol'             => $request->othnopol,
                'fu_model'              => $request->othmodel,
                'fu_type'               => $request->othtype,
                'fu_color'              => $request->othwarna,
            );
            DB::table('fleet_vehicle')->insert($addmanual);
            $responses = '201';
        }

        echo json_encode($responses);
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
                    DB::raw("TIMESTAMPDIFF(YEAR, fleet_vehicle.fu_tgl_bp, CURDATE()) AS usiaunit"),
                )
        );

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
            $stnkdate = "";
            $lastservices = "";
            $insurances = "";
            $bgstnk = 'secondary';
            $bgservice = 'secondary';
            $bginsurances = 'secondary';
            foreach ($posts as $post)
            {
				$btnView = '<a class="btn btn-primary btn-sm" type="button" onclick="getDetailUnit('.$post->fu_id.')"><i class="fas fa-eye"></i> Detail</button>';
                //$btnDel = '<a class="btn btn-danger btn-sm" type="button" onclick="hapusUnit('.$post->fu_id.')"><i class="fas fa-trash"></i> Hapus</button>';
				///.'&nbsp;'.$btnDel
                
				$start++;
                if($post->usiaunit >= 3) {
                    $usiaunit = "<span class='badge bg-danger w-100'>".$post->fu_tgl_bp."<br>".$post->usiaunit." Tahun</span>";
                } else {
                    $usiaunit = "<span class='badge bg-secondary w-100'>".$post->fu_tgl_bp."</span>";
                }

                $stnkdate  =  $this->CountOffmonth($post->fu_tgl_stnk);

                if($stnkdate >= -1) $bgstnk = 'danger';
                else $bgstnk = 'success';

                $lastservices  =  $this->CountOffmonth($post->fu_tgl_next_service);

                if($lastservices > 0) $bgservice = 'danger';
                else $bgservice = 'success';

                $insurances  =  $this->CountOffmonth($post->fu_insurance_active);

                if($insurances >= -1) $bginsurances = 'danger';
                else $bginsurances = 'success';
                

                $nestedData['DT_RowIndex'] = $start;
                $nestedData['norangka'] = '<a href="#" id="getDataCustId" data-id="'.$post->fu_no_rangka.'">'.$post->fu_no_rangka.'
                <br><span class="badge bg-dark w-100">'.$post->fu_no_pol.'</span></a>';
                $nestedData['model'] = '<a href="#" id="getDataCustId" data-id="'.$post->fu_no_rangka.'">'.$post->fu_model." - ".$post->fu_type."</a>";
                $nestedData['warna'] = "<code>".$post->fu_color."</code>";
                $nestedData['tglbeli'] =  $usiaunit;
                $nestedData['tgllast'] = "<span class='badge bg-".$bgservice." w-100'>".$post->fu_tgl_last_service."</span>";
                $nestedData['tglstnk'] = "<span class='badge bg-".$bgstnk." w-100'>".$post->fu_tgl_stnk."</span>";
                $nestedData['tglinsurance'] = "<span class='badge bg-".$bginsurances." w-100'>".$post->fu_insurance_active."</span>";
				$nestedData['action'] = $btnView;
                $nestedData['client'] =  $post->fu_client;
                ///client
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

    public function editdata($norangka){
        $vehicle = new Vehicle;
        $data = $vehicle->getvehicleByNorangka($norangka);
        return response()->json( $data);
    }

    public function updatedata(Request $request){
        $post  = DB::table('fleet_vehicle')->where('fu_id', $request->fu_id)->update([
            'fu_no_rangka'            => $request->fu_no_rangka,
            'fu_no_pol'               => $request->fu_no_pol,
            'fu_model'                => $request->fu_model,
            'fu_type'                 => $request->fu_type,
            'fu_color'                => $request->fu_color,
            'fu_tgl_bp'               => $request->fu_tgl_bp,
            'fu_tgl_stnk'             => $request->fu_tgl_stnk,
            'fu_tgl_bpkb'             => $request->fu_tgl_bpkb,
            'fu_tgl_last_service'     => $request->fu_tgl_last_service,
            'fu_tgl_next_service'     => $request->fu_tgl_next_service,
            'fu_client'               => $request->fu_client,
            'fu_client_note'          => $request->fu_client_note,
        ]);


        echo json_encode('200');
    }

    public function getDataModelHaving(){
        $customer_id = auth()->user()->customer_id;
        $query = DB::table('fleet_vehicle')
        ->where('fu_customer_id', '=', $customer_id)
        ->orderBy('fu_model', 'ASC');
        $query = $query->groupBy('fu_model');
        $query = $query->pluck("fu_model","fu_model");
        return response()->json( $query);
    }

    public function getDataTypeByModel($model = null){
        $customer_id = auth()->user()->customer_id;
        $query = DB::table('fleet_vehicle')
        ->where('fu_customer_id', '=', $customer_id)
        ->orderBy('fu_type', 'ASC');
        if (strlen($model) > 0) {
            $query = $query->where('fu_model', '=',$model);
        }
        $query = $query->groupBy('fu_type');
        $query = $query->pluck("fu_type","fu_type");
        return response()->json( $query);
    }

    public function TestDataAPiUnit(){
        $list = '';
        $posts = vehicle::leftJoin('fleet_customer','fleet_vehicle.fu_customer_id','=','fleet_customer.cust_id')
            ->select(
                array(
                    'fleet_vehicle.*' , 
                    'fleet_customer.cust_name'
                )
        );
        $posts = $posts->get();
        foreach ($posts as $post)
        {
            $list  =  json_decode($this->getDataUnitRankAPi($post->fu_no_rangka));
            if(!empty($list->modelid)){
                $post_er = DB::table('fleet_vehicle')->where('fu_no_rangka', $post->fu_no_rangka)->update([
                    'fu_model'      => $list->modelid,
                    'fu_type'       => $list->type,
                    'fu_color'      => $list->warnaindo,
                    'fu_tgl_bp'     => $list->tglfaktur,
                    'fu_tgl_bpkb'   => $list->tglbpkb,
                    'fu_no_pol'     => $list->nopol, 
                    'fu_tgl_spk'    => $list->tanggalspk
                ]);

            }
        }

    }

    private function getDataUnitRankAPi($norank){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://202.77.105.101:1003/centralapi/index.php/agass/HistoryService/getDataUnit/'.$norank,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
	
	private function getDataHistoryServiceAll($norangka){
        $url = 'http://202.77.105.101:1003/centralapi/index.php/agass/HistoryService/GetHistoryService';
		$data["norangka"] = $norangka;
		$postdata  = http_build_query($data);
		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);
		$context  = stream_context_create($opts);
		$result = json_decode(file_get_contents($url, false, $context));
		return $result;
    }
	
	private function getDataHistoryServicePaging($norangka,$limit,$start){
        $url = 'http://202.77.105.101:1003/centralapi/index.php/agass/HistoryService/GetHistoryServicePaging';
		$data["norangka"] = $norangka;
		$data["limit"] = $limit;
		$data["start"] = $start;
		$postdata  = http_build_query($data);
		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);
		$context  = stream_context_create($opts);
		$result = json_decode(file_get_contents($url, false, $context));
		return $result;
    }
	
	//detail unit//
	function detaildata($fu_id){
		$row = vehicle::selectRaw("fleet_vehicle.*, TIMESTAMPDIFF(YEAR, fleet_vehicle.fu_tgl_bp, CURDATE()) AS usiaunit")
							->where("fu_id", $fu_id)
							->first();
		return view("admin.unit.detail", ["row"=>$row]);
	}
	
	function listHistService(Request $request){
		$norangka = $request->norangka;
		$limit = $request->input('length');
        $start = $request->input('start');
		
		$list = $this->getDataHistoryServiceAll($norangka);
		$totalData = count($list);
		
		$posts = $this->getDataHistoryServicePaging($norangka,$limit,$start);
		$resultData = array();
		foreach($posts as $row){
			$start++;
			
			$nestedData["no"] = $start;
			$nestedData["police_no"] = $row->POLICE_NO;
			$nestedData["repair_type"] = $row->REPAIR_TYPE;
			$nestedData["repair_date"] = $row->REPAIR_DATE;
			
			$resultData[] = $nestedData;
		}
		
		$json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalData), 
                    "data"            => $resultData   
                    );
		return response()->json($json_data);	
	}
	
	function hapusdata(Request $request){
		 $post  = DB::table('fleet_vehicle')->where('fu_id', $request->fu_id)->update([
            'fu_active' => '1', //penanda kalo datanya dihapus..
        ]);


        echo json_encode('200');
	}


    public function listAppraise(Request $request){
        $limit = $request->input('length');
        $start = $request->input('start');

        $posts =  DB::table('master_price');
        $posts = $posts->where('master_price.mp_model',$request->input('modelid'));
        

        $counter =  $posts->count();
        $posts = $posts->orderBy('master_price.mp_id','ASC');
        $posts = $posts->offset($start);
        $posts = $posts->limit($limit);
        $posts = $posts->get();

        $totalFiltered =   $counter;

        $data = array();
        if(!empty($posts))
        {

            foreach ($posts as $post)
            {
				
                
				$start++;
 
                $nestedData['DT_RowIndex'] = $start;
                $nestedData['model'] = $post->mp_model;
                $nestedData['type'] = $post->mp_type;
                $nestedData['year'] = $post->mp_year;
                $nestedData['price'] = number_format($post->mp_price,0,",",".");
               
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
