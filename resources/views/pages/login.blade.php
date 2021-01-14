@extends('index') 
 
@section('title', 'Login | IT-Plus')

@section('content')
<form action="{{ route('login1') }}" method="POST" role="form">
	@csrf 
	<legend>Đăng nhập hệ thống</legend>

	<div class="form-group">
		<label for="">Username</label>
		<input type="email" required name="user" class="form-control" value="" placeholder="Nhập email của bạn">
	</div>

	<div class="form-group">
		<label for="">Password</label>
		<input type="password" required name="passw" class="form-control" value="" placeholder="Nhập pass">
	</div>

	<button type="submit" name="sm_login" class="btn btn-primary">Đăng nhập</button>
	<span>Nếu bạn chưa có tài khoản? <a href="{{Route('register')}}" style="color: red;">Đăng ký</a></span>
	
</form>
<br>
@include('notification.noti_status')

@endsection