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

class RepairsController extends Controller
{
    protected $paging = 10;

    public function online(Request $request,$uuid){

    $data =Fixasset::where('fa_uuid','=',$uuid)->first();
    $problems =Problems::where('problem_name','!=','')->orderBy('problem_name')->get();
    if($data){
        return view('repairs.online',compact('data','problems'));
    }

    $data['title'] = '404';
    $data['name'] = 'Page not found';
    return response()->view('errors.404',compact('data'),404);

    }

    public function success(Request $request){
     return view('repairs.success');

    }


    public function save_req(Request $request){

        $problem_uuid= isset($request->problem_uuid) ? $request->problem_uuid :'';
        $fa_uuid= isset($request->fa_uuid) ? $request->fa_uuid :'';
        $fa_user= isset($request->fa_user) ? $request->fa_user :'';
        $fa_name= isset($request->fa_name) ? $request->fa_name :'';
        $repair_problem = isset($request->repair_problem) ? $request->repair_problem :'';
        $repair_priority= isset($request->score) ? $request->score :'1';

        $act=false;

        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");

        if($problem_uuid!=''){
            $repair_uuid= str_replace('-','',Str::uuid());
            $repair_year =Carbon::now()->format("Y");
            $repair_month =Carbon::now()->format("n");
            $repair_date=Carbon::now()->format("Y-m-d");
            $repair_max =Repairs::where('repair_year','=',$repair_year)->where('repair_month','=',$repair_month)->max('repair_max')+1;
            $repair_docno='IT-'.$repair_year.Carbon::now()->format("m").str_pad($repair_max, 3, '0', STR_PAD_LEFT);


           $repair_type="COMPUTER";

            $act=Repairs::insert([
                'repair_uuid' =>$repair_uuid
                , 'repair_docno'=>$repair_docno
                , 'repair_date' =>$repair_date
                , 'repair_year'=>$repair_year
                , 'repair_month'=>$repair_month
                , 'repair_max'=>$repair_max
                , 'fa_uuid'=>$fa_uuid
                , 'fa_name'=>$fa_name
                , 'repair_user'=>$fa_user
                , 'repair_type'=>$repair_type
                , 'repair_problem'=>$repair_problem
                , 'problem_img'=>""
                , 'repair_cause'=>""
                , 'repair_solution'=>""
                , 'repair_checkby'=> ""
                , 'repair_costs'=> "0"
                , 'repair_status'=>"NEW"
                , 'repair_priority'=> $repair_priority
                , 'date_close'=> null
                , 'create_by'=>$create_by
                , 'create_time'=>$create_time
                , 'modify_by'=>$modify_by
                , 'modify_time'=>$modify_time
            ]);
        }

        if( $act){
                $icon="success";
                $title="บันทึกผลสำเสร็จ";

        } else {
            $icon="error";
            $title="เกิดข้อผิลพลาด";
        }
     return response()->json([ 'act' => $act,'icon'=> $icon,'title'=>$title],200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }

    // public function index(Request $request){
    //     $dataset =Fixasset::where('fa_status','!=','')->orderBy('fa_sec')->orderBy('fa_name')->paginate($this->paging);
    //     return view('fixasset.index',compact('dataset'));

    // }

    // public function add(Request $request){
    //     return view('fixasset.add');

    // }

    // public function search(Request $request){
    //    $search=$request->search;
    //     $dataset =Fixasset::where('fa_status','!=','')
    //     ->where(function($query) use ($search) {
    //         if ($search != '') {
    //             return $query->where('fa_name','like', '%'.$search.'%');
    //         }
    //     })
    //     ->orderBy('fa_sec')->orderBy('fa_name')->paginate($this->paging);
    //     return view('fixasset.index',compact('dataset','search'));

    // }

    // public function save(Request $request){

    //     $fa_name= isset($request->fa_name)  ? $request->fa_name  : '';
    //     $fa_sec= isset($request->fa_sec)  ? $request->fa_sec  : '';
    //     $fa_user= isset($request->fa_user)  ? $request->fa_user : '';
    //     $fa_tel= isset($request->fa_tel)  ? $request->fa_tel : '';
    //     $fa_email= isset($request->fa_email)  ? $request->fa_email : '';
    //     $fa_type= isset($request->fa_type)  ? $request->fa_type : '';
    //     $fa_status='Y';
    //     $create_by ='admin';
    //     $create_time =Carbon::now()->format("Y-m-d H:i:s");
    //     $modify_by='admin';
    //     $modify_time=Carbon::now()->format("Y-m-d H:i:s");
    //     $fa_uuid= str_replace('-','',Str::uuid());
    //     $act = Fixasset::insert([
    //         'fa_uuid' => $fa_uuid
    //         ,'fa_name'=> $fa_name
    //         ,'fa_sec'=> $fa_sec
    //         ,'fa_type'=> $fa_type
    //         ,'fa_user'=> $fa_user
    //         ,'fa_tel'=> $fa_tel
    //         ,'fa_email'=> $fa_email
    //         ,'fa_status'=> $fa_status
    //        ,'create_by'=> $create_by
    //        ,'create_time'=> $create_time
    //        ,'modify_by'=> $modify_by
    //        ,'modify_time'=> $modify_time
    //     ]);

    //     return Redirect::to(route('fa.index'))->with('msg', $act);
    //   //  $dataset =Fixasset::where('fa_status','!=','')->orderBy('fa_sec')->orderBy('fa_name')->paginate($this->paging);
    //   //  return view('fixasset.index',compact('dataset'));

    // }

    // public function edit(Request $request,$fa_uuid){

    //     $dataset =Fixasset::where('fa_uuid','=',$fa_uuid)->first();
    //      return view('fixasset.edit',compact('dataset'));

    // }

    // public function update(Request $request){

    //     $fa_uuid= isset($request->fa_uuid)  ? $request->fa_uuid : '';
    //     $fa_name= isset($request->fa_name)  ? $request->fa_name  : '';
    //     $fa_sec= isset($request->fa_sec)  ? $request->fa_sec  : '';
    //     $fa_user= isset($request->fa_user)  ? $request->fa_user : '';
    //     $fa_tel= isset($request->fa_tel)  ? $request->fa_tel : '';
    //     $fa_email= isset($request->fa_email)  ? $request->fa_email : '';
    //     $fa_type= isset($request->fa_type)  ? $request->fa_type : '';

    //     $fa_vender= isset($request->fa_vender)  ? $request->fa_vender : '';
    //     $fa_status= isset($request->fa_status)  ? $request->fa_status : 'N';
    //     $date_buy= isset($request->date_buy) ? Carbon::parse($request->date_buy )->format('d-m-Y') : null;

    //     $create_by ='admin';
    //     $create_time =Carbon::now()->format("Y-m-d H:i:s");
    //     $modify_by='admin';
    //     $modify_time=Carbon::now()->format("Y-m-d H:i:s");

    //     $act = Fixasset::where('fa_uuid','=',$fa_uuid)->update([

    //         'fa_name'=> $fa_name
    //         ,'fa_sec'=> $fa_sec
    //         ,'fa_type'=> $fa_type
    //         ,'fa_user'=> $fa_user
    //         ,'fa_tel'=> $fa_tel
    //         ,'fa_email'=> $fa_email
    //         ,'fa_status'=> $fa_status
    //         ,'date_buy'=> $date_buy
    //         ,'fa_vender'=> $fa_vender

    //        ,'modify_by'=> $modify_by
    //        ,'modify_time'=> $modify_time
    //     ]);


    //     return Redirect::to(route('fa.index'))->with('msg', $act);

    // }

    // public function delete(Request $request){

    //     $fa_uuid= isset($request->fa_uuid)  ? $request->fa_uuid : '';
    //     $act=false;
    //     try {
    //         $act = Fixasset::where('fa_uuid','=',$fa_uuid)->delete();
    //     } catch (\Exception$e) {
    //         DB::rollback();
    //         // something went wrong
    //     }

    //     if ($act) {
    //         $msg = "ลบสำเสร็จ";
    //         $result = "success";
    //     } else {
    //         $msg = "เกิดข้อผิดพลาด";
    //         $result = "error";
    //     }

    //     return response()->json(['result' => $result, 'msg' => $msg], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);


    // }

}
