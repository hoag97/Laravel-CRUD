@extends('admin.index')

@section('content')
<a href="{{ route('admin.list-member') }}"><button class="btn btn-warning">Quay lại</button></span></a>
	<form action="{{ route('admin.edit-member', $member->id) }}" method="POST" role="form">
		<legend>Sửa thông tin học viên <span></legend>
	
		<div class="form-group">
			<label for="name">Name <span style="color: red;">(*)</span></label>
			<input type="text" required="" class="form-control" name="name" id="name" value="{{$member->name}}" />
		</div>

		<div class="form-group">	
			<label for="faculty">Faculty <span style="color: red;">(*)</span></label>
			<select class="form-control" name="faculty" id="faculty">
				@foreach ($rs as $value)
					<option @if($member->faculty_id === $value->id) {{'selected'}} @endif value="{{$value->id}}">{{$value->title}}</option>
				@endforeach			
			</select>
		</div>

		<div class="form-group">
			<label for="email">Email <span style="color: red;">(*)</span></label>
			<input type="email" required="" class="form-control" name="email" id="email" value="{{$member->email}}">
		</div>

		<div class="form-group">
			<label for="phone">Phone <span style="color: red;">(*)</span></label>
			<input type="number" maxlength="10" required="" class="form-control" name="phone" id="phone" value="{{$member->phone}}" />
		</div>

		<div class="form-group">
			<label for="addres">Addres <span style="color: red;">(*)</span></label>
			<input type="text" min="10" max="10" required="" class="form-control" name="addres" id="addres" value="{{$member->addres}}" />
		</div>
		
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<button type="submit" name="submit" class="btn btn-primary">Update Member</button>
	</form>

@endsection