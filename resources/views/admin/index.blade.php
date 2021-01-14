<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head') 

<body>

    <div id="wrapper">

        <!-- Navigation -->
        @include('admin.includes.header')

        <div id="page-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    @include('admin.includes.script')

</body>

</html>
