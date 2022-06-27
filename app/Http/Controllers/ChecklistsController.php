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
use App\Models\Checklists;

class ChecklistsController extends Controller
{
    protected $paging = 10;

    public function index(Request $request){
        $search =isset($request->search) ? $request->search : '';
        $dataset =Checklists::where('ch_uuid','!=','')
        ->where(function($query) use ($search) {
            if ($search != '') {
                return $query->where('ch_desc','like', '%'.$search.'%');
            }
        })
        ->orderBy('ch_item')->paginate($this->paging);
        return view('checklists.index',compact('dataset','search'));

    }

    public function add(Request $request){
            $item=Checklists::max('ch_item')+1;
        return view('checklists.add',compact('item'));

    }

    public function save(Request $request){

        $ch_item= isset($request->ch_item)  ? $request->ch_item  : 1;
        $ch_desc= isset($request->ch_desc)  ? $request->ch_desc  : '';
        $ch_method= isset($request->ch_method)  ? $request->ch_method  : '';
        $ch_std= isset($request->ch_std)  ? $request->ch_std  : '';

        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");
        $ch_uuid= str_replace('-','',Str::uuid());
        $act = Checklists::insert([
            'ch_uuid'=> $ch_uuid
            , 'ch_item'=> $ch_item
            , 'ch_desc'=> $ch_desc
            , 'ch_method'=> $ch_method
            , 'ch_std'=> $ch_std
           ,'create_by'=> $create_by
           ,'create_time'=> $create_time
           ,'modify_by'=> $modify_by
           ,'modify_time'=> $modify_time
        ]);

        return Redirect::to(route('ch.index'))->with('msg', $act);
      //  $dataset =Fixasset::where('fa_status','!=','')->orderBy('fa_sec')->orderBy('fa_name')->paginate($this->paging);
      //  return view('fixasset.index',compact('dataset'));

    }

    public function edit(Request $request,$uuid){

        $dataset =Checklists::where('ch_uuid','=',$uuid)->first();
         return view('checklists.edit',compact('dataset'));

    }

    public function update(Request $request){

        $ch_uuid = isset($request->ch_uuid )  ? $request->ch_uuid  : '';
        $ch_item= isset($request->ch_item)  ? $request->ch_item  : 1;
        $ch_desc= isset($request->ch_desc)  ? $request->ch_desc  : '';
        $ch_method= isset($request->ch_method)  ? $request->ch_method  : '';
        $ch_std= isset($request->ch_std)  ? $request->ch_std  : '';
        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");

        $act = Checklists::where('ch_uuid','=',$ch_uuid)->update([
             'ch_item'=> $ch_item
            , 'ch_desc'=> $ch_desc
            , 'ch_method'=> $ch_method
            , 'ch_std'=> $ch_std

           ,'modify_by'=> $modify_by
           ,'modify_time'=> $modify_time
        ]);


        return Redirect::to(route('ch.index'))->with('msg', $act);

    }


    public function delete(Request $request){

        $uuid= isset($request->uuid)  ? $request->uuid : '';
        $act=false;
        try {
            $act = Checklists::where('ch_uuid','=',$uuid)->delete();
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
