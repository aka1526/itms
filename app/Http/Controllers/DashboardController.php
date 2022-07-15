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

        $RepairsYear=Historys::select('repair_month')->selectRaw('count(*)Total')
        ->where('data_type','=','REPAIR')
        ->where('repair_year','=',$_year)->groupBy('repair_year')
        ->groupBy('repair_month')->get();
        $tt=12;
        $dataset= [];
        for($i = 1; $i<=$tt; $i++) {
                foreach ($RepairsYear as $key => $value) {
                    if($i==$value->repair_month){
                        $dataset[]=($value->Total);
                    } else {
                        $dataset[]=(0);
                    }

                }
           }


       //  $dataset=  json_encode($dataset,JSON_NUMERIC_CHECK);
        return view('dashboard.index', compact('dataset'));

    }
}
