<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Platti! | Aquisar</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('fonts/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/animate.min.css')}}">
    
    <!-- Custom styling plus plugins -->
    <link rel="stylesheet" href="{{URL::asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/icheck/flat/green.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/datatables/tools/css/dataTables.tableTools.css')}}">
    <script type="text/javascript" src="{{URL::asset('js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('css/sweet-alert.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/notify.css')}}">

</head>


<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">

                        <a href="index.html" class="site_title"><span>Platti!</span></a>

                    </div>
                    <div class="clearfix"></div>
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="{{URL::to('categorias')}}"><i class="glyphicon glyphicon-th-list"></i> &nbsp; Categorías</a>
                                </li>
                                <li><a href="{{URL::to('productos')}}"><i class="glyphicon glyphicon-glass"></i> &nbsp; Productos</a>
                                </li>
                                <li><a href="{{URL::to('usuarios')}}"><i class="glyphicon glyphicon-user"></i> &nbsp; Usuarios</a>
                                </li>
                                <li><a href="{{URL::to('mesas')}}"><i class="glyphicon glyphicon-th-large"></i> &nbsp; Mesas</a>
                                </li>
                                <li><a href="{{URL::to('servicios')}}"><i class="glyphicon glyphicon-shopping-cart"></i> &nbsp; Comandas</a>
                                </li>
                                <li><a href="{{URL::to('pedidos')}}"><i class="glyphicon glyphicon-list-alt"></i> &nbsp; Pedidos</a>
                                </li>
                                <li><a href="{{URL::to('')}}"><i class="glyphicon glyphicon-folder-close"></i> &nbsp; Caja</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div id="notify_h" ></div>                
                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- /top navigation -->

            <!-- page content -->
            @yield('contenido')
            <!-- /page content -->

            </div>
        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>


        <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
        <!-- chart js -->
        <script type="text/javascript" src="{{URL::asset('js/chartjs/chart.min.js')}}"></script>
        <!-- bootstrap progress js -->
        <script type="text/javascript" src="{{URL::asset('js/progressbar/bootstrap-progressbar.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('js/nicescroll/jquery.nicescroll.min.js')}}"></script>
        <!-- icheck -->
        <script type="text/javascript" src="{{URL::asset('js/icheck/icheck.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('js/custom.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('js/sweet-alert.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('js/Notificaciones.js')}}"></script>
        @yield('scripts')

</body>

</html>