<!DOCTYPE html> 
<html lang="">
	<head>
		<base href="{{ asset('') }}">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/my_css.css">
	</head>
	
	<body>

		<div class="container">
			
			<div class="row" style="margin-top: 150px;">
				<div class="col-md-6 col-md-push-3">
					@yield('content')
				</div>
			</div>
		</div>

		<script src="js/jquery.js"></script>
		<script src="js/myJava.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>