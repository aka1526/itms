@extends('theme.main_show')
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
<!-- jQuery -->
<script src="/asset/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/asset/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- sweetalert2 -->
<script src="/asset/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="/asset/sweetalert2/dist/sweetalert2.min.css" id="theme-styles">
@endsection

@section('page_content')
    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">

                        <div class="x_content">
                            <div class="row ">
                            <div class="col-md-12 col-sm-12">
                            <h4 class="btn-success alert " align="center">แจ้งซ่อมคอมพิวเตอร์:{{ $data->fa_name}}</h4>
                        </div>
                            </div>
                            <!-- start form for validation -->

                               <br/>
                               <div class="row ">


                                <div class="col-md-4 col-sm-4 profile_details" >
                                    <form id="frm_repaire" name="frm_repaire" action="{{ route('ac.repaire')}}" data-parsley-validate enctype="multipart/form-data" method="POST">
                                        @csrf

                                        <input type="hidden" id="fa_uuid" class="form-control" name="fa_uuid" value="{{ $data->fa_uuid}}" >

                                    <div class="well profile_view">
                                      <div class="col-sm-12">

                                        <div class="right col-sm-5 text-center">
                                            <img src="/img/question.png" alt="" width="80px" class="img-circle img-fluid">
                                          </div>
                                        <div class="left col-sm-7">
                                          <h2 class="text-primary"> แจ้งปัญหาการใช้งาน</h2>
                                        </div>

                                      </div>
                                      <div class=" bottom text-center">

                                        <div class=" col-sm-12 emphasis">

                                          <button type="submit" class="btn btn-dark btn-sm btn-block " data-problem_uuid="">
                                            <i class="fa fa-bell-o"> </i> แจ้งปัญหา
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-md-4 col-sm-4  profile_details">
                                    <form id="frm_pm" name="frm_pm" action="{{ route('ac.pm')}}" data-parsley-validate enctype="multipart/form-data" method="POST">
                                        @csrf

                                        <input type="hidden" id="fa_uuid" class="form-control" name="fa_uuid" value="{{ $data->fa_uuid}}" >

                                    <div class="well profile_view">
                                      <div class="col-sm-12">

                                        <div class="right col-sm-5 text-center">
                                            <img src="/img/pm.png" alt="" width="80px" class="img-circle img-fluid">
                                          </div>
                                        <div class="left col-sm-7">
                                          <h2 class="text-primary">แผนซ่อมบำรุงรักษา  </h2>
                                        </div>

                                      </div>
                                      <div class=" bottom text-center">

                                        <div class=" col-sm-12 emphasis">

                                          <button type="submit" class="btn btn-warning btn-sm btn-block " data-problem_uuid="">
                                            <i class="fa fa-bell-o"> </i> ดำเนินการตรวจเช็ค
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-md-4 col-sm-4  profile_details" ">
                                    <form id="frm_report" name="frm_report" action="{{route('ac.report')}}" data-parsley-validate enctype="multipart/form-data" method="POST">
                                        @csrf

                                        <input type="hidden" id="fa_uuid" class="form-control" name="fa_uuid" value="{{ $data->fa_uuid}}" >

                                    <div class="well profile_view">
                                      <div class="col-sm-12">

                                        <div class="right col-sm-5   col-md-5 text-center">
                                            <img src="/img/report.png" alt="" width="80px" class="img-circle img-fluid">
                                          </div>
                                        <div class="left col-sm-7 col-md-7">
                                          <h2 class="text-primary">ประวัติการซ่อมบำรุงรักษา </h2>
                                        </div>

                                      </div>
                                      <div class=" bottom text-center">

                                        <div class=" col-sm-12 emphasis">


                                          <button type="submit" class="btn btn-info btn-sm btn-block " data-problem_uuid="">
                                            <i class="fa fa-bell-o"> </i> แจ้งปัญหา
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                </form>
                                </div>

                               </div>

                                <br />
                                {{-- <a href="/fixasset"   class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> กลับ </a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึกข้อมูล</button> --}}

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

        function setscore(uuid,score){
            $('.star_'+uuid+'_1').css({'color' : '#73879C'}).removeClass('fa-star').addClass('fa-star-o');
            $('.star_'+uuid+'_2').css({'color' : '#73879C'}).removeClass('fa-star').addClass('fa-star-o');
            $('.star_'+uuid+'_3').css({'color' : '#73879C'}).removeClass('fa-star').addClass('fa-star-o');
                $('.star_'+uuid+'_'+score).css({"color": "red"}).removeClass('fa-star-o').addClass('fa-star');

            $('#score_'+uuid).val(score);

        }

$(document).on("click", '.btn-save', function(e) {


    e.preventDefault();
    var problem_uuid= $(this).data('problem_uuid');
    var fa_uuid= $("#fa_uuid").val();
    var fa_user= $("#fa_user").val();
    var fa_name= $("#fa_name").val();

    var repair_problem= $("#repair_problem_"+problem_uuid).val();
    var score= $("#score_"+problem_uuid).val();

    var formData = new FormData();
    var url="{{route('re.save_req')}}";
    formData.append("_token", "{{ csrf_token() }}");
    formData.append('problem_uuid', problem_uuid);
    formData.append('fa_uuid', fa_uuid);
    formData.append('fa_name', fa_name);
    formData.append('fa_user', fa_user);
    formData.append('repair_problem', repair_problem);

    formData.append('score', score);

    $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(data){

                Swal.fire({
                icon: data.icon,
                title: data.title,


                }).then(() => {
                    location.href='/repairs/success'
                })


            }
    });

});
</script>
@endsection

