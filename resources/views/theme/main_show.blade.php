<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{{ csrf_token() }}}"/>
	<title>@yield('title','แจ้งซ่อมคอมพิวเตอร์/อุปกรณ์ Online')</title>
    @yield('herder_jscss')
</head>

<body class="nav">
	<div class="container body">
		<div class="main_container">
            @yield('page_content')
		</div>
	</div>
@yield('footer_jscss')

</body>
</html>


