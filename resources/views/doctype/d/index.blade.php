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
<meta name="_token" content="{{{ csrf_token() }}}"/>
@endsection

@section('page_content')
    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">
                        <div class="x_title">
                            <h2>รายการ{{$PURPOSE_NAME}} </h2>
                            <ul class="nav navbar-right panel_toolbox">
								<li>
                                    <button type="button" class="btn btn-success btn-sm" onclick="location.href='/doctype/{{ strtolower($PURPOSE_CODE)}}/add';">
                                    <i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
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
                                    }).then((result) => {
                                        location.reload();

                                    })
                                 </script>
                              @endif
                              <div class="col-md-12">
                                <p>
                                    <form id="frmSearch" name="frmSearch" action="{{route('a.search')}}" method="POST" >
                                        @csrf

                                        <div class="col-md-2 col-sm-3 form-group ">
                                        <label for="DATE_START" class="control-label col-md-6 col-sm-6 ">Start Date</label>
                                        <div class="col-md-12 col-sm-12">
                                            <input id="DATE_START"  name="DATE_START"  value="{{ isset($DATE_START) ? $DATE_START : date('Y-m-d')}}" class="date-picker form-control form-control-sm" placeholder="dd-mm-yyyy" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='date'" onmouseout="timeFunctionLong(this)">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 form-group  ">
                                        <label class="control-label col-md-6 col-sm-6 ">End Date</label>
                                        <div class="col-md-12 col-sm-12">
                                          <input id="DATE_END"  name="DATE_END" value="{{ isset($DATE_END) ? $DATE_END : date('Y-m-d')}}" class="date-picker form-control form-control-sm" placeholder="dd-mm-yyyy" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='date'" onmouseout="timeFunctionLong(this)">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 form-group ">
                                        <label for="REASON_CODE">Reason</label>
                                        <select id="REASON_CODE" name="REASON_CODE" class="form-control form-control-sm"  >
                                            <option value="">Choose..</option>

                                            @foreach ($REASON as $key => $row)
                                            <option value="{{ $row->REASON_CODE}}" {{ ( isset($REASON_CODE)  && $REASON_CODE==  $row->REASON_CODE) ? ' selected' : ''}}>{{ $row->REASON_NAME}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-5 col-sm-5   ">
                                        <label for="heard">Search</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm" id="SEARCH" name="SEARCH" value="{{ isset($SEARCH) ? $SEARCH :''}}"  placeholder="Search…">
                                        <div class="input-group-append">
                                          <button class="btn btn-primary btn-sm" type="sumit" >search</button>
                                        </div>
                                      </div>
                                    </div>
                                </form>
                            </p>
                              </div>
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                  <thead>
                                    <tr class="headings">

                                      <th class="column-title">Item </th>
                                      <th class="column-title">Dar No. </th>
                                      <th class="column-title">Req.Date </th>
                                      <th class="column-title">Reason</th>
                                      <th class="column-title">Customer </th>
                                      <th class="column-title">Type </th>

                                      <th class="column-title">Doc No. </th>
                                      <th class="column-title">Part Name </th>
                                      <th class="column-title">Part No </th>
                                      <th class="column-title">Process </th>

                                      <th class="column-title">Rev </th>
                                      <th class="column-title">Eff. Date</th>
                                      <th class="column-title">Action </th>

                                      <th class="bulk-actions" colspan="7">
                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                      </th>
                                    </tr>
                                  </thead>

                                  <tbody>

                                    @foreach ($dataset as $key => $row)

                                    <tr class="even pointer">

                                        <td class=" "> {{ $dataset->firstItem() + $key }}</td>

                                        <td class=" "> {{ $row->DAR_NO }}</td>
                                        <td class=" ">  {{ \Carbon\Carbon::parse($row->DAR_REQ_DATE )->format('d-m-Y');}}</td>
                                        <td class=" ">  {{ $row->REASON_NAME}}</td>
                                        <td class=" ">  {{ $row->DAR_REFER_CUSTOMERID}}</td>
                                        <td class=" ">  {{ $row->DAR_TYPE}}</td>

                                        <td class=" ">  {{ $row->DAR_REFER_DOC}}</td>

                                        <td class=" ">  {{ $row->DAR_REFER_PARTNAME}}</td>
                                        <td class=" ">  {{ $row->DAR_REFER_PARTNO}}</td>
                                        <td class=" ">  {{ $row->DAR_REFER_PROCESSNAME}}</td>

                                        <td class=" ">  {{ $row->DAR_REFER_REVNO}}</td>
                                        <td class=" ">  {{ isset($row->DAR_EFFECTIVE_DATE) ? \Carbon\Carbon::parse($row->DAR_EFFECTIVE_DATE )->format('d-m-Y') : '-'}}</td>

                                        <td class=" ">
                                            <div class="btn-group ">

                                                    @if( $row->DAR_APPROVE=="Y" )
                                                        <button type="button" class="btn btn-success btn-sm" style="width: 90px;">
                                                            <i class="fa fa-check"></i> อนุมัติ
                                                        </button>
                                                        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="sr-only">อนุมัติ</span>
                                                        </button>
                                                    @elseif( $row->DAR_NOTAPPROVE=="Y" )
                                                        <button type="button" class="btn btn-danger btn-sm" style="width: 90px;">
                                                            <i class="fa fa-ban"></i> ไม่อนุมัติ
                                                        </button>
                                                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="sr-only">ไม่อนุมัติ</span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-warning btn-sm" style="width: 90px;">
                                                            <i class="fa fa-exclamation-circle"></i> รออนุมัติ
                                                        </button>
                                                        <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="sr-only">รออนุมัติ</span>
                                                        </button>
                                                    @endif



                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('d.edit',$row->UNID) }}"><i class="fa fa-pencil-square"></i> แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ route('report.view',$row->UNID) }}"><i class="fa fa-print"></i> พิมพ์รายงาน</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger btn-delete" href="" data-unid="{{$row->UNID}}"><i class="fa fa-trash"></i> <strong>ลบข้อมูล</strong></a>

                                                </div>
                                              </div>



                                        </td>
                                        {{-- <td class=" last">

                                         <div class="btn-group">
                                            <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                              <a class="dropdown-item" href="{{ route('a.edit',$row->UNID) }}"> แก้ไขข้อมูล</a>
                                              <a class="dropdown-item" href="{{ route('report.view',$row->UNID) }}">พิมพ์รายงาน</a>
                                              <div class="dropdown-divider"></div>
                                              <a class="dropdown-item text-danger btn-delete" href="" data-unid="{{$row->UNID}}"><strong>ลบข้อมูล</strong></a>

                                            </div>
                                          </div>
                                        </td> --}}
                                      </tr>

							    	@endforeach



                                  </tbody>
                                </table>
                                {{ $dataset->links('pagination.default',
										[
											'paginator' => $dataset,
											'link_limit' => $dataset->perPage()
										]) }}
                              </div>
                        </div>
                    </div>
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
            });
    </script>

<script>

$(document).on("click", '.btn-delete', function(e) {
    e.preventDefault();

    Swal.fire({
  title: 'ยืนยันการลบข้อมูล?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
    if(result.isConfirmed){
        var unid = $(this).data('unid');
        var url = '/doctype/{{ strtolower($PURPOSE_CODE)}}/delete';
        $.ajax({
                type: "POST",
                url: url,
                data:{"_token" : $('meta[name=_token]').attr('content'),UNID:unid},
                success: function(data){

                    Swal.fire({
                    title: data.msg,
                    timer: 1300,
                    icon: data.result,
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        location.reload();
                    });
                }
          });
    }

});

});

$(document).ready(function(){
        $("input:checkbox").click(function() {
            var checked="N";
            var unid = $(this).data('unid');
            var url = '/doctype/{{ strtolower($PURPOSE_CODE)}}/upstatus';

            if($(this).is(":checked")) {
                var checked="Y";

            }

           $.ajax({
                    url: url,
                    type: 'POST',
                    data:{"_token" : $('meta[name=_token]').attr('content'),UNID:unid,CHECKED:checked},
                    success: function(data){
                        Swal.fire({
                        title: data.msg,
                        timer: 1300,
                        icon: data.result,
                        confirmButtonText: 'OK'
                        }).then((result) => {
                        location.reload();
                    });
                    }
                });


        });
    });



 </script>
@endsection

