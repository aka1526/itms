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
use App\Models\Pmplans;
use App\Models\Pmresults;
use App\Models\Checklists;
use App\Models\Historys;


class ActionController extends Controller
{
    protected $paging = 10;

    public function act(Request $request,$uuid){

        $data =Fixasset::where('fa_uuid','=',$uuid)->first();
        $group= $data->fa_type;
        if( $group=="PC" ||  $group=="NOTEBOOK"){
            $problems =Problems::where('group','=','COMPUTER')->orderBy('problem_name')->get();
        } else {
            $problems =Problems::where('group','!=','COMPUTER')->orderBy('problem_name')->get();
        }

        if($data){
            return view('actions.act',compact('data','problems','uuid'));
        }

        $data['title'] = '404';
        $data['name'] = 'Page not found';
        return response()->view('errors.404',compact('data'),404);

    }

    public function repaire(Request $request){

        $uuid=$request->fa_uuid;

        return Redirect::to('repairs/online/'.$uuid);


    }

    public function pm(Request $request){

        $uuid=$request->fa_uuid;
        $year=Carbon::now()->format("Y");
        $fa =Fixasset::where('fa_uuid','=',$uuid)->first();
        $pm =Pmplans::where('pm_year','=',$year)->where('fa_uuid','=',$uuid)->get();
        return view('actions.pm',compact('uuid', 'pm','fa'));


    }

    public function savepm(Request $request){

        $fa_uuid=isset($request->fa_uuid) ? $request->fa_uuid : '';
        $pm_date=isset($request->pm_plan_date) ? $request->pm_plan_date : '';

        $pm_date= Carbon::parse($pm_date )->format('Y-m-d');
        $pm_year= Carbon::parse($pm_date )->format('Y');
        $pm_month= Carbon::parse($pm_date )->format('n');

        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");
        $pm =Pmplans::where('pm_year','=',$pm_year)->where('fa_uuid','=',$fa_uuid)->count();

        if( $pm_date && $pm==0){

            $pm_uuid= str_replace('-','',Str::uuid());
            $act=  Pmplans::insert([
                'pm_uuid' =>$pm_uuid
                , 'pm_date' =>$pm_date
                , 'pm_year' =>$pm_year
                , 'pm_month' =>$pm_month
                , 'fa_uuid' =>$fa_uuid
                , 'pm_act_date' =>null
                , 'pm_status' =>'N'
                , 'create_by' =>$create_by
                , 'create_time' =>$create_time
                , 'modify_by' =>$modify_by
                , 'modify_time' =>$modify_time
            ]);
        }
        $uuid= $fa_uuid;
        $fa =Fixasset::where('fa_uuid','=',$uuid)->first();
        $pm =Pmplans::where('pm_year','=',$pm_year)->where('fa_uuid','=',$uuid)->get();
        return view('actions.pm',compact('uuid', 'pm','fa'));
    }

    public function pmplan(Request $request,$plan_uuid){

        $check = Pmresults::where('plan_uuid','=',$plan_uuid)->count();
        $plan =Pmplans::where('pm_uuid','=',$plan_uuid )->first();


         $ac_date= Carbon::now()->format('Y-m-d');
         $ac_year= Carbon::now()->format('Y');
         $ac_month= Carbon::now()->format('n');


        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");

        $fa =Fixasset::where('fa_uuid','=',$plan->fa_uuid)->first();
        $fa_uuid=   $fa->fa_uuid;
        if($check==0){

            $lists =Checklists::where('ch_desc','!=','')->get();
            foreach ($lists as $key => $list) {
                $ac_uuid= str_replace('-','',Str::uuid());
                Pmresults::insert([
                    'ac_uuid' => $ac_uuid
                    , 'ac_year' =>$ac_year
                    , 'ac_month'=>$ac_month
                    , 'ac_date'=>$ac_date
                    , 'plan_uuid'=>$plan->pm_uuid
                    , 'fa_uuid'=>$plan->fa_uuid
                    , 'fa_name'=>$fa->fa_name
                    , 'ac_item'=>$list->ch_item
                    , 'ac_desc'=>$list->ch_desc
                    , 'ac_method'=>$list->ch_method
                    , 'ac_std'=>$list->ch_std
                    , 'ac_result'=>''

                    , 'create_by'=>$create_by
                    , 'create_time'=>$create_time
                    , 'modify_by'=>$modify_by
                    , 'modify_time'=>$modify_time
                ]);
            }

        }

        $pmlist =Pmresults::where('plan_uuid','=',$plan_uuid )->orderBy('ac_item')->get();
        $uuid=$fa_uuid;

        return view('actions.pmcheck',compact('pmlist','uuid','plan_uuid'));

    }

    public function pmplansave(Request $request){

        $inputs = $request->all();
        $plan_uuid = $request->plan_uuid;
        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");
        $act=false;
        foreach($inputs as $key => $value){
            $contents = explode("_",$key);
            if($contents[0]){
                $ac_uuid=$contents[1];
                $act=  Pmresults::where('plan_uuid','=',$plan_uuid)->where('ac_uuid','=',$ac_uuid)->update([
                    'ac_result'=>$value
                    ,'modify_time'=>$modify_time
                    ,'modify_by' =>$modify_by
                ]) ;
            }

        }

        if($act){


         $newplan= Pmplans::where('pm_uuid','=',$plan_uuid)
            ->where('pm_status','!=','Y')->update([
                'pm_act_date' =>Carbon::now()->format("Y-m-d")
                ,'pm_status' =>"Y"
            ]);


            $dt =Pmplans::where('pm_uuid','=',$plan_uuid)->first();
            $fa =Fixasset::where('fa_uuid','=',$dt->fa_uuid)->first();

            if($newplan){

                $pm_interval=$fa->pm_interval>0 ? $fa->pm_interval : 12;

                $currentDateTime = Carbon::now();
                $nextDate = Carbon::now()->addMonths($pm_interval);

                 if(date('N', strtotime($nextDate)) >= 6){
                    $nextDate = $nextDate->addDays(3);
                 }

                $pm_date= $nextDate->format("Y-m-d");
                $pm_year=$nextDate->format("Y");
                $pm_month =$nextDate->format("n");
                $_uuid= str_replace('-','',Str::uuid());
                Pmplans::insert([
                    'pm_uuid' =>$_uuid
                    , 'pm_date' => $pm_date
                    , 'pm_year' =>$pm_year
                    , 'pm_month' =>$pm_month
                    , 'fa_uuid'=>$fa->fa_uuid
                    , 'pm_act_date' =>null
                    , 'pm_status' =>'N'
                    , 'create_by' =>$create_by
                    , 'create_time'=>$create_time
                    , 'modify_by'=>$modify_by
                    , 'modify_time'=>$modify_time
                ]);

                Fixasset::where('fa_uuid','=',$fa->fa_uuid)->update([
                    'pm_last_date' =>Carbon::now()
                    ,'pm_next_date'=>$pm_date
                ]);

            }



            $_uuid= str_replace('-','',Str::uuid());

            $ref_docno="PM".Carbon::parse($dt->pm_date )->format('Ymd').$fa->fa_name;
            $repair_month =Carbon::parse($dt->pm_act_date )->format('n');
            $repair_year =Carbon::parse($dt->pm_act_date )->format('Y');
            $check=Historys::where('ref_uuid','=',$dt->pm_uuid)->count();

            if($check==0){
                Historys::insert([
                    'uuid' =>$_uuid
                    , 'ref_docno'=> $ref_docno
                    , 'ref_uuid' =>$dt->pm_uuid
                    , 'ref_date'=>$dt->pm_act_date
                    , 'repair_year'=> $repair_year
                    , 'repair_month'=>$repair_month
                    , 'fa_uuid'=>$dt->fa_uuid
                    , 'fa_name'=>$fa->fa_name
                    , 'fa_user'=>$fa->fa_user
                    , 'checkby'=>$modify_by
                    , 'data_type'=>'PM'
                    , 'data_problem'=>"ตรวจเช็คตามแผน"
                    , 'data_cause'=>"ตรวจเช็คตามแผน"
                    , 'data_solution'=>"เช็คได้ตามแผน"
                    , 'data_costs'=> 0
                    , 'create_by'=>$create_by
                    , 'create_time'=>$create_time
                    , 'modify_by'=>$modify_by
                    , 'modify_time'=>$modify_time
                ]);
            }

         //  dd($repair_year);

        }



        $pm =Pmplans::where('pm_uuid','=',$plan_uuid)->first();
       return Redirect::to('/actions/act/'. $pm ->fa_uuid)->with('msg', $act);

    }

    public function pmresult(Request $request,$uuid){

        $pmlist=  Pmresults::where('plan_uuid','=',$uuid)
        ->leftJoin("fixasset", "fixasset.fa_uuid", "=", "pmresults.fa_uuid")
        ->orderBy('ac_item')->get();
        $uuid=$pmlist[0]->fa_uuid;
        $plan_uuid=$uuid;
        return view('actions.pmresult',compact('pmlist','uuid','plan_uuid'));

    }

    public function report(Request $request){
        $uuid= $request->fa_uuid;
        $fa =Fixasset::where('fa_uuid','=',$uuid)->first();
        $data =Historys::where('fa_uuid','=',$uuid)->orderBy('create_time','desc')
        ->paginate($this->paging);
        return view('actions.report',compact('data','fa'));

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

        } else {
            $icon="error";
            $title="เกิดข้อผิลพลาด";
        }
     return response()->json([ 'act' => $act,'icon'=> $icon,'title'=>$title],200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

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
            }

            return Redirect::to(route('re.index'))->with('msg', $act);

        }


    }



}
