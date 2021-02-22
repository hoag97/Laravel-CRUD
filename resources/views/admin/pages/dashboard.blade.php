@extends('admin.index')

@section('title', 'Dashboard | Laravel')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Laravel
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-info-circle"></i>  <strong>Welcome!</strong>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row text-center">
        <div class="col-6 col-sm-4 col-md-4 col-lg-4">
            <a href="{{ route('facadeDB.list-member') }}">
                <img src="https://user-images.githubusercontent.com/15979712/27070335-deffe080-5018-11e7-82e8-2a299cb9e99b.png" width="200" height="200" class="img-fluid" alt="Laravel">
                <h4 class="m-4">DB - Database</h4>
            </a>
        </div>
        <div class="col-6 col-sm-4 col-md-4 col-lg-4">
            <a href="{{ route('QueryBuilder.list-member') }}">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/220px-Laravel.svg.png" width="200" height="200" class="img-fluid" alt="Laravel">
                <h4 class="m-4">Database: Query Builder</h4>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-4 col-lg-4">
            <a href="{{ route('ORM.list-member') }}">
                <img src="https://plugins.jetbrains.com/files/7532/62662/icon/pluginIcon.svg" width="200" height="200" class="img-fluid" alt="Laravel">
                <h4 class="m-4">Eloquent ORM</h4>
            </a>
        </div>
    </div>

    <!-- /.row -->



@endsection