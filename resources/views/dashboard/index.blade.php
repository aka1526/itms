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

                <div class="col-md-8 col-sm-8  ">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>สถิติการแจ้งซ่อมคอมพิวเตอร์ <small>แยกรายเดือน</small></h2>

                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <canvas id="repair_Chart"></canvas>
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



    <!-- Chart.js -->
    <script src="/asset/Chart.js/dist/Chart.min.js"></script>

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
function set_charts() {

console.log('run_charts  typeof [' + typeof(Chart) + ']');

if (typeof(Chart) === 'undefined') { return; }

console.log('init_charts');


Chart.defaults.global.legend = {
    enabled: false
};




if ($('#repair_Chart').length) {

    var ctx = document.getElementById("repair_Chart");
    var mybarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December "],
            datasets: [{
                label: '# of Votes',
                backgroundColor: "#26B99A",
                data: ['{!! $dataset[0] !!}','{!! $dataset[1] !!}','{!! $dataset[2] !!}','{!! $dataset[3] !!}'
                ,'{!! $dataset[4] !!}','{!! $dataset[5] !!}','{!! $dataset[6] !!}','{!! $dataset[7] !!}','{!! $dataset[8] !!}'
                ,'{!! $dataset[9] !!}','{!! $dataset[10] !!}','{!! $dataset[11] !!}']
            } ]
        },

        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

}



}


</script>

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
            //init_charts();
            set_charts();
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
        var fa_uuid = $(this).data('fa_uuid');
        var url = '/fixasset/delete';
        $.ajax({
                type: "POST",
                url: url,
                data:{"_token" : $('meta[name=_token]').attr('content'),fa_uuid:fa_uuid},
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

