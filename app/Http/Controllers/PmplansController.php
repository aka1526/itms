<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\Fixasset;
use App\Models\Pmplans;
use App\Models\Periods;
use App\Models\Users;

class PmplansController extends Controller
{
    protected $paging = 10;

    public function index(Request $request){
        $search =isset($request->search) ? $request->search : '';
        $pm_year=isset($request->pm_year) ? $request->pm_year : Carbon::now()->format('Y');

        $dataset =Pmplans::where('pm_year','=',$pm_year)
        ->leftJoin("fixasset", "fixasset.fa_uuid", "=", "pmplans.fa_uuid")
        ->where(function($query) use ($search) {
            if ($search != '') {
                $query->where('fa_name','like', '%'.$search.'%')
                ->orWhere('fa_sec','like', '%'.$search.'%');

                return $query ;
            }
        })
        ->where(function($query) use ($pm_year) {
            if ($pm_year != '') {
                $query->where('pm_year','=', $pm_year);
                return $query ;
            }
        })
        ->orderBy('fa_sec')->orderBy('fa_name')->paginate($this->paging);
        return view('pmplans.index',compact('dataset','search','pm_year'));

    }


    public function add(Request $request){

        $Fixasset= Fixasset::where('fa_status','=','Y')->orderBy('fa_name')->get();
        $arrdataset = array();

        foreach($Fixasset AS $key => $val){
            $arrdataset[$val->fa_uuid]= $val->fa_name;
        }
        $dataset = json_encode($arrdataset);
        return view('pmplans.add',compact('dataset'));



    }

    public function new(Request $request){

        $fa_name =isset($request->fa_name) ? $request->fa_name : '';
        $pm_date =isset($request->pm_date) ? $request->pm_date : '';
        $pm_year   = Carbon::parse($pm_date)->format('Y');
        $pm_month  = Carbon::parse($pm_date)->format('n');
        $currentuser = auth()->user();

        $create_by =$currentuser->name;
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by=$currentuser->name;
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");


        $check= Fixasset::where('fa_name','=',$fa_name)->count();
        $act=0;
        if($check>0){

            $fa =Fixasset::where('fa_name','=',$fa_name)->first();
            $_uuid= str_replace('-','',Str::uuid());
             $act=  Pmplans::insert([
                'pm_uuid'       =>$_uuid
                , 'pm_date'     => $pm_date
                , 'pm_year'     =>$pm_year
                , 'pm_month'    =>$pm_month
                , 'fa_uuid'     =>$fa->fa_uuid
                , 'pm_act_date' =>null
                , 'pm_status'   =>'N'
                , 'pm_by'        =>''
                , 'create_by'   =>$create_by
                , 'create_time' =>$create_time
                , 'modify_by'   =>$modify_by
                , 'modify_time' =>$modify_time
            ]);

            return Redirect::to(route('pmplans.index'))->with('msg', $act);
        }

        return Redirect::to(route('pmplans.index'))->with('msg', $act);
    }

    public function edit(Request $request,$pm_uuid){
        $dataset= Pmplans::where('pm_uuid','=',$pm_uuid)
        ->leftJoin("fixasset", "fixasset.fa_uuid", "=", "pmplans.fa_uuid")->first();
        return view('pmplans.edit',compact('dataset'));


    }

    public function update(Request $request){
        $pm_uuid =isset($request->pm_uuid) ? $request->pm_uuid : '';

        $pm_date_new=isset($request->pm_date_new) ? $request->pm_date_new : '';
        $pm_date_new= Carbon::parse($pm_date_new)->format('Y-m-d');
        $act= Pmplans::where('pm_uuid','=',$pm_uuid)->update([
            'pm_date' => $pm_date_new
        ]);

        return Redirect::to(route('pmplans.index'))->with('msg', $act);

    }

    public function delete(Request $request){
        $pm_uuid =isset($request->uuid) ? $request->uuid : '';

        $pm_date_new=isset($request->pm_date_new) ? $request->pm_date_new : '';
        $pm_date_new= Carbon::parse($pm_date_new)->format('Y-m-d');
        $act= Pmplans::where('pm_uuid','=',$pm_uuid)->delete();
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
