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
                            <h2>รายการแจ้งซ่อมคอมพิวเตอร์และอุปกรณ์</h2>
                            <ul class="nav navbar-right panel_toolbox">
								<li>
                                    <button type="button" class="btn btn-success btn-sm" onclick="location.href='{{route("fa.index")}}';">
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
                                    })
                                 </script>
                              @endif

                              <div class="col-md-12">

                                <p>
                                    <form id="frmSearch" name="frmSearch" action="{{ route('re.index')}}" method="POST" >
                                        @csrf

                                    <div class="col-md-5 col-sm-5   ">
                                        <label for="search">Search</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm" id="search" name="search" value="{{ isset($search) ? $search :''}}"  placeholder="Search…">
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

                                      <th class="column-title">ลำดับ </th>
                                      <th class="column-title">วันที่</th>
                                      <th class="column-title">เอกสาร</th>
                                      <th class="column-title">ชื่ออุปกรณ์</th>
                                      <th class="column-title">ชื่อผู้แจ้ง</th>
                                      <th class="column-title">ปัญหา/งานซ่อม </th>
                                      <th class="column-title">สาเหตุ </th>
                                      <th class="column-title">วิธีการแก้ไข </th>
                                      <th class="column-title">ผู้ดำเนินการ </th>
                                      <th class="column-title">สถานะงาน </th>
                                      <th class="bulk-actions" colspan="7">
                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                      </th>
                                    </tr>
                                  </thead>

                                  <tbody>

                                    @foreach ($dataset as $key => $row)

                                    <tr class="even pointer">

                                        <td class=" "> {{ $dataset->firstItem() + $key }}</td>
                                         <td class=" ">  {{ \Carbon\Carbon::parse($row->repair_date )->format('d-m-Y');}}</td>
                                        <td class=" "> {{ $row->repair_docno }}</td>
                                        <td class=" "> {{ $row->fa_name }}</td>
                                        <td class=" ">  {{ $row->repair_user}}</td>
                                        <td class=" ">  {{ $row->repair_problem}}</td>
                                        <td class=" ">  {{ $row->repair_cause}}</td>
                                        <td class=" ">  {{ $row->repair_solution}}</td>
                                        <td class=" "> {{ $row->repair_checkby }}</td>

                                        <td class=" ">
                                            <div class="btn-group ">

                                                    @if( $row->repair_status=="NEW" )
                                                        <button type="button" class="btn btn-warning btn-sm" style="width: 90px;">
                                                            <i class="fa fa-exclamation-circle"></i> แจ้งซ่อม
                                                        </button>
                                                        <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="sr-only"> แจ้งซ่อม</span>
                                                        </button>

                                                    @elseif( $row->repair_status=="DONE" )
                                                        <button type="button" class="btn btn-success btn-sm" style="width: 90px;">
                                                            <i class="fa fa-check-circle"></i>สำเร็จ
                                                        </button>
                                                        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="sr-only">สำเร็จ</span>
                                                        </button>
                                                        @elseif( $row->repair_status=="WORKING" )
                                                        <button type="button" class="btn btn-info btn-sm" style="width: 90px;">
                                                            <i class="fa fa-gears"></i>กำลังซ่อม
                                                        </button>
                                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="sr-only">กำลังซ่อม</span>
                                                        </button>
                                                    @endif


                                                    @if(isset(Auth::user()->name))
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item btn-rec" href="javascript:void(0)" data-uuid="{{$row->repair_uuid}}"><i class="fa fa-power-off"></i> รับงานซ่อม</a>
                                                        <a class="dropdown-item" href="{{route('re.editjob', $row->repair_uuid)}}" ><i class="fa fa-pencil-square"></i> บันทึกการซ่อม</a>
                                                        <a class="dropdown-item text-danger btn-delete" href="javascript:void(0)" data-uuid="{{$row->repair_uuid}}"><i class="fa fa-trash"></i> <strong>ลบข้อมูล</strong></a>

                                                    </div>
                                                    @endif

                                              </div>



                                        </td>

                                      </tr>

							    	@endforeach



                                  </tbody>
                                </table>
                                @if( $dataset)
                                {{ $dataset->links('pagination.default',
										[
											'paginator' => $dataset,
                                            'search' => isset($search) ? $search : '',
											'link_limit' => $dataset->perPage()
										]) }}
                                  @endif
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


$(document).on("click", '.btn-rec', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'ยืนยันรับงานซ่อม?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, รับงานซ่อม!'
    }).then((result) => {
        if(result.isConfirmed){
            var uuid=$(this).data('uuid');
            var url = '/repairs/job/rec';
            $.ajax({
                    type: "POST",
                    url: url,
                    data:{"_token" :"{{ csrf_token() }}",uuid:uuid},
                    success: function(data){

                        Swal.fire({
                        title: data.msg,
                        timer: 1300,
                        icon: data.icon,
                        confirmButtonText: 'OK'
                        }).then((result) => {
                            location.reload();
                        });
                    }
            });
        }

    });
});

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
        var uuid = $(this).data('uuid');
        var url = '/repairs/job/delete';
        $.ajax({
                type: "POST",
                url: url,
                data:{"_token" : "{{ csrf_token() }}",uuid:uuid},
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
            var url = '/doctype/a/upstatus';

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


function timeFunctionLong(input) {
setTimeout(function() {
    input.type = 'date';
 }, 5000);
}


 </script>
@endsection

