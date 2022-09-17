<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\Fixasset;
use App\Models\Repairs;
use App\Models\Problems;
use App\Models\Pmplans;
use App\Models\Pmresults;
use App\Models\Checklists;
use App\Models\Historys;
use App\Models\Users;
use App\Models\Reqerp;
use Phattarachai\LineNotify\Facade\Line;

class ReqerpController extends Controller
{
    protected $paging = 10;


    public function index(Request $request){
        $search=isset($request->search) ? $request->search : '';
        $dataset =Reqerp::where('req_fa','!=','')
        ->where(function($query) use ($search) {
            if ($search != '') {
                $query->where('req_name','like', '%'.$search.'%')
                ->orwhere('req_title','like', '%'.$search.'%')
                 ->orwhere('req_fa','like', '%'.$search.'%');
                return $query;
            }
        })
        ->orderBy('req_no','desc')->paginate($this->paging);
        return view('reqerp.index',compact('dataset','search'));

    }

    public function add(Request $request){
        $uuid=$request->uuid;

        $fa =Fixasset::where('fa_uuid','=',$uuid)->first();

        return view('reqerp.add',compact( 'fa') );
    }

    public function save(Request $request){

        $fa_uuid=isset($request->fa_uuid) ? $request->fa_uuid : '';
        $req_title=isset($request->req_title) ? $request->req_title : '';
        $req_desc=isset($request->req_desc) ? $request->req_desc : '';
        $fa_user=isset($request->fa_user) ? $request->fa_user : '';

        $req_date= Carbon::now()->format("Y-m-d");
        $req_count= Reqerp::where('req_date','=', $req_date)->count()+1;
        $req_count=$req_count>9 ? $req_count : "0".$req_count;
        $req_no= "REQ-".Carbon::now()->format("Ymd").$req_count;
        $fa =Fixasset::where('fa_uuid','=',$fa_uuid)->first();

        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");

        $req_unid= str_replace('-','',Str::uuid());


            $act=  Reqerp::insert([
                'req_unid'=> $req_unid
                ,'req_no'=>$req_no
                ,'req_date'=> $req_date
                , 'req_fa'=> $fa_uuid
                , 'req_name'=> $fa_user
                , 'req_title'=> $req_title
                , 'req_desc'=> $req_desc
                ,'req_vote1_name'=> ""
                , 'req_vote2_name'=> ""
                , 'req_vote3_name'=> ""
                , 'req_vote4_name'=> ""
                ,'req_vote1_stat'=> ""
                , 'req_vote2_stat'=> ""
                ,'req_vote3_stat'=> ""
                , 'req_vote4_stat'=> ""
                , 'create_by' =>$create_by
                , 'create_time' =>$create_time
                , 'modify_by' =>$modify_by
                , 'modify_time' =>$modify_time
            ]);
    if($act){
        Line::send("\n".'ขอปรับปรุง ERP : '.$fa_user."\n".' วันที่: '.$req_date ."\n".' เรื่อง : '.$req_title ."\n".' รายละเอียด :'. $req_desc);

    }

       // $fa =Fixasset::where('fa_uuid','=',$fa_uuid)->first();

        // $data =Reqerp::where('req_unid','!=','')->orderBy('create_time','desc')
        // ->paginate($this->paging);
        // return view('actions.reqerp',compact('data'));

        return Redirect::to('/actions/reqerp');
    }

    public function edit(Request $request,$req_unid){

        $dataset =Reqerp::where('req_unid','=',$req_unid)->first();
        $fa =Fixasset::where('fa_uuid','=', $dataset->req_fa)->first();
         return view('reqerp.edit',compact('dataset','fa'));

    }

    public function update(Request $request){

        $req_unid= isset($request->req_unid)  ? $request->req_unid  : '';
        $fa_name= isset($request->fa_name)  ? $request->fa_name : '';
        $fa_user= isset($request->fa_user)  ? $request->fa_user : '';
        $req_title= isset($request->req_title)  ? $request->req_title : '';
        $req_desc= isset($request->req_desc)  ? $request->req_desc : '';
        $start_date= isset($request->start_date)  ? $request->start_date : null;
        $end_date= isset($request->end_date)  ? $request->end_date : null;
        $jobpercen= isset($request->jobpercen)  ? $request->jobpercen : '0';
        $req_vote_stat= isset($request->req_vote_stat)  ? $request->req_vote_stat : '';


        $create_by ='admin';
        $create_time =Carbon::now()->format("Y-m-d H:i:s");
        $modify_by='admin';
        $modify_time=Carbon::now()->format("Y-m-d H:i:s");

        $act = Reqerp::where('req_unid','=',$req_unid)->update([
            "req_name"=> $fa_user
            ,"req_title" =>$req_title
            ,"req_desc" => $req_desc
            ,"start_date" => $start_date
            ,"end_date" => $end_date
            ,"jobpercen" =>  $jobpercen
            ,"req_vote_stat" =>$req_vote_stat
            ,'modify_by'=> $modify_by
           ,'modify_time'=> $modify_time
        ]);

        return Redirect::to('/actions/reqerp')->with('msg', $act);

    }



}
