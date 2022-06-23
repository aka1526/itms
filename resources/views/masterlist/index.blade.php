@extends('theme.main')
@section('herder_jscss')
<!-- Bootstrap -->
<link href="/asset/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="/asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="/asset/nprogress/nprogress.css" rel="stylesheet">
<!-- iCheck -->
<link href="/asset/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- bootstrap-wysiwyg -->
<link href="/asset/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
<!-- Select2 -->
<link href="/asset/select2/dist/css/select2.min.css" rel="stylesheet">
<!-- Switchery -->
<link href="/asset/switchery/dist/switchery.min.css" rel="stylesheet">
<!-- starrr -->
<link href="/asset/starrr/dist/starrr.css" rel="stylesheet">
<!-- bootstrap-daterangepicker -->
<link href="/asset/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="/custom/css/custom.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="/asset/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/asset/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/asset/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link  href="/asset/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

@endsection

@section('page_content')
    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">
                        <div class="x_title">
                            <h2>รายการทะเบียนเอกสาร / Master List</h2>
                            <ul class="nav navbar-right panel_toolbox">
								<li>
                                    <button type="button" class="btn btn-success btn-sm"  onclick="location.href='/doctype/a/add';">
                                    <i class="fa fa-plus"></i> ขอนำเอกสารเข้าระบบใหม่</button>
                                </li>

							</ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            @if(session()->get('msg'))
                                <script>
                                    Swal.fire({
                                    title: 'บันทึกข้อมูลสำเร็จ!',
                                    timer: 1300,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                    })
                                 </script>
                              @endif

                              <div class="col-md-12">

                                <p>
                                    <form id="frmSearch" name="frmSearch" action="{{ route('masterlist.search')}}" method="POST" >
                                        @csrf

                                        <div class="col-md-2 col-sm-3 form-group ">
                                        <label for="DATE_START" class="control-label col-md-12 col-sm-12 ">SECTION</label>
                                        <div class="col-md-12 col-sm-12">
                                            <select class="form-control form-control-sm h-50" id="SEC_CODE" name="SEC_CODE"  >
                                                <option value="">-- All -- </option>
                                            @foreach ($SECTION as $key => $sec)
                                                <option value="{{ $sec->SEC_CODE}}" {{ $SEC_CODE==$sec->SEC_CODE ? ' selected' :'' }}>{{ $sec->SEC_NAME}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 form-group  ">
                                        <label class="control-label col-md-12 col-sm-12 ">DOC</label>
                                        <div class="col-md-12 col-sm-12">
                                            <select class="form-control form-control-sm h-50" id="DOC_TYPE" name="DOC_TYPE"  >
                                                <option value="">-- All -- </option>
                                            @foreach ($DOCTYPE as $key => $row)
                                                <option value="{{ $row->DOC_CODE}}" {{ $row->DOC_CODE==$DOC_TYPE ? ' selected' :''}}>{{ $row->DOC_TYPE}} {{ $row->DOC_NAME}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4   ">
                                        <label for="heard">Search</label>
                                    <div class="input-group mb-3">

                                        <input type="text" class="form-control form-control-sm" id="SEARCH" name="SEARCH" value="{{ isset($SEARCH)  ? $SEARCH : ''}}"  placeholder="Search…">
                                        <div class="input-group-append">
                                          <button  type="submit" id="bntsearch" name="bntsearch" class="btn btn-primary btn-sm" >search</button>
                                        </div>

                                    </div>
                                    </div>

                                    <div class="col-md-3 col-sm-3   ">
                                        <label for="heard">Report Rev.xx</label>
                                    <div class="input-group mb-3">
                                        <select class="form-control form-control-sm col-sm-4" id="REV_SET" name="REV_SET"  >
                                            @php
                                            $tt=$MAX_REV %10 ;
                                             @endphp
                                            @endphp
                                            @for ($i = 1; $i < ($tt); $i++)
                                            <option value="{{ $i*10}}">{{str_pad($i*10-10, 2, '0', STR_PAD_LEFT) }}-{{ $i*10}}</option>
                                            @endfor
                                            {{-- <option value="10">00-10</option>
                                            <option value="20">11-20</option>
                                            <option value="30">21-30</option>
                                            <option value="40">31-40</option> --}}


                                        </select>
                                        <div class="input-group-append">
                                          <button  type="button" class="btn btn-info btn-sm reportmasterlist " ><i class="fa fa-print"></i> Report Master List</button>
                                        </div>
                                        {{-- <button  type="button" data-setgroup="1" class="btn btn-info btn-sm reportmasterlist" ><i class="fa fa-print"></i> Report Master List(10)</button> --}}

                                    </div>
                                    </div>

                                </form>
                            </p>
                              </div>

                            <div class="table-responsive ">
                                <style>
                                        .table td, .table th {
                                            padding: 0.2rem;
                                            font-size: 10px;

                                        }

                                </style>
                                <table class="table table-bordered table-striped jambo_table bulk_action">
                                  <thead>
                                    <tr class="headings">

                                      <th class="column-title"><div style="width: 30px" >Item </div></th>

                                      <th class="column-title"><div style="width: 120px"><small class="text-right"><a href="javascript:void(0)"><i class="fa fa-plus fa-2x addatdoc" style="color: rgb(251, 250, 252)"></i></a></small>  Document  No. </div></th>
                                      <th class="column-title"><div style="width: 160px">Doc. Name / Part Name </div></th>
                                      <th class="column-title"><div style="width: 160px">Part No </div></th>
                                      <th class="column-title"><div style="width: 100px">Process </div></th>
                                      <th class="column-title text-center">Rev.</th>
                                      <th class="column-title  text-center"><div style="width: 60px">Eff. Date</div></th>
                                      <th class="column-title"><div style="width: 60px">File</div></th>
                                      <th class="column-title">Action</th>
                                      @for ($i =0; $i <= $MAX_REV; $i++)
                                      <th class="column-title"><div style="width: 40px;text-align:center;">{{ str_pad( $i , 2, '0', STR_PAD_LEFT)}} </div></th>
                                      @endfor

                                      <th class="bulk-actions" colspan="7">
                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                      </th>
                                    </tr>
                                  </thead>

                                  <tbody>

                                    @foreach ($dataset as $key => $row)

                                    <tr class="even pointer">

                                        <td class=" "> {{ $dataset->firstItem() + $key }}</td>

                                        <td class=" "><button type="button"  data-unid="{{$row->UNID}}" class="btn btn-primary btn-block btn-sm btnedit" style="font-size: 10px;">{{ $row->DOCNO}} </button>  </></td>
                                        <td class=" ">  {{ $row->PARTNAME}}</td>
                                        <td class=" ">  {{ $row->PARTNO}}</td>
                                        <td class=" ">  {{ $row->PROCESSNAME}}</td>
                                        <td class=" "> <button type="button"  data-unid="{{$row->UNID}}" class="btn btn-info btn-block btn-sm btnrev"  style="font-size: 10px;">{{ str_pad($row->LAST_REV, 2, '0', STR_PAD_LEFT)}} </button> </td>
                                        <td class=" ">  {{ isset($row->LAST_EFF_DATE) ? \Carbon\Carbon::parse($row->LAST_EFF_DATE )->format('d/m/y') : '-'}}</td>
                                        @if($row->LAST_REV_FILE !="")
                                            <?php
                                            $files = \App\Models\Uploadfile::where('UNID','=',$row->LAST_REV_FILE)->first();
                                            ?>
                                            <td class=" text-center"><a href="#" class="viewfile" data-unid="{{ $row->LAST_REV_FILE}}"> <i class="fa fa-paperclip fa-2x"></i></td>
                                        @else
                                         <td class=" text-center"> -</td>
                                        @endif


                                         <td class=" last">
                                         @if($row->DOC_STATUS=="Y")
                                            <div class="btn-group">
                                                <button type="button" data-unid="{{$row->UNID}}" class="btn btn-success dropdown-toggle btn-sm"  style="font-size: 10px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>

                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                    @foreach ($PURPOSE as $pkey => $pur)
                                                    <a title="{{ $row->DOCNO}}" class="dropdown-item" data-unid={{$row->UNID}} href="/doctype/{{  strtolower($pur->PURPOSE_CODE )}}/add?ref_unid={{$row->UNID}}">{{ $pur->PURPOSE_NAME }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                         @elseif($row->DOC_STATUS=="C")
                                            {{-- <div class="btn-group"> --}}
                                                <button type="button" data-unid="{{$row->UNID}}" class="btn btn-danger btn-block  btn-sm"  style="font-size: 10px;">
                                                    Cancel
                                                </button>

                                                {{-- <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                    @foreach ($PURPOSE as $pkey => $pur)
                                                    <a title="{{ $row->DOCNO}}" class="dropdown-item" data-unid={{$row->UNID}} href="/doctype/{{  strtolower($pur->PURPOSE_CODE )}}/add?ref_unid={{$row->UNID}}">{{ $pur->PURPOSE_NAME }}</a>
                                                    @endforeach
                                                </div> --}}
                                            {{-- </div> --}}

                                         @endif

                                        </td>

                                         @for ($i =0; $i <= $MAX_REV; $i++)
                                            <td class="text-center">
                                                @php ($revdate ="-")
                                                @php ($unid="")
                                                    @foreach ($DOCDAR as $dockey => $doc)
                                                        @if($doc->DOCNO== $row->DOCNO && (int)$i ==(int)$doc->REV)

                                                        @php ($revdate=isset($doc->EFF_DATE) ? \Carbon\Carbon::parse($doc->EFF_DATE)->format('d/m/y') : '-')
                                                        @php ($unid=$doc->DAR_UNID>0 ? $doc->DAR_UNID :'')
                                                        @endif
                                                    @endforeach

                                                    <a  title="{{ $row->DOCNO}}" href="{{route('masterlist.viewdoc',$unid)}}" onclick="centeredPopup(this.href,'myWindow','700','300','yes');return false" class="viewedit" data-unid="{{ $unid}}"> {{ $revdate }} </a>
                                            </td>
                                         @endfor

                                      </tr>


							    	@endforeach
                                      @if($dataset->count() <10)
                                        @for ($i =1; $i <= (10-$dataset->count()); $i++)
                                        <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        @for ($r =0; $r <= $MAX_REV; $r++)
                                        <td ></td>
                                        @endfor

                                        </tr>
                                        @endfor
                                      @endif
                                  </tbody>
                                </table>
                                {{ $dataset->links('pagination.default',
										[
											'paginator' => $dataset,
                                            'search' => isset($SEARCH) ? $SEARCH : '',
											'link_limit' => $dataset->perPage()
										]) }}
                              </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
<!-- Master list modal -->
    <div class="modal fade " id="modalEdit" name="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">ปรับปรุงข้อมูล Master List</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="frmEdit" name="frmEdit" data-parsley-validate="" method="POST"
                class="form-horizontal form-label-left" novalidate="" action="{{ route('masterlist.update')}}">
                 @csrf
                 <input type="hidden"   id="UNID" name="UNID" value="" >
                 <input type="hidden"   id="_SEARCH" name="_SEARCH" value="" >

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="PARTNAME">Doc. Name / Part Name :</label>
                            <input type="text" id="PARTNAME" name="PARTNAME" class="form-control" required="" >
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="PROCESSNAME">Process Name :</label>
                            <input type="text" id="PROCESSNAME" name="PROCESSNAME" class="form-control" >
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="PARTNO">Part No. :</label>
                            <input type="text" id="PARTNO" name="PARTNO" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullname">Customer:</label>
                            <input type="text" id="CUSTOMERID" name="CUSTOMERID" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="MC_TYPE">MC Type :</label>
                            <input type="text" id="MC_TYPE" name="MC_TYPE" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="DOCNO">Doc.NO. :*</label>
                            <input type="text" id="DOCNO" name="DOCNO" class="form-control"   required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="LAST_REV">Rev. No:*</label>
                            <input type="number" id="LAST_REV" min="0" max="100" name="LAST_REV" class="form-control"  required="">
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="LAST_EFF_DATE">Rev. Date:*</label>
                            <input id="LAST_EFF_DATE" name="LAST_EFF_DATE" class="date-picker form-control" placeholder="dd-mm-yyyy" type="date" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                            <script>
                                function timeFunctionLong(input) {
                                    setTimeout(function() {
                                        input.type = 'text';
                                    }, 60000);
                                }
                            </script>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <label>ประเภทเอกสาร :*</label>
                        <select class="form-control form-control-sm h-50" id="DOCTYPE" name="DOC_TYPE" required="">
                            <option value="">-- Choose -- </option>

                        </select>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <label>Section :*</label>
                        <select class="form-control form-control-sm h-50" id="SECCODE" name="SEC_CODE" required="">
                            <option value="">-- Choose -- </option>

                        </select>

                    </div>

                  </div>
                  <br/>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>
            </div>

          </div>
        </div>
      </div>

    <!-- Master list Rev -->
    <div class="modal fade " id="modalRev" name="modalRev" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Rev. List</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body ">
                <div id="data-rev"></div>
            </div>

          </div>
        </div>
      </div>
      @endsection

    @section('footer_jscss')

	<!-- FastClick -->
	<script src="/asset/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="/asset/nprogress/nprogress.js"></script>
	<!-- bootstrap-progressbar -->
	<script src="/asset/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<!-- iCheck -->
	<script src="/asset/iCheck/icheck.min.js"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="/asset/moment/min/moment.min.js"></script>
	<script src="/asset/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap-wysiwyg -->
	<script src="/asset/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
	<script src="/asset/jquery.hotkeys/jquery.hotkeys.js"></script>
	<script src="/asset/google-code-prettify/src/prettify.js"></script>
	<!-- jQuery Tags Input -->
	<script src="/asset/jquery.tagsinput/src/jquery.tagsinput.js"></script>
	<!-- Switchery -->
	<script src="/asset/switchery/dist/switchery.min.js"></script>
	<!-- Select2 -->
	<script src="/asset/select2/dist/js/select2.full.min.js"></script>
	<!-- Parsley -->
	<script src="/asset/parsleyjs/dist/parsley.min.js"></script>
	<!-- Autosize -->
	<script src="/asset/autosize/dist/autosize.min.js"></script>
	<!-- jQuery autocomplete -->
	<script src="/asset/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
	<!-- starrr -->
	<script src="/asset/starrr/dist/starrr.js"></script>
	<!-- Custom Theme Scripts -->
    <script src="/custom/js/app.js"></script>

	<script>
    $(document).ready(function() {

            init_sparklines();
            init_flot_chart();
            init_sidebar();
            init_InputMask();
            init_daterangepicker();
            init_daterangepicker_right();
            init_daterangepicker_single_call();
            init_daterangepicker_reservation();
            init_skycons();
            init_select2();
            init_PNotify();
            init_compose();
            init_CustomNotification();
            init_autosize();
            init_autocomplete();
            $('#menu_toggle').click();

            setTimeout(function(){
                $("div.alert").remove();
            }, 3000 ); // 3 secs

            });

    </script>

<script language="javascript">
    var popupWindow = null;
    function centeredPopup(url,winName,w,h,scroll){
    LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
    TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
    settings =
    'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
    popupWindow = window.open(url,winName,settings)
    }

</script>
<script language="javascript">

$(document).on("click", '.reportmasterlist', function(e) {
var unid= $(this).data('unid');
var REV_SET = $("#REV_SET").val();
var SEARCH  = $("#SEARCH").val();
var DOC_TYPE= $("#DOC_TYPE").val();
var SEC_CODE= $("#SEC_CODE").val();
var url='/masterlist/report?REV_SET='+REV_SET+'&SEARCH='+SEARCH+'&DOC_TYPE='+DOC_TYPE+'&SEC_CODE='+SEC_CODE;
var w=1200;
var h=500;
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var title='viewFile';
    newwindow=window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    if (window.focus) {newwindow.focus()}
    return false;

});


$(document).on("click", '.viewfile', function(e) {

var unid= $(this).data('unid');
var url='/upload/files/view/'+unid;
var w=800;
var h=500;
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var title='viewFile';
    newwindow=window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    if (window.focus) {newwindow.focus()}
    return false;

});


$(document).on("click", '.revnormal', function(e) {
    e.preventDefault();
    var doc_unid =$(this).data('docno_unid');
    var rev_no =$(this).data('rev');

    var url="masterrev/normalbyrev";
    var formData = new FormData();
    formData.append("DOCNO_UNID", doc_unid);
    formData.append("REV_NO", rev_no);
    formData.append("_token", $('meta[name=_token]').attr('content'));
    Swal.fire({
        title: 'ยืนยันการยกเลิกเอกสาร',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, status nomal!'
    }).then((ch) => {
        if(ch.isConfirmed) {
            $.ajax({
                    type : 'post',
                    url  : url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success:function(data){
                        $('#modalRev').modal('hide');
                            if(data){
                                Swal.fire({
                                    title:data.msg,
                                    timer: 1300,
                                    icon: data.icon,
                                    confirmButtonText: 'OK'
                                });

                            }
                    }
                })
            }
    })
});


$(document).on("click", '.revcancel', function(e) {
    e.preventDefault();
    var doc_unid =$(this).data('docno_unid');
    var rev_no =$(this).data('rev');
    var txt_remark =$("#REMARK_"+doc_unid+"_"+rev_no).val();
    var url="masterrev/canceldoc";


    var formData = new FormData();
    formData.append("DOCNO_UNID", doc_unid);
    formData.append("REV_NO", rev_no);
    formData.append("REMARK", txt_remark);
    formData.append("_token", "{{ csrf_token() }}");

    Swal.fire({
        title: 'ยืนยันการยกเลิกเอกสาร',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, status Cancel!'
    }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                        type : 'post',
                        url  : url,
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",
                        success:function(data){
                            $('#modalRev').modal('hide');
                            if(data){

                                Swal.fire({
                                    title:data.msg,
                                    timer: 1300,
                                    icon: data.icon,
                                    confirmButtonText: 'OK'
                                })


                            }


                        }
                });
            }
        });
});


$(document).on("click", '.revdel', function(e) {
    e.preventDefault();
    var doc_unid =$(this).data('docno_unid');
    var rev_no =$(this).data('rev');
    var url="masterrev/delebyrev";
    var formData = new FormData();
    formData.append("DOCNO_UNID", doc_unid);
    formData.append("REV_NO", rev_no);
    formData.append("_token", "{{ csrf_token() }}");

    Swal.fire({
  title: 'ยืนยันการลบ',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if(result.isConfirmed) {
    $.ajax({
			 type : 'post',
			 url  : url,
             data: formData,
             processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
			 success:function(data){
                $('#modalRev').modal('hide');
                if(data){

                    Swal.fire({
                        title:data.msg,
                        timer: 1300,
                        icon: data.icon,
                        confirmButtonText: 'OK'
                    })


                }


			 }
		 });
    }
    })
});

$(document).on("click", '.revedit', function(e) {
    e.preventDefault();
    var doc_unid =$(this).data('docno_unid');
    var rev_no =$(this).data('rev');
    var eff_date =$("#REV_DATE_"+doc_unid+"_"+rev_no).val();
    var remark =$("#REMARK_"+doc_unid+"_"+rev_no+"").val();
    var files = $("#fileuploads_"+doc_unid+"_"+rev_no+"")[0].files;
    var url="masterrev/addbyrev";
    var formData = new FormData();
    formData.append("DOCNO_UNID", doc_unid);
    formData.append("REV_NO", rev_no);
    formData.append("EFF_DATE", eff_date);
    formData.append("REMARK", remark);
    formData.append("_token", "{{ csrf_token() }}");
    formData.append('fileuploads', files[0]);

    $.ajax({
			 type : 'post',
			 url  : url,
             data: formData,
             processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
			 success:function(data){
                $('#modalRev').modal('hide');
                if(data){

                    Swal.fire({
                        title:data.msg,
                        timer: 1300,
                        icon: data.icon,
                        confirmButtonText: 'OK'
                    })


                }


			 }
		 });

});

$(document).on("click", '.btnrev', function(e) {
        e.preventDefault();
        var url ="/masterlist/listrev";
        var unid =$(this).data('unid');
        $.ajax({
			 type : 'post',
			 url  : url,
             data: {UNID:unid,"_token": "{{ csrf_token() }}"},
             dataType: "text",
			 success:function(data){
                // console.log(data);
                if(data){
                    $("#data-rev").html('');
                    $('#data-rev').append(data);
				    $('#modalRev').modal('show');
                }


			 }
		 });

});

    $(document).on("click", '.addatdoc', function(e) {
        e.preventDefault();
        var url ="/masterlist/getdata";
        var unid="";
        $.ajax({
            type: "get",
            url: url,
            data: {UNID:unid,"_token": "{{ csrf_token() }}"},
             dataType: "json",
            success: function(data){
            var sec=data.section;
            var doctype=data.doctype;

            var options = '';
            var opType = '';
            if(sec){
                    for(var i=0; i<sec.length; i++) {
                      options += '<option value="'+sec[i].SEC_CODE+'" >'+sec[i].SEC_NAME+'</option>';
                    }
            }

            if(doctype){
                    for(var i=0; i<doctype.length; i++) {
                        opType += '<option value="'+doctype[i].DOC_CODE+'" >'+doctype[i].DOC_NAME+'</option>';
                    }
            }

            $('#SECCODE').append(options);
            $('#DOCTYPE').append(opType);
            $("#UNID").val('');
            $("#modalEdit").modal('show');
            }

    });
    });

    $(document).on("click", '.btnedit', function(e) {
        var unid =$(this).data('unid');
        var SEARCH =$('#SEARCH').val();


        var url ="/masterlist/getdata";
        $.ajax({
            type: "get",
            url: url,
            data: {UNID:unid,"_token": "{{ csrf_token() }}"},
             dataType: "json",
            success: function(data){

                var dt=data.master[0];
                var sec=data.section;
                var doctype=data.doctype;

                var options = '';
                var opType = '';
                    if(dt){
                        if(sec){
                        for(var i=0; i<sec.length; i++) {
                            if(dt.SEC_CODE==sec[i].SEC_CODE){
                                options += '<option value="'+sec[i].SEC_CODE+'" selected>'+sec[i].SEC_NAME+'</option>';
                            } else {
                                options += '<option value="'+sec[i].SEC_CODE+'" >'+sec[i].SEC_NAME+'</option>';
                            }
                        }
                    }

                    if(doctype){
                        for(var i=0; i<doctype.length; i++) {
                            opType += '<option value="'+doctype[i].DOC_CODE+'" >'+doctype[i].DOC_NAME+'</option>';
                        }
                    }
                    $('#SECCODE').append(options);
                    $('#DOCTYPE').append(opType);
                    $("#UNID").val(dt.UNID);
                    $("#CUSTOMERID").val(dt.CUSTOMERID);
                    $("#PARTNAME").val(dt.PARTNAME);
                    $("#PARTNO").val(dt.PARTNO);
                    $("#PROCESSNAME").val(dt.PROCESSNAME);
                    $("#DOCTYPE").val(dt.DOC_TYPE);
                    $("#_SEARCH").val(SEARCH);

                    $("#DOCNO").val(dt.DOCNO);
                    $("#MC_TYPE").val(dt.MC_TYPE);
                    $("#LAST_REV").val(dt.LAST_REV);
                    $("#LAST_EFF_DATE").val(dt.LAST_EFF_DATE);

                    $("#modalEdit").modal('show');

                }

            }
    });
    });

    $(document).on("click", '.btn-secondary', function(e) {
      location.reload();
    });

    $('.modal').on('hidden.bs.modal', function () {
        location.reload();
        })

</script>
@endsection

