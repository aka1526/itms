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
                            <h2>ข้อมูล แผนบำรุงรักษาคอมพิวเตอร์</h2>
                            <ul class="nav navbar-right panel_toolbox">
								<li>
                                    <button type="button" class="btn btn-success btn-sm" onclick="location.href='{{route('pmplans.add')}}'">
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
                                    <form id="frmSearch" name="frmSearch" action="{{ route('pmplans.index')}}" method="POST" >
                                        @csrf
                                        <div class="col-md-2 col-sm-2  ">

                                            <label for="search">แผนประจำปี</label>
                                            <div class="input-group mb-3">
                                                <select class="form-control form-control-sm" id="pm_year" name="pm_year" >
                                                    <option>Choose..</option>
                                                    {{ $last= date('Y')-1 }}
                                                    {{ $now = date('Y')+1 }}

                                                    @for ($i = $now; $i >= $last; $i--)
                                                        <option value="{{ $i }}" {{ $i==$pm_year ? ' selected' :''  }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2  ">

                                            <label for="search">เดือน</label>
                                            <div class="input-group mb-3">
                                                <select class="form-control form-control-sm" id="pm_month" name="pm_month" >

                                                    @php
                                                    $months =  array("แสดงทั้งหมด","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                                                    @endphp
                                                    @foreach ($months as $key => $month)
                                                           <option value="{{ $key}}" {{ $pm_month==$key ? ' selected' : '' }}> {{ $month}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

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

                                      <th class="column-title">ชื่อคอมพิวเตอร์</th>
                                      <th class="column-title">ชื่อผู้ใช้</th>
                                      <th class="column-title">ประเภท</th>
                                      <th class="column-title">แผนก</th>
                                      <th class="column-title">วันที่ตามแผน</th>

                                      <th class="column-title">วันที่ดำเนินการ</th>
                                      <th class="column-title">ผู้ดำเนินการ </th>
                                      <th class="column-title">View</th>
                                      <th class="column-title">Delete </th>


                                    </tr>
                                  </thead>

                                  <tbody>

                                    @foreach ($dataset as $key => $row)

                                    <tr class="even pointer">

                                        <td class=" "> {{ $dataset->firstItem() + $key }}</td>

                                        <td class=" "> {{ $row->fa_name }}</td>
                                        <td class=" "> {{ $row->fa_user }}</td>

                                        <td class=" "> {{ $row->fa_type }}</td>
                                        <td class=" "> {{ $row->fa_sec }}</td>
                                        <td class=" ">{{ \Carbon\Carbon::parse($row->pm_date )->format('d-m-Y');}}</td>
                                        <td class=" ">{{ isset($row->pm_act_date) ? \Carbon\Carbon::parse($row->pm_act_date )->format('d-m-Y') : ''}}</td>

                                        <td class=" "> {{ $row->pm_by }}</td>
                                        @if($row->pm_status !='Y' )
                                        <td class=" "> <a class="" href="{{route('pmplans.edit', $row->pm_uuid)}}" title="edit/แก้ไข"><i class="fa fa-pencil-square fa-2x" style="color:#1127e9e8" ></i> </a></td>

                                        <td class=" "> <a class="btn-delete" data-uuid="{{$row->pm_uuid}}" href=""><i class="fa fa-trash-o fa-2x " style="color:red;"></i> </a></td>
                                         @else
                                         <td class=" "> <a class="" href="/actions/pm/result/{{$row->pm_uuid}}" title="View/ดู"> <i class="fa fa-eye fa-2x" style="color:#d612ac"></i></a></td>
                                         <td class=" "> <i class="fa fa-check fa-2x" style="color:#26B99A"></i></td>

                                        @endif

                                      </tr>

							    	@endforeach



                                  </tbody>
                                </table>
                                @if( $dataset)
                                {{ $dataset->links('pagination.pmyear',
										[
											'paginator' => $dataset,
                                            'pm_year' => isset($search) ? $pm_year : '',
                                            'pm_month' => isset($search) ? $pm_month : '',
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
        var url = '/pmplans/delete';
        $.ajax({
                type: "POST",
                url: url,
                data:{"_token" : $('meta[name=_token]').attr('content'),uuid:uuid},
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


 </script>
@endsection

