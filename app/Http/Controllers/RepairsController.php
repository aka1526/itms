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

use Phattarachai\LineNotify\Facade\Line;

class RepairsController extends Controller
{
    protected $paging = 10;

    public function online(Request $request,$uuid){

        $data =Fixasset::where('fa_uuid','=',$uuid)->first();
        $fa_tel  =$data->fa_tel;
        $group= $data->fa_type;
        if( $group=="PC" ||  $group=="NOTEBOOK"){
            $problems =Problems::where('group','=','COMPUTER')->orderBy('problem_name')->get();
        } else {
            $problems =Problems::where('group','!=','COMPUTER')->orderBy('problem_name')->get();
        }

        if($data){

            Line::send("\n".'เครื่องคอม ::'.$data->fa_name ."\n".'กำลังแจ้งซ่อม '."\n".'เบอร์โทร:'. $fa_tel );
            return view('repairs.online',compact('data','problems'));
        }

        $data['title'] = '404';
        $data['name'] = 'Page not found';
        return response()->view('errors.404',compact('data'),404);

    }

    public function add(Request $request,$uuid){

        $data =Fixasset::where('fa_uuid','=',$uuid)->first();
        $group= $data->fa_type;
        if( $group=="PC" ||  $group=="NOTEBOOK"){
            $problems =Problems::where('group','=','COMPUTER')->orderBy('problem_name')->get();
        } else {
            $problems =Problems::where('group','!=','COMPUTER')->orderBy('problem_name')->get();
        }

        if($data){
            return view('repairs.add',compact('data','problems'));
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

        $problems =Problems::where('problem_uuid','=',$problem_uuid)->first();
        $problems_code =$problems->problem_code;

        $fa =Fixasset::where('fa_uuid','=',$fa_uuid)->first();
        $fa_tel  =$fa->fa_tel;
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
                ,'problems_code' =>$problems_code
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
                Line::send("\n".'เครื่องคอม : '.$fa_name."\n".' แจ้งซ่อมอาการ: '.$repair_problem ."\n".' ระดับความเร่งด่วน : '.$repair_priority ."\n".' Tel:'. $fa_tel);
        } else {
            $icon="error";
            $title="เกิดข้อผิลพลาด";
        }
     return response()->json([ 'act' => $act,'icon'=> $icon,'title'=>$title,'fa_uuid'=>$fa_uuid],200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }

    public function index(Request $request){
        $search=isset($request->search) ? $request->search : '';
        $dataset =Repairs::where('repair_docno','!=','')
        ->where(function($query) use ($search) {
            if ($search != '') {
                $query->where('repair_docno','like', '%'.$search.'%')
                ->orwhere('repair_problem','like', '%'.$search.'%')
                 ->orwhere('fa_name','like', '%'.$search.'%');
                return $query;
            }
        })
        ->orderBy('repair_docno','desc')->paginate($this->paging);
        return view('repairs.index',compact('dataset','search'));

    }



   public function recjob(Request $request){
        $search=isset($request->search) ? $request->search : '';
        $uuid=isset($request->uuid) ? $request->uuid : '';
        $act=false;
        $count =Repairs::where('repair_uuid','=',$uuid)
            ->where('repair_status','!=','NEW')->count();
    if( $count>0){
        $act=true;
        $msg = "คุณรับงานนี้แล้ว";
        $icon = "info";
        return response()->json(['act' => $act,'icon'=>$icon, 'msg' => $msg], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

        if( $uuid!=''){

            $act =Repairs::where('repair_uuid','=',$uuid)
            ->where('repair_status','=','NEW')->update([
                'repair_status'=>'WORKING'
                ,'repair_checkby' =>'เอกชัย'
            ]);

        }

        if ($act) {
            $msg = "สำเสร็จ";
            $icon = "success";
        } else {
            $msg = "เกิดข้อผิดพลาด";
            $icon = "error";
        }

        return response()->json(['act' => $act,'icon'=>$icon, 'msg' => $msg], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }

    public function deletejob(Request $request){
        $search=isset($request->search) ? $request->search : '';
        $uuid=isset($request->uuid) ? $request->uuid : '';
        $act=false;
        $count =Repairs::where('repair_uuid','=',$uuid)
        ->where('repair_status','=','DONE')->count();
    if( $count>0){
        $act=true;
        $msg = "คุณปิดงานนี้แล้ว";
        $icon = "info";
        return response()->json(['act' => $act,'icon'=>$icon, 'msg' => $msg], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }


        if( $uuid!=''){

            $act =Repairs::where('repair_uuid','=',$uuid)
            ->where('repair_status','!=','DONE')->delete();

        }

        if ($act) {
            $msg = "สำเสร็จ";
            $icon = "success";
        } else {
            $msg = "เกิดข้อผิดพลาด";
            $icon = "error";
        }

        return response()->json(['act' => $act,'icon'=>$icon, 'msg' => $msg], 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }

    public function editjob(Request $request){

        $search=isset($request->search) ? $request->search : '';
        $uuid=isset($request->uuid) ? $request->uuid : '';
        $data =Repairs::where('repair_uuid','=',$uuid)->first();

        $problems =Problems::where('group','!=','')->orderBy('problem_name')->get();



        return view('repairs.edit',compact('data','search','problems'));
    }

    public function updatejob(Request $request){

            $repair_uuid =isset($request->repair_uuid)?$request->repair_uuid :'';
            $repair_cause =isset($request->repair_cause)?$request->repair_cause :'';
            $repair_solution =isset($request->repair_solution)?$request->repair_solution :'';
            $repair_costs =isset($request->repair_costs)?$request->repair_costs :0;
            $repair_status =isset($request->repair_status)?$request->repair_status :'';
            $repair_checkby =isset($request->repair_checkby)?$request->repair_checkby :'';

            $create_by ='admin';
            $create_time =Carbon::now()->format("Y-m-d H:i:s");
            $modify_by='admin';
            $modify_time=Carbon::now()->format("Y-m-d H:i:s");

        if($repair_uuid){
            $act =Repairs::where('repair_uuid','=',$repair_uuid)->update([
                'repair_cause' =>$repair_cause
                ,'repair_solution' =>$repair_solution
                ,'repair_costs' =>$repair_costs
                ,'repair_status' =>$repair_status
                ,'repair_checkby' =>$repair_checkby
                ,'modify_by' =>$modify_by
                ,'modify_time' =>$modify_time

            ]);

            if($repair_status=='DONE'){
                Repairs::where('repair_uuid','=',$repair_uuid)->update([
                    'date_close' =>Carbon::now()->format("Y-m-d")
                ]);

                $dt =Repairs::where('repair_uuid','=',$repair_uuid)->first();
                $_uuid= str_replace('-','',Str::uuid());

                Historys::insert([
                    'uuid' =>$_uuid
                    , 'ref_docno'=>$dt->repair_docno
                    , 'ref_uuid' =>$dt->repair_uuid
                    , 'ref_date'=>$dt->repair_date
                    , 'repair_year'=>$dt->repair_year
                    , 'repair_month'=>$dt->repair_month
                    , 'fa_uuid'=>$dt->fa_uuid
                    , 'fa_name'=>$dt->fa_name
                    , 'fa_user'=>$dt->repair_user
                    , 'checkby'=>$dt->repair_checkby
                    , 'data_type'=>'REPAIR'
                    , 'data_problem'=>$dt->repair_problem
                    , 'data_cause'=>$dt->repair_cause
                    , 'data_solution'=>$dt->repair_solution
                    , 'data_costs'=>$dt->repair_costs
                    , 'create_by'=>$create_by
                    , 'create_time'=>$create_time
                    , 'modify_by'=>$modify_by
                    , 'modify_time'=>$modify_time
                ]);
            }

            return Redirect::to(route('re.index'))->with('msg', $act);

        }


    }



}
