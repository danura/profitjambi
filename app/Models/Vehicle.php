<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;


class Vehicle extends Model
{
    use HasFactory;
    protected $table = 'fleet_vehicle';
    protected $guarded = array();

    public function getvehicleByNorangka($rangka){
         $data  = DB::table('fleet_vehicle')
            ->where('fu_no_rangka',$rangka)
            ->first();
            return $data;
    }
}
