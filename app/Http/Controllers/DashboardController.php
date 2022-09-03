<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Fixasset;
use App\Models\Repairs;
use App\Models\Problems;
use App\Models\Historys;

class DashboardController extends Controller
{
    public function index(Request $request){
        $_year=  Carbon::now()->format('Y');

        $fas=Fixasset::select('fa_sec')->selectRaw('count(*)total')
        ->whereIn('fa_type',['NOTEBOOK','PC'])
        ->where('fa_status','=','Y')
        ->groupBy('fa_sec')->orderBy('fa_sec')->get();
        $fa_label= [];
        $fa_data= [];
        foreach ($fas as $key => $fa) {

                $fa_label[] =$fa->fa_sec;
                $fa_data[]  =$fa->total;

        }


        $RepairsYear=Historys::select('repair_month')->selectRaw('count(*)Total')
        ->where('data_type','=','REPAIR')
        ->where('repair_year','=',$_year)
        ->groupBy('repair_year')
        ->groupBy('repair_month')
        ->orderBy('repair_month')
        //->dd()
        ->get();
       
        $dataset= [];
        $tt=12;
        $i =1;
        for($i = 1; $i<=$tt; $i++) {
                // foreach ($RepairsYear as $key => $value) {
                //     if($i==$value->repair_month){
                //         $dataset[]=$value->Total;
                //     } else {
                      $dataset[]=5;
                //     }

                // }
           }

    dd($dataset);
       //  $dataset=  json_encode($dataset,JSON_NUMERIC_CHECK);
        return view('dashboard.index', compact('dataset','fa_label','fa_data'));

    }
}
