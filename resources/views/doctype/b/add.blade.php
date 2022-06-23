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

@endsection

@section('page_content')
    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">
                        <div class="x_title">
                            <h2 align="center">ใบแจ้งขอดำเนินการด้านเอกสาร : Document Action Request (DAR) </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <!-- start form for validation -->
                            <form id="form-post" name="form-post" action="/doctype/{{ strtolower($PURPOSE_CODE)}}/save" data-parsley-validate enctype="multipart/form-data" method="POST">
                               @csrf

                               <input type="hidden" name="REF_UNID_MASTERLIST" id="REF_UNID_MASTERLIST"   value="{{ isset($MASTERLIST)   ?  $MASTERLIST->UNID : ''}}"/>
                                <div class="col-md-12 col-sm-12   text-white mb-2 alert alert-success">
                                <h2 align="center">ส่วนที่ 1 : ผู้ร้องขอบันทึก</h2>
                                </div>


                                <div class="form-group row ">
                                    <label class="col-md-2 col-sm-2 col-form-label "><h4>DAR No.:</h4> </label>
                                    <div class="col-md-2 col-sm-2 ">
                                        <input type="text" class="form-control form-control-sm" name="DAR_NO" id="DAR_NO" placeholder="YY/MM-XXX" value=""/><Span style="color:red;">หากเว้นว่างระบบจะรันเลขที่อัตโนมัติ  YY/MM-XXX</Span>
                                    </div>
                                </div>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label "><h4>วัตถุประสุงค์ :</h4></label>

                                <div class="col-sm-10">
                                    <div class="input-group">
                                        @foreach ($PURPOSE as $key => $row)
                                                <div class="col-md-4 col-sm-4 my-1">
                                                @if( $row->PURPOSE_CODE==$PURPOSE_CODE)
                                                    <i class="fa fa-check-square-o fa-2x" style="color: rgb(26, 186, 156);"></i>
                                                    <input type="hidden" class="flat" name="PURPOSE_CODE" value="{{ $row->PURPOSE_CODE }}" />
                                                    {{ $row->PURPOSE_NAME }}

                                                @else

                                                    <input type="checkbox" class="flat mr-3" name="PURPOSE_CODE" value="{{ $row->PURPOSE_CODE }}" disabled="disabled"    />
                                                    {{ $row->PURPOSE_NAME }}

                                                @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"><h4>เหตุผลในการขอ :</h4></label>

                                <div class="col-sm-10">
                                    <div class="input-group">
                                        @foreach ($REASON as $key => $row)
                                                <div class="col-md-4 col-sm-4 my-1">
                                                    <input type="radio" class="flat" name="REASON_CODE[]" is="REASON_CODE_{{ $row->REASON_CODE }}" value="{{ $row->REASON_CODE }}" {{ $row->REASON_MAX==1? '  required' :'' }}  />
                                                    {{ $row->REASON_NAME }}
                                                @if( $row->REASON_OTHER=="Y")
                                                    <input type="text" class="form-control form-control-sm mt-1 h-50"  name="REASON_REMARK[]" id="REASON_REMARK_{{ $row->REASON_CODE }}" value="" placeholder="{{ $row->REASON_NAME }}"/>
                                                @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><h4>เอกสารภายใน :</h4></label>

                            <div class="col-sm-10">
                                <div class="input-group">
                                    @foreach ($DOCIN as $key => $row)
                                            <div class="col-md-4 col-sm-4 my-1">
                                                <input type="checkbox" class="flat doc-prefix" name="DOC_PREFIX[{!! $row->DOC_CODE !!}]" id="DOC_PREFIX_CODE_{{ $row->DOC_CODE }}"  value="Y"    />
                                                {{ $row->DOC_NAME.'  ('.$row->DOC_CODE .')' }}
                                            @if( $row->DOC_OTHER=="Y")
                                                <input type="text" class="form-control form-control-sm mt-1 h-50"   name="DOC_PREFIX_REMARK[{!! $row->DOC_CODE !!}]" id="DOC_PREFIX_REMARK_{{ $row->DOC_CODE }}"   value="" placeholder="{{ $row->DOC_NAME }}"/>
                                            @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><h4>เอกสารภายนอก :</h4></label>

                        <div class="col-sm-10">
                            <div class="input-group">
                                @foreach ($DOCEX as $key => $row)
                                        <div class="col-md-4 col-sm-4 my-1">
                                                <input type="checkbox" class="flat doc-prefix" name="DOC_PREFIX[{!! $row->DOC_CODE !!}]" id="DOC_PREFIX_CODE_{!! $row->DOC_CODE !!}"  value="Y" />
                                            {{ $row->DOC_NAME.' ('.$row->DOC_CODE .')' }}
                                            @if( $row->DOC_OTHER=="Y")
                                                <input type="text" class="form-control form-control-sm mt-1 h-50 "   name="DOCEXTERNAL_REMARK[{!! $row->DOC_CODE !!}]" id="DOCEXTERNAL_REMARK_{{ $row->DOC_CODE }}"   value="" placeholder="{{ $row->DOC_NAME }}"/>
                                            @endif
                                        </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">

                    <div class="col-md-3 col-sm-3">
                        <label>Section</label>
                        <select class="form-control form-control-sm h-50" id="SEC_CODE" name="SEC_CODE" required>
                                <option value="">-- Choose -- </option>
                            @foreach ($SECTION as $key => $row)
                                <option value="{{ $row->SEC_CODE}}" {{ isset($MASTERLIST) && $MASTERLIST->SEC_CODE==$row->SEC_CODE ? ' selected' : ''}}>{{ $row->SEC_NAME}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="DAR_REFER_PARTNAME">Doc. Name / Part Name</label>
                            <input type="text" class="form-control form-control-sm h-50"
                            name="DAR_REFER_PARTNAME" id="DAR_REFER_PARTNAME" value="{{ isset($MASTERLIST)   ?  $MASTERLIST->PARTNAME : ''}}" placeholder="Doc. Name / Part Name" required {{ isset($MASTERLIST) && $MASTERLIST->PARTNAME !=''  ?  ' readonly' : ''}} >
                          </div>
                    </div>

                    <div class="col-md-3 col-sm-2">
                        <div class="form-group">
                            <label for="DAR_REFER_PROCESSNAME">Process Name</label>
                            <input type="text" class="form-control form-control-sm h-50" name="DAR_REFER_PROCESSNAME" id="DAR_REFER_PROCESSNAME" value="{{ isset($MASTERLIST)   ?  $MASTERLIST->PROCESSNAME : ''}}" placeholder="Process Name" {{ isset($MASTERLIST)&& $MASTERLIST->PROCESSNAME!=''   ?  ' readonly' : ''}} >
                          </div>
                    </div>

                    <div class="col-md-3 col-sm-2">
                        <div class="form-group">
                            <label for="DAR_REFER_PARTNO">P/No.</label>
                            <input type="text" class="form-control form-control-sm h-50" name="DAR_REFER_PARTNO" id="DAR_REFER_PARTNO"  value="{{ isset($MASTERLIST)   ?  $MASTERLIST->PARTNO : ''}}" placeholder="P/No" {{ isset($MASTERLIST) && $MASTERLIST->PARTNO!=''  ?  ' readonly' : ''}} >
                          </div>
                    </div>



                    <div class="col-md-3 col-sm-3">
                        <label>MC Type:</label>
                        <select class="form-control form-control-sm h-50" id="DAR_REFER_MCTYPE" name="DAR_REFER_MCTYPE" value="{{ isset($MASTERLIST)   ?  $MASTERLIST->MC_TYPE : ''}}" >
                                <option value="">-- Choose -- </option>
                            @foreach ($MCTYPE as $key => $row)
                                <option value="{{ $row->MCTYPE_CODE}}">{{ $row->MCTYPE_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-2">
                        <div class="form-group">
                            <label for="DAR_REFER_CUSTOMERID">Customer ID:</label>
                            <input type="text" class="form-control form-control-sm h-50" name="DAR_REFER_CUSTOMERID" id="DAR_REFER_CUSTOMERID" value="{{ isset($MASTERLIST)   ?  $MASTERLIST->CUSTOMERID : ''}}"  placeholder="Customer ID" {{ isset($MASTERLIST)  && $MASTERLIST->CUSTOMERID!=''  ?  ' readonly' : ''}}  required>
                          </div>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="DAR_REFER_DOC">Doc.NO.</label>
                            <input type="text" class="form-control form-control-sm  h-50" name="DAR_REFER_DOC" id="DAR_REFER_DOC" value="{{ isset($MASTERLIST)   ?  $MASTERLIST->DOCNO : ''}}" placeholder="Doc.NO." {{ isset($MASTERLIST) && $MASTERLIST->DOCNO!=''  ?  ' readonly' : ''}}  required>
                          </div>
                    </div>


                    <div class="col-md-2 col-sm-2">
                        <div class="form-group">
                            <label for="DAR_REFER_REVNO">Rev. No.</label>
                            <input type="number" min="0" class="form-control form-control-sm h-50" name="DAR_REFER_REVNO" id="DAR_REFER_REVNO" value="{{ isset($MASTERLIST)   ?  $MASTERLIST->LAST_REV+1 : ''}}" placeholder="Rev.0" {{ isset($MASTERLIST) && $MASTERLIST->LAST_REV!=''   ?  ' readonly' : ''}}  required>
                          </div>
                    </div>
                    <div class="col-md-1 col-sm-2">
                        <div class="form-group">
                            <label for="DAR_REFER_PAGE">Total Page</label>
                            <input type="text" class="form-control form-control-sm h-50" name="DAR_REFER_PAGE" id="DAR_REFER_PAGE" placeholder="Page" required>
                          </div>
                    </div>




                    <div class="col-md-12 col-sm-12 my-2">
                        <label for="DAR_DESC_DETAIL">บันทึกรายละเอียดการแก้ไข/ข้อมูลเพิ่มเติม :</label>
                        <textarea id="DAR_DESC_DETAIL"  name="DAR_DESC_DETAIL" class="form-control" data-parsley-trigger="keyup"   data-parsley-minlength-message="กรุณาใส่ข้อมูล."  ></textarea>

                    </div>
                    <br/>
                    <div class="col-md-3 col-sm-3">
                        <label for="REQ_BY">Request by :</label>
                        <input type="text" class="form-control form-control-sm h-50" name="REQ_BY" id="REQ_BY" placeholder="Request by">
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label for="CHECK_BY">Check By :</label>
                        <input type="text" class="form-control form-control-sm h-50" name="CHECK_BY" id="CHECK_BY" placeholder="Check By">
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label for="REQ_APP_BY">Approve By :</label>
                        <input type="text" class="form-control form-control-sm h-50" name="REQ_APP_BY" id="REQ_APP_BY" placeholder="Approve By">
                    </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="DAR_REQ_DATE">Request Date :</label>
                            <input type="date" class="form-control form-control-sm h-50" name="DAR_REQ_DATE" id="DAR_REQ_DATE" placeholder="Request Date" required>
                        </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">

                                  <th class="column-title">item </th>
                                  <th class="column-title">File name</th>
                                  <th class="column-title">icon </th>
                                  <th class="column-title">Create by </th>
                                  <th class="column-title">Create time  </th>
                                  <th class="column-title">Action</th>


                                </tr>
                              </thead>
                              <tbody>
                                <tr class="even pointer">

                                    <td class=" ">-</td>
                                    <td class=" ">-</td>
                                    <td class=" ">-</td>
                                    <td class=" ">-</td>
                                    <td class=" ">-</td>
                                    <td class=" ">-</td>

                                  </tr>
                              </tbody>
                        </table>
                    </div>
                    <div class="col-12 my-2">
                        @if(isset($UNID))
                            <form enctype="multipart/form-data" action="" method="post">
                                <input id="fileupload" name="fileuploads[]" type="file" class="file" data-show-preview="true" multiple>
                                <input type="button" class="btn btn-primary" value="Upload" id="upload"/>

                            </form>
                        @else

                            <input id="fileupload" name="fileuploads[]" type="file" class="file" data-show-preview="true" multiple>

                        @endif
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 col-sm-12 text-white mb-2 alert alert-success">
                        <h2 align="center">ส่วนที่ 2 : DCC.& QMR. ลงบันทึก</h2>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label for="DCC_BY">DCC :</label>
                        <input type="text" class="form-control form-control-sm h-50" name="DCC_BY" id="DCC_BY" placeholder="DCC">
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label for="QMR_BY">QMR :</label>
                        <input type="text" class="form-control form-control-sm h-50" name="QMR_BY" id="QMR_BY" placeholder="QMR">
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label>Respect :</label>
                        <p>

                            <input type="checkbox" class="flat" name="DAR_APPROVE" value="Y" /> อนุมัติ
                            <input type="checkbox" class="flat" name="DAR_NOTAPPROVE" value="Y" />ไม่อนุมัติ
                            <input type="checkbox" class="flat" name="DAR_EXPLAIN" value="R" />ชี้แจง
                        </p>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label for="DAR_EFFECTIVE_DATE">Effective Date :</label>
                        <input type="date" class="form-control form-control-sm h-50" name="DAR_EFFECTIVE_DATE" id="DAR_EFFECTIVE_DATE" placeholder="Effective Date">
                    </div>

                </div>
                <br/>

                <div class="clearfix"></div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><h4>ทบทวนเอกสารที่เกี่ยวข้อง :</h4></label>

                        <div class="col-sm-9">
                            <div class="input-group">
                                @foreach ($REVIEW as $key => $row)
                                        <div class="col-md-4 col-sm-4 my-1">
                                            <input type="checkbox" class="flat" name="REVIEW_CODE[{{ $row->REVIEW_CODE }}]"  value="Y"  {{ $row->REVIEW_MAX==1? '' :'' }}  />
                                            {{ $row->REVIEW_NAME }}
                                        @if( $row->REVIEW_OTHER=="Y")
                                            <input type="text" class="form-control form-control-sm mt-1 h-50"   name="REVIEW_OTHER_TEXT[{{ $row->REVIEW_CODE }}]" value="" placeholder="{{ $row->REVIEW_NAME }}"/>
                                        @endif
                                        </div>
                                @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-md-2 col-sm-2 col-form-label "><h4>มีเอกสารส่งคืน(DCC) Rev.</h4> </label>
                    <div class="col-md-4 col-sm-4 ">
                        <input type="text" class="form-control form-control-sm" name="DOC_RETURN_REV" id="DOC_RETURN_REV" placeholder="เอกสารส่งคืน Rev." value=""/><Span style="color:red;">หากมีเอกสารต้องส่งคืนโปรดระบุ Rev. No.</Span>
                    </div>
                </div>

                <table class="table table-sm -striped jambo_table bulk_action table-bordered">
                    <thead>
                        <tr>
                            <td colspan="1" rowspan="2" class="text-center align-middle"> No.</td>
                            <td colspan="1" rowspan="2" class="text-center align-middle"> Section</td>
                            <td colspan="1" rowspan="2" class="text-center align-middle"> Name</td>
                            <td colspan="1" rowspan="2" class="text-center align-middle">Controlled
                              <br/>
                              <span  class="checkbox mr-1">
                                <input type="checkbox" class="flat ctlCheckAll"  > CheckAll
                                </span>
                            </td>
                            <td colspan="1" rowspan="2" class="text-center align-middle">UnControlled
                                <br/>  <span  class="checkbox mr-1">
                                    <input type="checkbox" class="flat ctlunCheckAll"  > CheckAll
                            </span>
                            </td>
                            <td colspan="2" rowspan="1" class="text-center align-middle">รูปแบบการแจกจ่าย</td>

                          </tr>
                          <tr>
                            <td  class="text-center"> <span  class="checkbox mr-1">

                                <input type="checkbox" class="flat CheckPAll" > P

                        </span></td>
                            <td  class="text-center">   <span  class="checkbox mr-1">

                                <input type="checkbox" class="flat CheckEAll"  > E

                        </span></td>
                          </tr>

                    </thead>
                    <tbody>
                        @foreach ($SECTION as $key => $row)
                            <tr>
                            <td scope="row" class="text-center">{{ $key+1 }}</td>
                            <td  class="text-center count">{{ $row->SEC_CODE}}</td>
                            <td  class="text-left">{{ $row->SEC_NAME}}</td>
                            <td  class="text-center"><input type="checkbox" class="flat ctlCheck" name="CONTROLLER[{{ $row->SEC_CODE}}]" value="Y" ></td>
                            <td  class="text-center"><input type="checkbox" class="flat ctlunCheck" name="UNCONTROLLER[{{ $row->SEC_CODE}}]" value="Y"></td>
                            <td  class="text-center"><input type="checkbox" class="flat CheckP" name="ISSUE_P[{{ $row->SEC_CODE}}]" value="Y"></td>
                            <td  class="text-center"><input type="checkbox" class="flat CheckE" name="ISSUE_E[{{ $row->SEC_CODE}}]" value="Y"></td>

                          </tr>
                        @endforeach


                    </tbody>
                  </table>

                    <br />
                    <a href="{{ URL::previous() }}"   class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> กลับ </a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึกข้อมูล</button>

                </form>
                            <!-- end form for validations -->

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @endsection

    @section('footer_jscss')
    <!-- jQuery -->
	<script src="/asset/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="/asset/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

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



         });
    </script>
    <script>

/*
$('.docexternal').on('ifChanged', function(event) {
   // alert('checked = ' + event.target.checked);
   // alert('value = ' + event.target.name);

   $('.docexternal').each(function(){

        //Get the id of the current div (please make them unique!)
        var id = $(this).attr('id');
        alert(id);
        //Get the matrix value of the current div
        //var matrixValue = $(this).data('matrix-value');

        //Add a new key-value pair to the postObject
        //postObject[id] = matrixValue;
        });
});*/

$(".doc-prefix").on("ifChanged", function(){
        var Checkid = $(this).attr('id');
        if($(this).is(':checked')) {

            $('.child_checkbox').prop('checked', true);
            $('.child_checkbox').iCheck('update');

            $('.doc-prefix').each(function(){
                    var DOCEX_ID = $(this).attr('id');
                if(DOCEX_ID != Checkid) {
                    $(this).prop('checked', false);
                    $(this).iCheck('update');
                }


            });

        }

});


$(".ctlCheckAll").on("ifChanged", function(){

var Checkid = $(this).attr('id');

    var check =$(this).is(':checked');

    $('.child_checkbox').prop('checked', true);
    $('.child_checkbox').iCheck('update');
    if(check){
        $('.ctlCheck').each(function(){
            $('.ctlCheck').prop('checked', true);
            $('.ctlCheck').iCheck('update');
        });
    } else {
        $('.ctlCheck').each(function(){
            $('.ctlCheck').prop('checked', false);
            $('.ctlCheck').iCheck('update');
        });
    }

});


$(".ctlunCheckAll").on("ifChanged", function(){

var Checkid = $(this).attr('id');

var check =$(this).is(':checked');

$('.child_checkbox').prop('checked', true);
$('.child_checkbox').iCheck('update');
if(check){
$('.ctlunCheck').each(function(){
    $('.ctlunCheck').prop('checked', true);
    $('.ctlunCheck').iCheck('update');
});
} else {
$('.ctlunCheck').each(function(){
    $('.ctlunCheck').prop('checked', false);
    $('.ctlunCheck').iCheck('update');
});
}

});

$(".CheckPAll").on("ifChanged", function(){

var Checkid = $(this).attr('id');

var check =$(this).is(':checked');

$('.child_checkbox').prop('checked', true);
$('.child_checkbox').iCheck('update');
if(check){
$('.CheckP').each(function(){
    $('.CheckP').prop('checked', true);
    $('.CheckP').iCheck('update');
});
} else {
$('.CheckP').each(function(){
    $('.CheckP').prop('checked', false);
    $('.CheckP').iCheck('update');
});
}

});

$(".CheckEAll").on("ifChanged", function(){

var Checkid = $(this).attr('id');

var check =$(this).is(':checked');

$('.child_checkbox').prop('checked', true);
$('.child_checkbox').iCheck('update');
if(check){
$('.CheckE').each(function(){
    $('.CheckE').prop('checked', true);
    $('.CheckE').iCheck('update');
});
} else {
$('.CheckE').each(function(){
    $('.CheckE').prop('checked', false);
    $('.CheckE').iCheck('update');
});
}

});


</script>
</script>
@endsection

