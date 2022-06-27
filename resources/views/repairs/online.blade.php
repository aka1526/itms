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
                            <h2 class="btn-success alert" align="center">แจ้งซ่อมคอมพิวเตอร์/อุปกรณ์</h2>
                            <!-- start form for validation -->


                               <div class="row">

                                <div class="col-md-3">
                                    <label for="com_name">คอมพิวเตอร์/อุปกรณ์</label>
                                    <input type="text" id="fa_name" class="form-control" name="fa_name" required="" value="{{ $data->fa_name}}" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="repair_date">วันที่แจ้ง</label>
                                    <input type="text" id="repair_date" class="form-control" name="repair_date" value="{{ \Carbon\Carbon::now()->format('d-m-Y')}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="fa_user">ผู้แจ้งซ่อม</label>
                                    <input type="text" id="fa_user" class="form-control" name="fa_user"  value="{{ $data->fa_user}}" >
                                </div>

                               </div>
                               <br/>
                               <div class="row">
                                @foreach ($problems as $problem)

                                <div class="col-md-4 col-sm-4  profile_details">
                                    <form id="{{ $problem->problem_uuid }}" name="{{ $problem->problem_uuid }}" action="{{ route('fa.save')}}" data-parsley-validate enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <input type="hidden" id="problem_uuid"  value="{{ $problem->problem_uuid }}">
                                        <input type="hidden" id="score_{{ $problem->problem_uuid }}"  value="1">
                                        <input type="hidden" id="fa_uuid" class="form-control" name="fa_uuid" value="{{ $data->fa_uuid}}" >
                                        <input type="hidden" id="repair_problem_{{ $problem->problem_uuid}}" class="form-control" name="repair_problem_{{ $problem->problem_uuid}}" value="{{ $problem->problem_name}}" >
                                    <div class="well profile_view">
                                      <div class="col-sm-12">
                                        <h4 class="brief text-center alert"><i>แจ้งปัญหาการใช้งาน</i></h4>
                                        <div class="right col-sm-5 text-center">
                                            <img src="/img/question.png" alt="" width="80px" class="img-circle img-fluid">
                                          </div>
                                        <div class="left col-sm-7">
                                          <h2 class="text-danger">{{ $problem->problem_name }}</h2>
                                        </div>

                                      </div>
                                      <div class=" bottom text-center">
                                        <div class=" col-sm-12 emphasis">
                                          <p class="ratings">
                                            <a>ระดับเร่งด่วน</a><br/>

                                            <a href="javascript:void(0)" onclick="setscore('{{ $problem->problem_uuid }}','1')"><span class="fa fa-star fa-2x star_{{ $problem->problem_uuid }}_1"></span> ปกติ</a>
                                            <a href="javascript:void(0)" onclick="setscore('{{ $problem->problem_uuid }}','2')"><span class="fa fa-star-o fa-2x  star_{{ $problem->problem_uuid }}_2"> </span>ด่วน</a>
                                            <a href="javascript:void(0)" onclick="setscore('{{ $problem->problem_uuid }}','3')"><span class="fa fa-star-o fa-2x  star_{{ $problem->problem_uuid }}_3"> </span>ด่วนที่สุด</a>

                                          </p>
                                        </div>
                                        <div class=" col-sm-12 emphasis">

                                          <button type="button" class="btn btn-success btn-sm btn-block btn-save" data-problem_uuid="{{ $problem->problem_uuid }}">
                                            <i class="fa fa-bell-o"> </i> แจ้งปัญหา
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                </form>
                                  </div>
                                @endforeach

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
                timer:1200,

                }).then(() => {
                    location.href='/repairs/success?fa_uuid='+data.fa_uuid
                })


            }
    });

});
</script>
@endsection

