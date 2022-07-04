@extends('theme.main_login')
@section('herder_jscss')
 <!-- Bootstrap -->
 <link href="/asset/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Font Awesome -->
 <link href="/asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">
 <!-- NProgress -->
 <link href="/asset/nprogress/nprogress.css" rel="stylesheet">
 <!-- Animate.css -->
 <link href="/asset/animate.css/animate.min.css" rel="stylesheet">

 <!-- Custom Theme Style -->
 <link href="/custom/css/custom.min.css" rel="stylesheet">
 <script src="/asset/jquery/dist/jquery.min.js"></script>
 <!-- Bootstrap -->
 <script src="/asset/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

 <!-- sweetalert2 -->
 <script src="/asset/sweetalert2/dist/sweetalert2.min.js"></script>
 <link rel="stylesheet" href="/asset/sweetalert2/dist/sweetalert2.min.css" id="theme-styles">



@endsection
@section('page_content')
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="form-post" name="form-post" action="{{ route('login') }}" data-parsley-validate enctype="multipart/form-data" method="POST">
                @csrf

              <h1>Login Form</h1>
              <div>
                <input type="email" class="form-control" placeholder="email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="password" required="" />
              </div>
              <div>


                <button type="submit" class="btn btn-success btn-block">Login</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />


              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
    @endsection

    @section('footer_jscss')

    @endsection
