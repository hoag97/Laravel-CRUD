@extends('admin.index')

@section('content')


<h3 class="text-center">DANH SÁCH HỌC VIÊN</h3>

<br>

@include('admin.notification.noti_status')

<table class="table table-responsive table-bordered table-hover table-inverse">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Name</th>
            <th>Faculty</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Addres</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt = 0; ?>
        @foreach ($rs as $value)
            <tr>
                <td class="text-center">{{$stt += 1}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->faculty}}</td>
                <td>{{$value->phone}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->addres}}</td>
                <td colspan="2">
                    <a href="{{ route('admin.edit-member', $value->id) }}"><button class="btn btn-primary">Edit</button></a>
                    <a onclick="return confirm('Bạn có muốn xóa học viên này không? ');" href="{{ route('admin.delete-member', $value->id) }}"><button class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection