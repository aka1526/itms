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

<script src="/asset/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link  href="/asset/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
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
                            <form id="form-post" name="form-post" action="/doctype/{{ strtolower($PURPOSE_CODE)}}/update" data-parsley-validate enctype="multipart/form-data" method="POST">
                               @csrf


                                <div class="col-md-12 col-sm-12   text-white mb-2 alert alert-success">
                                <h2 align="center">ส่วนที่ 1 : ผู้ร้องขอบันทึก</h2>
                                </div>


                                <div class="form-group row ">
                                    <label class="col-md-2 col-sm-2 col-form-label "><h4>DAR No.:</h4> </label>
                                    <div class="col-md-2 col-sm-2 ">
                                        <input type="hidden"   name="UNID" id="UNID" value="{{ $UNID}}" />
                                        <input type="text" class="form-control form-control-sm" name="DAR_NO" id="DAR_NO" value="{{ $datarow->DAR_NO}}" placeholder="YY/MM-XXX" readonly/>
                                        {{-- <Span style="color:red;">หากเว้นว่างระบบจะรันเลขที่อัตโนมัติ  YY/MM-XXX</Span> --}}
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
                                                    <input type="radio" class="flat" name="REASON_CODE[]" is="REASON_CODE_{{ $row->REASON_CODE }}"
                                                    {{ $datarow->REASON_CODE ==$row->REASON_CODE ? ' checked=""' : ''}}
                                                    value="{{ $row->REASON_CODE }}" {{ $row->REASON_MAX==1? '  required' :'' }}  />
                                                    {{ $row->REASON_NAME }}
                                                @if( $row->REASON_OTHER=="Y")
                                                    <input type="text" class="form-control form-control-sm mt-1 h-50"  name="REASON_REMARK[]" id="REASON_REMARK_{{ $row->REASON_CODE }}" value="{{ $datarow->REASON_REMARK}}" placeholder="{{ $row->REASON_NAME }}"/>
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
                                                <input type="checkbox" class="flat doc-prefix" name="DOC_PREFIX[{!! $row->DOC_CODE !!}]"

                                                {{ strcmp( $datarow->DOC_PREFIX, $row->DOC_CODE) ==0 ? ' checked="checked"' : ''}}
                                                id="DOC_PREFIX_CODE_{{ $row->DOC_CODE }}"  value="Y" />
                                                {{ $row->DOC_NAME.'  ('.$row->DOC_CODE .')' }}
                                            @if( $row->DOC_OTHER=="Y")
                                                <input type="text" class="form-control form-control-sm mt-1 h-50"   name="DOC_PREFIX_REMARK[{!! $row->DOC_CODE !!}]" id="DOC_PREFIX_REMARK_{{ $row->DOC_CODE }}"   value="{{ $datarow->DAR_TYPE=="IN" ?  $datarow->DOC_PREFIX_REMARK :''}}" placeholder="{{ $row->DOC_NAME }}"/>
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
                                                <input type="checkbox" class="flat doc-prefix" name="DOC_PREFIX[{!! $row->DOC_CODE !!}]"
                                                id="DOC_PREFIX_CODE_{!! $row->DOC_CODE !!}"
                                                {{ strcmp( $datarow->DOC_PREFIX, $row->DOC_CODE) ==0 ? ' checked="checked"' : ''}}
                                                  value="Y" />
                                            {{ $row->DOC_NAME.' ('.$row->DOC_CODE .')' }}
                                            @if( $row->DOC_OTHER=="Y")
                                                <input type="text" class="form-control form-control-sm mt-1 h-50 "   name="DOCEXTERNAL_REMARK[{!! $row->DOC_CODE !!}]" id="DOCEXTERNAL_REMARK_{{ $row->DOC_CODE }}"   value="{{ $datarow->DAR_TYPE=="OUT" ?  $datarow->DOC_PREFIX_REMARK :''}}" placeholder="{{ $row->DOC_NAME }}"/>
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
                                <option value="{{ $row->SEC_CODE}}" {{$datarow->SEC_CODE==$row->SEC_CODE ? ' selected' :'' }}>{{ $row->SEC_NAME}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="DAR_REFER_PARTNAME">Doc. Name / Part Name</label>
                            <input type="text" class="form-control form-control-sm h-50" name="DAR_REFER_PARTNAME" id="DAR_REFER_PARTNAME" value="{{ $datarow->DAR_REFER_PARTNAME }}" placeholder="Doc. Name / Part Name" required>
                          </div>
                    </div>

                    <div class="col-md-3 col-sm-2">
                        <div class="form-group">
                            <label for="DAR_REFER_PROCESSNAME">Process Name</label>
                            <input type="text" class="form-control form-control-sm h-50" name="DAR_REFER_PROCESSNAME" id="DAR_REFER_PROCESSNAME" value="{{ $datarow->DAR_REFER_PROCESSNAME }}" placeholder="Process Name">
                          </div>
                    </div>

                    <div class="col-md-3 col-sm-2">
                        <div class="form-group">
                            <label for="DAR_REFER_PARTNO">P/No.</label>
                            <input type="text" class="form-control form-control-sm h-50" name="DAR_REFER_PARTNO" id="DAR_REFER_PARTNO" value="{{ $datarow->DAR_REFER_PARTNO }}" placeholder="P/No">
                          </div>
                    </div>



                    <div class="col-md-3 col-sm-3">
                        <label>MC Type:</label>
                        <select class="form-control form-control-sm h-50" id="DAR_REFER_MCTYPE" name="DAR_REFER_MCTYPE" >
                                <option value="">-- Choose -- </option>
                            @foreach ($MCTYPE as $key => $row)
                                <option value="{{ $row->MCTYPE_CODE}}" {{$datarow->DAR_REFER_MCTYPE==$row->MCTYPE_CODE ? ' selected' :'' }}>{{ $row->MCTYPE_NAME}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 col-sm-2">
                        <div class="form-group">
                            <label for="DAR_REFER_CUSTOMERID">Customer ID:</label>
                            <input type="text" class="form-control form-control-sm h-50" name="DAR_REFER_CUSTOMERID" id="DAR_REFER_CUSTOMERID"  value="{{ $datarow->DAR_REFER_CUSTOMERID }}" placeholder="Customer ID" required>
                          </div>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="DAR_REFER_DOC">Doc.NO.</label>
                            <input type="text" class="form-control form-control-sm  h-50" name="DAR_REFER_DOC" id="DAR_REFER_DOC" value="{{ $datarow->DAR_REFER_DOC }}" placeholder="Doc.NO." required>
                          </div>
                    </div>


                    <div class="col-md-2 col-sm-2">
                        <div class="form-group">
                            <label for="DAR_REFER_REVNO">Rev. No.</label>
                            <input type="number" min="0" class="form-control form-control-sm h-50" name="DAR_REFER_REVNO" id="DAR_REFER_REVNO" value="{{ $datarow->DAR_REFER_REVNO }}"  placeholder="Rev.0" required>
                          </div>
                    </div>
                    <div class="col-md-1 col-sm-2">
                        <div class="form-group">
                            <label for="DAR_REFER_PAGE">Total Page</label>
                            <input type="text" class="form-control form-control-sm h-50" name="DAR_REFER_PAGE" id="DAR_REFER_PAGE" value="{{ $datarow->DAR_REFER_PAGE }}"  placeholder="Page" required>
                          </div>
                    </div>




                    <div class="col-md-12 col-sm-12 my-2">
                        <label for="DAR_DESC_DETAIL">บันทึกรายละเอียดการแก้ไข/ข้อมูลเพิ่มเติม :</label>
                        <textarea id="DAR_DESC_DETAIL"  name="DAR_DESC_DETAIL" class="form-control" data-parsley-trigger="keyup"   data-parsley-minlength-message="กรุณาใส่ข้อมูล."  >{!!  $datarow->DAR_DESC_DETAIL !!}</textarea>

                    </div>
                    <br/>
                    <div class="col-md-3 col-sm-3">
                        <label for="REQ_BY">Request by :</label>
                        <input type="text" class="form-control form-control-sm h-50" name="REQ_BY" id="REQ_BY" value="{{ $datarow->REQ_BY }}" placeholder="Request by">
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label for="CHECK_BY">Check By :</label>
                        <input type="text" class="form-control form-control-sm h-50" name="CHECK_BY" id="CHECK_BY" value="{{ $datarow->CHECK_BY }}" placeholder="Check By">
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label for="REQ_APP_BY">Approve By :</label>
                        <input type="text" class="form-control form-control-sm h-50" name="REQ_APP_BY" id="REQ_APP_BY" value="{{ $datarow->REQ_APP_BY }}" placeholder="Approve By">
                    </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="DAR_REQ_DATE">Request Date :</label>
                            <input type="date" class="form-control form-control-sm h-50" name="DAR_REQ_DATE" id="DAR_REQ_DATE" value="{{ $datarow->DAR_REQ_DATE }}"  placeholder="Request Date" required>
                        </div>
                </div>

                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                  <th class="column-title">No. </th>
                                  <th class="column-title">Document No</th>
                                  <th class="column-title">Rev.</th>
                                  <th class="column-title">File name</th>
                                  <th class="column-title">View </th>
                                  <th class="column-title">Created by </th>
                                  <th class="column-title">Created time  </th>
                                  <th class="column-title">Action</th>


                                </tr>
                              </thead>
                              <tbody>


                                    @foreach ($FILES as $key => $file)
                                    <tr class="even pointer">
                                        <td class=" ">{{ $key+1}}</td>
                                        <td class=" ">{{ $file->DAR_NO}}</td>
                                        <td class=" ">{{ $file->DAR_NO_REV}}</td>

                                        <td class=" ">{{ $file->FILE_NAME}}</td>
                                        <td class=" "><a href="" data-unid="{{ $file->UNID}}" class="viewfile" /><i class="fa fa-eye fa-2x" style="color:#0843A4;"></i></td>
                                        <td class=" ">{{ $file->CREATE_BY}}</td>
                                        <td class=" ">{{ $file->CREATE_TIME}}</td>
                                        <td ><a href="" data-unid="{{ $file->UNID}}" class="deletefile"><i class="fa fa-trash fa-2x" style="color:red;"></i></a></td>
                                    </tr>
                                    @endforeach




                              </tbody>
                        </table>
                    </div>
                    <div class="col-12 my-2">
                        @if(isset($UNID))


                                <input id="fileuploads" name="fileuploads[]" type="file" class="file" data-show-preview="true"  multiple="multiple">
                                <input type="button" class="btn btn-primary" value="Upload" id="upload"/>


                        @else

                            <input id="fileuploads" name="fileuploads[]" type="file" class="file" data-show-preview="true"  multiple="multiple">

                        @endif
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 col-sm-12 text-white mb-2 alert alert-success">
                        <h2 align="center">ส่วนที่ 2 : DCC.& QMR. ลงบันทึก</h2>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label for="DCC_BY">DCC :</label>
                        <input type="text" class="form-control form-control-sm h-50" name="DCC_BY" id="DCC_BY" value="{{ $datarow->DCC_BY }}"  placeholder="DCC">
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label for="QMR_BY">QMR :</label>
                        <input type="text" class="form-control form-control-sm h-50" name="QMR_BY" id="QMR_BY" value="{{ $datarow->QMR_BY }}" placeholder="QMR">
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label>Respect :</label>
                        <p>

                            <input type="checkbox" class="flat" name="DAR_APPROVE" {{ $datarow->DAR_APPROVE =="Y" ? ' checked="checked"' :'' }} value="Y" /> อนุมัติ
                            <input type="checkbox" class="flat" name="DAR_NOTAPPROVE" {{ $datarow->DAR_NOTAPPROVE =="Y" ? ' checked="checked"' :'' }} value="Y" />ไม่อนุมัติ
                            <input type="checkbox" class="flat" name="DAR_EXPLAIN" {{ $datarow->DAR_EXPLAIN =="Y" ? ' checked="checked"' :'' }} value="R" />ชี้แจง
                        </p>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label for="DAR_EFFECTIVE_DATE">Effective Date :</label>
                        <input type="date" class="form-control form-control-sm h-50" name="DAR_EFFECTIVE_DATE" id="DAR_EFFECTIVE_DATE"  value="{{ $datarow->DAR_EFFECTIVE_DATE }}" placeholder="Effective Date">
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
                                            <input type="checkbox" class="flat" name="REVIEW_CODE[{{ $row->REVIEW_CODE }}]"
                                            @foreach ($REVIEWDOC as $ikey => $irow)
                                                @if( $irow->REVIEW_CODE ==$row->REVIEW_CODE)
                                                    checked="checked"
                                                @endif

                                            @endforeach

                                            value="Y"  {{ $row->REVIEW_MAX==1? '' :'' }}  />
                                            {{ $row->REVIEW_NAME }}
                                        @if( $row->REVIEW_OTHER=="Y")

                                            @foreach ($REVIEWDOC as $ikey => $irow)
                                                @if( $irow->REVIEW_CODE ==$row->REVIEW_CODE)
                                                <input type="text" class="form-control form-control-sm mt-1 h-50"   name="REVIEW_OTHER_TEXT[{{ $row->REVIEW_CODE }}]" value="{{  $irow->REVIEW_REMARK}}" placeholder="{{ $row->REVIEW_NAME }}"/>

                                                @endif

                                            @endforeach

                                        @endif
                                        </div>
                                @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-md-2 col-sm-2 col-form-label "><h4>มีเอกสารส่งคืน(DCC) Rev.</h4> </label>
                    <div class="col-md-4 col-sm-4 ">
                        <input type="text" class="form-control form-control-sm" name="DOC_RETURN_REV" id="DOC_RETURN_REV" placeholder="เอกสารส่งคืน Rev." value="{{ $datarow->DOC_RETURN_REV }}"/><Span style="color:red;">หากมีเอกสารต้องส่งคืนโปรดระบุ Rev. No.</Span>
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
                            <td  class="text-center">
                                <input type="checkbox" class="flat ctlCheck" name="CONTROLLER[{{ $row->SEC_CODE}}]"
                                @foreach ($ISSUE as $ikey => $irow)
                                    @if($irow->SEC_CODE ==$row->SEC_CODE && $irow->CHECK_CONTROLLED=="Y"  )
                                    checked
                                    @endif
                                @endforeach

                                value="Y" ></td>
                            <td  class="text-center">
                                <input type="checkbox" class="flat ctlunCheck" name="UNCONTROLLER[{{ $row->SEC_CODE}}]"
                                @foreach ($ISSUE as $ikey => $irow)
                                    @if($irow->SEC_CODE ==$row->SEC_CODE && $irow->CHECK_UNCONTROLLED=="Y"  )
                                        checked
                                    @endif
                                @endforeach
                            value="Y"></td>
                            <td  class="text-center">
                                <input type="checkbox" class="flat CheckP" name="ISSUE_P[{{ $row->SEC_CODE}}]"
                                @foreach ($ISSUE as $ikey => $irow)
                                    @if($irow->SEC_CODE ==$row->SEC_CODE && $irow->ISSUE_P=="Y"  )
                                        checked
                                    @endif
                                @endforeach
                            value="Y"></td>
                            <td  class="text-center">
                                <input type="checkbox" class="flat CheckE" name="ISSUE_E[{{ $row->SEC_CODE}}]"
                                @foreach ($ISSUE as $ikey => $irow)
                                @if($irow->SEC_CODE ==$row->SEC_CODE && $irow->ISSUE_E=="Y"  )
                                    checked
                                @endif
                                @endforeach
                            value="Y"></td>

                          </tr>
                        @endforeach


                    </tbody>
                  </table>

                    <br />
                    <a href="{{ URL::previous() }}"   class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> กลับ </a>
                  @if(!$DOCLOCK)
                    <button type="submit" class="btn btn-success" ><i class="fa fa-save"></i> บันทึกข้อมูล {{ $DOCLOCK}}</button>
                   @else
                    <lable class="btn btn-secondary bg-danger" > <i class="fa fa-lock"></i> เอกสารถูก Lock </lable>
                    <button type="button" class="btn btn-primary unlockdoc" data-unid="{{ $UNID}}" ><i class="fa fa-unlock"></i> Unlock เอกสาร  </button>
                    @endif
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

$(document).on("click", '.unlockdoc', function(e) {
    e.preventDefault();
	var UNID =$(this).data('unid');

    var url="/doctype/{{ strtolower($PURPOSE_CODE)}}/unlock";
		 Swal.fire({
				title: "คุณต้องการปลด lock เอกสาร?",
				//text: "Once deleted, you will not be able to recover this imaginary file!",
				icon: "warning",
                showDenyButton: true,

                confirmButtonText: 'YES',

				})
                .then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {UNID:UNID ,"_token" : $('meta[name=_token]').attr('content')},
                            success: function(data){

                                Swal.fire({
                                    title: data.msg,
                                    timer: 1000,
                                    icon: data.icon,
                                    confirmButtonText: 'OK'
                                    }).then(() => {
                                        location.reload();
                                    });

                            }
                            });
                    }
                })
});


$(document).on("click", '#upload', function(e) {
    e.preventDefault();
   var UNID= $("#UNID").val();
   var DAR_NO= $("#DAR_NO").val();
   // var files = $('#fileuploads')[0].files;
    var files = $("#fileuploads").get(0).files;
    var formData = new FormData();
    var url="{{ route('upload.save')}}";
    formData.append("_token", "{{ csrf_token() }}");
    formData.append("DAR_UNID", UNID);
    formData.append("DAR_NO",DAR_NO);

    for (var i = 0; i < files.length; i++) {
        formData.append("fileuploads[]", files[i]);
    }
   // formData.append('fileuploads[]', files[0]);

    $.ajax({
            type: "POST",
            url: url,
            data: formData, // serializes the form's elements.
            cache: false,
            processData: false,
            contentType: false,
            success: function(data)
            {
              //console.log(data);
              Swal.fire({
                    title: data.msg,
                    timer: 1000,
                    icon: data.icon,
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
            }
    });

 });

$(document).on("click", '.deletefile', function(e) {
	e.preventDefault();
	var UNID =$(this).data('unid');
    var url="/upload/files/delete";


		 Swal.fire({
				title: "คุณต้องการลบข้อมูล?",
				//text: "Once deleted, you will not be able to recover this imaginary file!",
				icon: "warning",
                showDenyButton: true,

                confirmButtonText: 'YES',

				})
                .then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {UNID:UNID ,"_token" : $('meta[name=_token]').attr('content')},
                            success: function(data){

                                Swal.fire({
                                    title: data.msg,
                                    timer: 1000,
                                    icon: data.icon,
                                    confirmButtonText: 'OK'
                                    }).then(() => {
                                        location.reload();
                                    });

                            }
                            });
                    }
                    })
});


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
    @endsection

