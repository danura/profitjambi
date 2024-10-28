<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BodyPricesController extends Controller
{
    public function index(){
        return view('admin.bodypaint.index');
    }

    public function listdata(Request $request){
        $limit = $request->input('length');
        $start = $request->input('start');

        $posts = DB::table('master_body_price');

        $counter =  $posts->count();
        $posts = $posts->orderBy('master_body_price.bp_id','DESC');
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
				
   
				$start++;

                
                $nestedData['DT_RowIndex'] = $start;
                $nestedData['item'] = $post->bp_name;
                $nestedData['price'] =  number_format($post->bp_price,0,",",".");
                
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
