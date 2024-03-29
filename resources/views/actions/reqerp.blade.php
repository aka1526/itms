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

                    <div class="x_panel">
                        <div class="x_title">
                            <h2 align="center">ขอเพิ่มเติม-ปรับปรุงระบบ ERP </h2>
                            @if(isset($fa))
                            <ul class="nav navbar-right panel_toolbox">
								<li>
                                    <button type="button" class="btn btn-success btn-sm"
                                     onclick="location.href='{{route('reqerp.add').'?uuid='.$fa->fa_uuid }}'">
                                    <i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
                                </li>

							</ul>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                               <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <table class="table table-striped table-bordered jambo_table bulk_action">
                                        <thead>
                                            <tr>
                                                <td >ลำดับ</td>
                                                <td >วันที่</td>
                                                <td >ผู้ร้องขอ</td>
                                                <td >หัวข้อ/เรื่อง</td>
                                                <td >เหตุผลประกอบ</td>

                                                <td >ผลการพิจารณา</td>
                                                <td >วันที่เริ่ม</td>
                                                <td >กำหนดเสร็จ</td>
                                                <td >% ความคืบหน้า</td>
                                                @if(isset(Auth::user()->name))
                                                <td >Act.</td>
                                                @endif

                                              </tr>


                                        </thead>
                                     @foreach ($data as $key => $item)
                                     <tr>
                                        <td class=""> {{ $data->firstItem() + $key }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->req_date )->format('d-m-Y');}}</td>
                                        <td class="text-left">{{ $item->req_name}}</td>
                                        <td class="text-left">{{ $item->req_title}}</td>
                                        <td class="text-left">{{ $item->req_desc}}</td>

                                        <td align="center"> {!! getStat($item->req_vote_stat) !!}</td>
                                        <td align="center">{{ $item->start_date}} </td>
                                        <td align="center">{{ $item->end_date}} </td>
                                        <td align="center">
                                            <div class="widget_summary">

                                                <div class="w_center " style="width: 100%;">
                                                  <div class="progress">
                                                    <div class="progress-bar progress-bar-striped
                                                    @if($item->jobpercen>=100)
                                                        bg-success
                                                    @elseif ($item->jobpercen>=80)
                                                        bg-primary
                                                    @elseif ($item->jobpercen>=50)
                                                        bg-purple
                                                    @else
                                                        bg-dark
                                                    @endif
                                                    " role="progressbar" aria-valuenow="{{ $item->jobpercen}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $item->jobpercen}}%;">
                                                      <span class="sr-only-focusable">{{ $item->jobpercen}}%</span>
                                                    </div>
                                                  </div>
                                                </div>

                                                <div class="clearfix"></div>
                                              </div>
                                        </td>
                                        @if(isset(Auth::user()->name))
                                        <td align="center"> <a href="{{ '/reqerp/edit/'. $item->req_unid }}"   class="btn btn-success btn-sm">Edit</a></td>
                                        @endif

                                      </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                                </div>


                               </div>
                                <br />




                        </div>
                    </div>


                </div>
            </div>


        </div>
    </div>
    @endsection
@php
    function getStat($stat=""){

        if($stat=="P"){
            $val='<i class="fa fa-check fa-2x green" ></i>';
        } elseif($stat=="N"){
            $val='<i class="fa fa-close fa-2x red"></i>';
        } else {
            $val='<i class="fa fa-question fa-2x yellow"></i>';
        }

        return  $val;

    }
@endphp

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

