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

class ProblemsController extends Controller
{
    protected $paging = 10;

    public function index(Request $request){
        $search =isset($request->search) ? $request->search : '';
        $dataset =Problems::where('problem_uuid','!=','')
        ->where(function($query) use ($search) {
            if ($search != '') {
                return $query->where('problem_name','like', '%'.$search.'%');
            }
        })
        ->orderBy('group')->orderBy('problem_name')->paginate($this->paging);
        return view('problems.index',compact('dataset','search'));

    }

    public function add(Request $request){
        return view('problems.add');

    }

    public function save(Request $request){



        $problem_code= isset($request->problem_code)  ? $request->problem_code  : '';
        $problem_name= isset($request->problem_name)  ? $request->problem_name  : '';
        $group= isset($request->group)  ? $request->group : 'COMPUTER';
        $problems_status='Y';

        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");
        $problem_uuid= str_replace('-','',Str::uuid());
        $act = Problems::insert([
            'problem_uuid' => $problem_uuid
            ,'problem_code'=> $problem_code
            ,'problem_name'=> $problem_name
            ,'group'=> $group
            ,'problems_status'=> $problems_status

           ,'create_by'=> $create_by
           ,'create_time'=> $create_time
           ,'modify_by'=> $modify_by
           ,'modify_time'=> $modify_time
        ]);

        return Redirect::to(route('pb.index'))->with('msg', $act);
      //  $dataset =Fixasset::where('fa_status','!=','')->orderBy('fa_sec')->orderBy('fa_name')->paginate($this->paging);
      //  return view('fixasset.index',compact('dataset'));

    }

    public function edit(Request $request,$uuid){

        $dataset =Problems::where('problem_uuid','=',$uuid)->first();
         return view('problems.edit',compact('dataset'));

    }

    public function update(Request $request){

        $problem_uuid= isset($request->problem_uuid)  ? $request->problem_uuid : '';
        $problem_code= isset($request->problem_code)  ? $request->problem_code  : '';
        $problem_name= isset($request->problem_name)  ? $request->problem_name  : '';
        $group= isset($request->group)  ? $request->group : '';
        $problems_status= isset($request->problems_status)  ? $request->problems_status : '';

        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");

        $act = Problems::where('problem_uuid','=',$problem_uuid)->update([

            'problem_code'=> $problem_code
            ,'problem_name'=> $problem_name
            ,'group'=> $group
            ,'problems_status'=> $problems_status

           ,'modify_by'=> $modify_by
           ,'modify_time'=> $modify_time
        ]);


        return Redirect::to(route('pb.index'))->with('msg', $act);

    }


    public function delete(Request $request){

        $uuid= isset($request->uuid)  ? $request->uuid : '';
        $act=false;
        try {
            $act = Problems::where('problem_uuid','=',$uuid)->delete();
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
