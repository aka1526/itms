<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Fixasset;

class FixassetController extends Controller
{
    protected $paging = 10;

    public function index(Request $request){
        $dataset =Fixasset::where('fa_status','!=','')->orderBy('fa_sec')->orderBy('fa_name')->paginate($this->paging);
        return view('fixasset.index',compact('dataset'));

    }

    public function add(Request $request){
        return view('fixasset.add');

    }
    public function save(Request $request){

        $fa_name= isset($request->fa_name)  ? $request->fa_name  : '';
        $fa_sec= isset($request->fa_sec)  ? $request->fa_sec  : '';
        $fa_user= isset($request->fa_user)  ? $request->fa_user : '';
        $fa_tel= isset($request->fa_tel)  ? $request->fa_tel : '';
        $fa_email= isset($request->fa_email)  ? $request->fa_email : '';
        $fa_type= isset($request->fa_type)  ? $request->fa_type : '';
        $fa_status='Y';
        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");
        $fa_uuid= str_replace('-','',Str::uuid());
        $act = Fixasset::insert([
            'fa_uuid' => $fa_uuid
            ,'fa_name'=> $fa_name
            ,'fa_sec'=> $fa_sec
            ,'fa_type'=> $fa_type
            ,'fa_user'=> $fa_user
            ,'fa_tel'=> $fa_tel
            ,'fa_email'=> $fa_email
            ,'fa_status'=> $fa_status
           ,'create_by'=> $create_by
           ,'create_time'=> $create_time
           ,'modify_by'=> $modify_by
           ,'modify_time'=> $modify_time
        ]);

        return Redirect::to(route('fa.index'))->with('msg', $act);
      //  $dataset =Fixasset::where('fa_status','!=','')->orderBy('fa_sec')->orderBy('fa_name')->paginate($this->paging);
      //  return view('fixasset.index',compact('dataset'));

    }

    public function edit(Request $request,$fa_uuid){

        $dataset =Fixasset::where('fa_uuid','=',$fa_uuid)->first();
         return view('fixasset.edit',compact('dataset'));

    }

    public function update(Request $request){

        $fa_uuid= isset($request->fa_uuid)  ? $request->fa_uuid : '';
        $fa_name= isset($request->fa_name)  ? $request->fa_name  : '';
        $fa_sec= isset($request->fa_sec)  ? $request->fa_sec  : '';
        $fa_user= isset($request->fa_user)  ? $request->fa_user : '';
        $fa_tel= isset($request->fa_tel)  ? $request->fa_tel : '';
        $fa_email= isset($request->fa_email)  ? $request->fa_email : '';
        $fa_type= isset($request->fa_type)  ? $request->fa_type : '';

        $fa_vender= isset($request->fa_vender)  ? $request->fa_vender : '';
        $fa_status= isset($request->fa_status)  ? $request->fa_status : 'N';
        $date_buy= isset($request->date_buy) ? Carbon::parse($request->date_buy )->format('d-m-Y') : null;

        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");

        $act = Fixasset::where('fa_uuid','=',$fa_uuid)->update([

            'fa_name'=> $fa_name
            ,'fa_sec'=> $fa_sec
            ,'fa_type'=> $fa_type
            ,'fa_user'=> $fa_user
            ,'fa_tel'=> $fa_tel
            ,'fa_email'=> $fa_email
            ,'fa_status'=> $fa_status
            ,'date_buy'=> $date_buy
            ,'fa_vender'=> $fa_vender

           ,'modify_by'=> $modify_by
           ,'modify_time'=> $modify_time
        ]);


        return Redirect::to(route('fa.index'))->with('msg', $act);

    }

    public function delete(Request $request){

        $fa_uuid= isset($request->fa_uuid)  ? $request->fa_uuid : '';
        $act=false;
        try {
            $act = Fixasset::where('fa_uuid','=',$fa_uuid)->delete();
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
