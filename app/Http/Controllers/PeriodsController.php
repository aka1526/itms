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
use App\Models\Periods;

class PeriodsController extends Controller
{
    protected $paging = 10;

    public function index(Request $request){
        $search =isset($request->search) ? $request->search : '';
        $dataset =Periods::where('periods_uuid','!=','')
        ->where(function($query) use ($search) {
            if ($search != '') {
                return $query->where('periods_name','like', '%'.$search.'%');
            }
        })
        ->orderBy('periods_name')->paginate($this->paging);
        return view('periods.index',compact('dataset','search'));

    }

    public function add(Request $request){
        return view('periods.add');

    }

    public function save(Request $request){


        $periods_interval= isset($request->periods_interval)  ? $request->periods_interval  : 0;
        $periods_name= isset($request->periods_name)  ? $request->periods_name  : '';

        $problems_status='Y';

        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");
        $periods_uuid= str_replace('-','',Str::uuid());
        $act = Periods::insert([
            'periods_uuid' => $periods_uuid
            ,'periods_name'=> $periods_name
            ,'periods_interval'=> $periods_interval

           ,'create_by'=> $create_by
           ,'create_time'=> $create_time
           ,'modify_by'=> $modify_by
           ,'modify_time'=> $modify_time
        ]);

        return Redirect::to(route('pe.index'))->with('msg', $act);
      //  $dataset =Fixasset::where('fa_status','!=','')->orderBy('fa_sec')->orderBy('fa_name')->paginate($this->paging);
      //  return view('fixasset.index',compact('dataset'));

    }

    public function edit(Request $request,$uuid){

        $dataset =Periods::where('periods_uuid','=',$uuid)->first();
         return view('periods.edit',compact('dataset'));

    }

    public function update(Request $request){

        $periods_uuid = isset($request->periods_uuid )  ? $request->periods_uuid  : '';
        $periods_interval= isset($request->periods_interval)  ? $request->periods_interval  : 0;
        $periods_name= isset($request->periods_name)  ? $request->periods_name  : '';


        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");

        $act = Periods::where('periods_uuid','=',$periods_uuid)->update([

            'periods_interval'=> $periods_interval
            ,'periods_name'=> $periods_name


           ,'modify_by'=> $modify_by
           ,'modify_time'=> $modify_time
        ]);


        return Redirect::to(route('pe.index'))->with('msg', $act);

    }


    public function delete(Request $request){

        $uuid= isset($request->uuid)  ? $request->uuid : '';
        $act=false;
        try {
            $act = Periods::where('periods_uuid','=',$uuid)->delete();
        } catch (\Exception$e) {
            DB::rollback();
            // something went wrong
        }

        if ($act) {
            $msg = "ลบสำเสร็จ";
            $result = "success";
        } else {
            $msg = "เกิดข้อผิดพลาด";
            $result = "error";
        }

        return response()->json(['result' => $result, 'msg' => $msg], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);


    }



}
