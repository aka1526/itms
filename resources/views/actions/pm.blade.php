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

<!-- NProgress -->
<link href="/asset/nprogress/nprogress.css" rel="stylesheet">
<!-- Dropzone.js -->
<link href="/asset/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="/custom/css/custom.min.css" rel="stylesheet">

@endsection

@section('page_content')
    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    @if(count($pm)>0)
                    <div class="x_panel">
                        <div class="x_title">
                            <h2 align="center">ดำเนินการ Preventive </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                               <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                          <tr>

                                            <th>DATE</th>
                                            <th>Computer Name/ ชื่ออปกรณ์</th>
                                            <th>ผู้ใช้งาน</th>
                                            <th>แผนก/ที่ติดตั้ง</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                     @foreach ($pm as $item)
                                     <tr>

                                        <td>{{$item->pm_date}}</td>
                                        <td>{{ $fa->fa_name}}</td>
                                        <td>{{ $fa->fa_user}}</td>
                                        <td>{{ $fa->fa_sec}}</td>
                                        <td>
                                        @if($item->pm_status=="Y")
                                            <a href="/actions/pm/result/{{ $item->pm_uuid}}"   class="btn btn-info btn-sm"> <i class="fa fa-eye "></i> ดูผลการตรวจ </a>
                                        @else
                                        <a href="/actions/pm/plan/{{ $item->pm_uuid}}"   class="btn btn-primary btn-sm"> <i class="fa fa-arrow-right"></i> ตรวจเช็ค </a>
                                        @endif
                                        </td>
                                      </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                                </div>


                               </div>
                                <br />
                                <a href="/actions/act/{{ $fa->fa_uuid}}"   class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> กลับ </a>


                        </div>
                    </div>
                    @else
                    <div class="x_panel">
                        <div class="x_title">
                            <h2 align="center">เพิ่มข้อมูล Preventive </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <!-- start form for validation -->
                            <form id="form-post" name="form-post" action="{{ route('ac.savepm')}}" data-parsley-validate enctype="multipart/form-data" method="POST">
                               @csrf
                               <input type="hidden" id="fa_uuid" class="form-control" name="fa_uuid" value="{{$uuid}}" >
                               <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="pm_date">วันที่ PM</label>
                                    <input type="date" id="pm_plan_date" class="form-control" name="pm_plan_date"  value="" required="" >
                                </div>


                               </div>
                                <br />
                                <a href="/actions/act/c31ef8e5c6d3434895856415613e60e0"   class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> กลับ </a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึกข้อมูล</button>

                            </form>
                            <!-- end form for validations -->

                        </div>
                    </div>

                    @endif

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

       <!-- NProgress -->
       <script src="/asset/nprogress/nprogress.js"></script>
       <!-- Dropzone.js -->
       <script src="/asset/dropzone/dist/min/dropzone.min.js"></script>


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

</script>
@endsection

