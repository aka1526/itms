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
                            <h2 align="center">เพิ่มข้อมูลรอบระยะเวลา</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <!-- start form for validation -->
                            <form id="form-post" name="form-post" action="{{ route('pe.save')}}" data-parsley-validate enctype="multipart/form-data" method="POST">
                               @csrf
                               <input type="hidden" id="periods_uuid" class="form-control" name="periods_uuid"  >
                               <div class="row">

                                <div class="col-md-9 col-sm-6">
                                    <label for="com_name">ชื่อรอบเวลา</label>
                                    <input type="text" id="periods_name" class="form-control" name="periods_name"  required="" >
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label for="periods_interval">ระยะเวลา (เดือน)</label>
                                    <input type="number" id="periods_interval" class="form-control" name="periods_interval" min="0" max="20" required="" >
                                </div>

                               </div>
                                <br />
                                <a href="/problems"   class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> กลับ </a>
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

Dropzone.options.dropzone =
        {
            maxFilesize: 10,
            renameFile: function (file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 60000,
            success: function (file, response) {
                console.log(response);
            },
            error: function (file, response) {
                return false;
            }
        };

</script>
@endsection

