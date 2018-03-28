<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/images/favicon.ico">

    <title>MinimalPro Admin - Dashboard Blank Page </title>

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="/assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="/assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="/assets/vendor_components/select2/dist/css/select2.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="/css/master_style.css">

    <!-- Sweet-Alert  -->
    <link href="/assets/vendor_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <!-- MinimalPro Admin Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/css/skins/_all-skins.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="/assets/vendor_plugins/iCheck/flat/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <b class="logo-mini">
                <span><i class="mdi mdi-bookmark-check"></i></span>
            </b>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">todo-app</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user-circle-o"></i>
                        </a>
                        <ul class="dropdown-menu scale-up">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/images/user5-128x128.png" class="float-left rounded-circle" alt="User Image">

                                <p>
                                    {{ Auth::user()->name }}
                                    <small class="mb-5">{{ Auth::user()->email }}</small>
                                    <button type="button" id="logout-btn" class="btn btn-danger btn-sm btn-rounded">Cerrar sesión</button>
                                </p>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li>
                    <a href="/tasks">
                        <i class="fa fa-inbox"></i> <span>Tareas</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/tasks/starred">
                        <i class="fa fa-star"></i> <span>Destacadas</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                </li>
                <li class="header nav-small-cap">Proyectos</li>
                @foreach($projects as $project)
                    <li>
                        <a href="/tasks/project/{{ $project->id }}">
                            <i class="fa fa-circle-thin"></i> <span>{{ str_limit($project->name, 15, '...') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                    </li>
                @endforeach
                <li>
                    <a href="/projects/create">
                        <i class="fa fa-plus-square"></i> <span>Nuevo</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                </li>

            </ul>
        </section>
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        &copy; 2017 <a href="https://www.multipurposethemes.com/">Multi-Purpose Themes</a>. All Rights Reserved.
    </footer>
</div>
<!-- ./wrapper -->

<form id="logout-frm" action="{{ route('logout') }}" method="POST">
    @csrf
</form>

<!-- jQuery 3 -->
<script src="/assets/vendor_components/jquery/dist/jquery.min.js"></script>

<!-- popper -->
<script src="https://unpkg.com/popper.js@1.14.1/dist/umd/popper.min.js"></script>

<!-- Bootstrap 4.0-->
<script src="/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Select2 -->
<script src="/assets/vendor_components/select2/dist/js/select2.full.js"></script>

<!-- bootstrap datepicker -->
<script src="/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- SlimScroll -->
<script src="/assets/vendor_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="/assets/vendor_components/fastclick/lib/fastclick.js"></script>

<!-- Sweet-Alert  -->
<script src="/assets/vendor_components/sweetalert/sweetalert.min.js"></script>
<script src="/assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js"></script>

<!-- MinimalPro Admin App -->
<script src="/js/template.js"></script>

<!-- iCheck -->
<script src="/assets/vendor_plugins/iCheck/icheck.js"></script>

<script>
    //Initialize Select2 Elements
    $('#project').select2({allowClear: true});
    $('#tags').select2({tags: true});

    $('.mailbox-messages input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

    $('.task-delete').click(function (e) {
        swal({
            title: "Estás seguro de eliminar la tarea?",
            text: "No podrás deshacer esta acción!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, estoy seguro!",
            cancelButtonText: "No, mejor no!",
            closeOnConfirm: false
        }, function (isConfirm) {
            if (isConfirm) {
                $('#task-delete-frm').attr('action', '/tasks/' + $(e.currentTarget).attr('data-id'));
                $('#task-delete-frm').submit();
            }
        });
    });

    $('.project-delete').click(function (e) {
        swal({
            title: "Estás seguro de eliminar el proyecto?",
            text: "No podrás deshacer esta acción!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, estoy seguro!",
            cancelButtonText: "No, mejor no!",
            closeOnConfirm: false
        }, function (isConfirm) {
            if (isConfirm) {
                $('#project-delete-frm').attr('action', '/projects/' + $(e.currentTarget).attr('data-id'));
                $('#project-delete-frm').submit();
            }
        });
    });

    $('.mailbox-messages input[type="checkbox"]').on('ifChecked', function (e) {
        $('#task-done-frm').attr('action', '/tasks/done/' + $(e.currentTarget).attr('data-id'));
        $('#task-done-frm').submit();
    });

    $('.mailbox-messages input[type="checkbox"]').on('ifUnchecked', function (e) {
        $('#task-undone-frm').attr('action', '/tasks/undone/' + $(e.currentTarget).attr('data-id'));
        $('#task-undone-frm').submit();
    });

    $('.task-starred').click(function (e) {
        $('#task-starred-frm').attr('action', '/tasks/starred/' + $(e.currentTarget).attr('data-id'));
        $('#task-starred-frm').submit();
    });

    //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        clearBtn: true,
        todayBtn: 'linked',
        todayHighlight: true
    });

    $('#logout-btn').click(function () {
        $('#logout-frm').submit();
    });
</script>

</body>
</html>