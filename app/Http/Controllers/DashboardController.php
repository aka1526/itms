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
       
        $year= isset($request->year) ? $request->year :  Carbon::now()->format('Y');

        $ComputerTotal=0;
        $RepairsTotal=0;
        $fas=Fixasset::select('fa_sec')->selectRaw('count(*)total')
        ->whereIn('fa_type',['NOTEBOOK','PC'])
        ->where('fa_status','=','Y')
        ->groupBy('fa_sec')->orderBy('fa_sec')->get();
        $fa_label= [];
        $fa_data= [];
        foreach ($fas as $key => $fa) {

                $fa_label[] =$fa->fa_sec;
                $fa_data[]  =$fa->total;
                $ComputerTotal=$ComputerTotal+$fa->total;

        }

        $RepairsYear=Historys::select('repair_month')->selectRaw('count(*)Total')
        ->where('data_type','=','REPAIR')
        ->where('repair_year','=',$year)
        ->groupBy('repair_year')
        ->groupBy('repair_month')
        ->orderBy('repair_month')
        //->dd()
        ->get();

        $dataset= [];
        $datasetRe= [];

        foreach ($RepairsYear as $key => $value) {
            $datasetRe[$value->repair_month]=$value->Total ;
            $RepairsTotal=$RepairsTotal+$value->Total;
        }
        $tt=12;
        for($i = 1; $i<=$tt; $i++) {
         $dataset[]= isset($datasetRe[$i]) ? $datasetRe[$i] : 0;
        }


       //  $dataset=  json_encode($dataset,JSON_NUMERIC_CHECK);
        return view('dashboard.index', compact('year','dataset','fa_label','fa_data','RepairsTotal','ComputerTotal'));

    }
}
