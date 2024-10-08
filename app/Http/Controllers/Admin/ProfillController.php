<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProfillController extends Controller
{
    public function index(){
        return view('admin.profill.index');
    }

    public function storedata(Request $request){
        $post  = DB::table('users')->where('id',$request->idusers)->update([
            'name'              => $request->namausaha,
            'email'             => $request->emailusaha,
            'customer_address'  => $request->alamatlengkap,
            'customer_hp'       => $request->notelpon,
            'customer_pic_hp'   => $request->nohppic,
            'customer_pic'      => $request->namapic,
        ]);

        echo json_encode("200");
    }
}
