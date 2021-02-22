@extends('admin.index')

@section('title', 'List member | Laravel')

@section('content')

<h3 class="text-center">DANH SÁCH HỌC VIÊN</h3>

<br>

<form class="form-inline" name="frm_search" method="POST">
    <div class="form-group">
        <input type="text" minlength="4" maxlength="50" required="" class="form-control" name="key" id="key" placeholder="Nhập số điện thoại..." value="@if(isset($key)){!!$key!!}@endif" />
    </div>

    <input type="hidden" name="_token" value="{{csrf_token('')}}" />
    <button style="margin-left: 5px;" type="submit" class="btn btn-info">Search</button>
</form>

<br>

@if (isset($count))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Có</strong> {{$count}} kết quả được tìm thấy!
    </div>
@endif

@include('admin.notification.noti_status')

@if($count_rs > 0)
    <table class="table table-responsive table-bordered table-hover table-inverse">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Họ và tên</th>
                <th>Khoa</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt = 0; ?>
            @foreach ($rs as $value)
                <tr>
                    <td class="text-center">{{$stt += 1}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->faculty->title}}</td>
                    <td>{{$value->phone}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->addres}}</td>
                    <td colspan="2">
                        <a href="{{ route('ORM.get-member', $value->id) }}"><button class="btn btn-primary">Edit</button></a>
                        <a onclick="return confirm('Bạn có muốn xóa học viên này không? ');" href="{{ route('ORM.delete-member', $value->id) }}"><button class="btn btn-danger">Delete</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        {{ $rs->links( "pagination::bootstrap-4") }}
@endif
@endsection