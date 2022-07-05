<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{{ csrf_token() }}}"/>
    <title>@yield('title','แจ้งซ่อมคอมพิวเตอร์/อุปกรณ์ Online')</title>
    @yield('herder_jscss')
<style>
    @media (max-width: 991px) {
    .nav-md .container.body .right_col,
    .nav-md .container.body .top_nav {
        width: 100%;
        margin: 0
    }
    .nav-md .container.body .col-md-3.left_col {
        display: none
    }
    .nav-md .container.body .right_col {
        width: 100%;
        padding-right: 0
    }
    .right_col {
        padding: 10px !important
    }
}
</style>
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="/" class="site_title"><i class="fa fa-paw"></i> <span>Document Control</span></a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
                    @include('theme.profile')
					<!-- /menu profile quick info -->

					<br />

					<!-- sidebar menu -->
                    @include('theme.sidebar_menu')
					<!-- /sidebar menu -->

				</div>
			</div>

			<!-- top navigation -->
            @include('theme.navigation')
			<!-- /top navigation -->

			<!-- page content -->
            @yield('page_content')

			<!-- /page content -->

			<!-- footer content -->
            @include('theme.footer')
			<!-- /footer content -->
		</div>
	</div>
@yield('footer_jscss')

</body>
</html>


