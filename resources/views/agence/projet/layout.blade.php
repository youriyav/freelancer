<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url('/css/assets/bootstrap.css')}}" />
    <link href="{{url('/css/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{url('/css/assets/ionicons.min.css')}}">
    <!-- Theme style -->

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{url('/css/assets/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/assets/AdminLTE.min.css')}}">
    @yield('css')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="" >
    <header class="main-header" >

        <!-- Logo -->

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" style="min-height: 140px">
            <!-- Sidebar toggle button-->
            <a href="" class="brand" style="background-color: #3c8dbc">
                <img src="{{ url('/img/sante-annonces-logo.png') }}" class="img-circle" alt="User Image">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>S</b>A</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">Sante-Annonce</span>
            </a>

            <div class="container hidden-md hidden-lg hidden-sm">
                <div class="[ navbar-header ]">
                    <button type="button" class="[ navbar-toggle ]" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">nav</span>
                        <span class="fa fa-bars"></span>

                    </button>
                    <div class="[ animbrand ]" >
                    </div>
                </div>
                <div class="[ collapse navbar-collapse ]" id="bs-example-navbar-collapse-1">
                    <ul class="[ nav navbar-nav navbar-right ]">
                        <li><a href="#" class="[ animate ]">Agence</a></li>

                        @if(!Auth::check())
                            <li><a href="#" class="[ animate ]"> Devenir Prestataire</a></li>
                            <li class="">
                                <a href="{{route('seConnecter')}}"  class="[ animate ]">
                                    <i class="fa fa-sign-in"></i> Se connecter
                                </a>

                            </li>
                            <li class="">
                                <a href="{{route('inscription')}}"  class="[ animate ]">
                                    <i class="fa fa-user"></i> S'inscrire
                                </a>

                            </li>
                        @endif

                        @if(!Auth::check())
                        <li>
                            <a href="#" class="[ dropdown-toggle ][ animate ]" data-toggle="dropdown"><i class="fa fa-user-circle-o"></i> Mon compte<span class="[ caret ]"></span></a>
                            <ul class="[ dropdown-menu ]" role="menu">
                                <li><a href="#" class="[ animate ]">Mes Projets <span class="[ pull-right  ] fa fa-briefcase"></span></a></li>
                                <li><a href="#" class="[ animate ]">Paramètres <span class="[ pull-right  ] fa fa-gears"></span></a></li>
                                <li><a href="#" class="[ animate ]">Mon Profil <span class="[ pull-right  ] fa fa-user"></span></a></li>
                                <li><a href="#" class="[ animate ]">Se déconnecter <span class="[ pull-right  ] fa fa-sign-out"></span></a></li>

                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>


            <div class="nav navbar-nav navbar-right hidden-xs" style="padding-right: 20px" >
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <!-- Notifications: style can be found in dropdown.less -->
                    @yield('blingbling')



                    @if(!Auth::check())
                        <li class="dropdown notifications-menu">
                            <a href="" >
                                Agence
                            </a>

                        </li>
                        <li class="dropdown notifications-menu" id="" >
                            <a href="" >
                                Devenir Prestataire
                            </a>

                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="{{route('seConnecter')}}" >
                                <i class="fa fa-sign-in"></i> Se connecter
                            </a>

                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="{{route('inscription')}}" >
                                <i class="fa fa-user"></i> S'inscrire
                            </a>

                        </li>
                    @endif



                <!-- User Account: style can be found in dropdown.less -->
                    @if(Auth::check())
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-gears"></i>
                                <!--span class="label label-danger">9</span-->
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <!-- inner menu: contains the actual data -->

                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="">Mes Projets<i class="fa fa-gears pull-right"></i></a>
                                        </li>
                                    </ul>
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="{{route('monCompte')}}">Mon compte<i class="fa fa-gears pull-right"></i></a>
                                        </li>
                                    </ul>

                                    <ul class="menu ">
                                        <li><!-- Task item -->
                                            <a href="{{route('seDeconnecter')}}">Se déconnecter<i class="fa fa-sign-out pull-right"></i></a>
                                        </li>
                                    </ul>
                                </li>


                            </ul>
                        </li>

                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have @isset($messagesShare) {{count($messagesShare)}} @endisset messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">

                                        @isset($messagesShare)
                                            @foreach($messagesShare as $message)
                                                <li>
                                                    <a href="">
                                                        <div class="pull-left">
                                                            <img src="/{{$message->annonce->image[0]->url}}" class="img-circle" alt="User Image">
                                                        </div>
                                                        <h4>
                                                            {{$message->sender_name}}
                                                            <small><i class="fa fa-clock-o"></i> Today</small>
                                                        </h4>
                                                        <p> {{$message->message}}</p>
                                                    </a>
                                                </li>
                                            @endforeach @endisset

                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

    </header>
    <div class="row"  style="margin-top: 40px">
        @yield("mainEntete")
    </div>
    <!-- Content Wrapper. Contains page content -->
    <div class="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield("entete")

            </h1>
            <ol class="breadcrumb">
            @yield("rigthButton")
            <!--li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li-->
            </ol>
        </section>
        <section class="content " style="background-color: #fafafa">
            @yield("main_content")

        </section>
        <!-- /.content -->
    </div>
    <section id="footer">
        <div class="container">
            <div class="row text-center text-xs-center text-sm-left text-md-left">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <h5>Santé annonces</h5>
                    <ul class="list-unstyled quick-links">
                        <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Qui sommes-nous?</a></li>
                        <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Mentions légales</a></li>
                        <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>onditions générales du site</a></li>
                        <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Foire aux questions</a></li>
                        <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Nous contacter</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <h5>Nos services</h5>
                    <ul class="list-unstyled quick-links">
                        <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Annonces Premium</a></li>
                        <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Insertions publicitaires</a></li>
                        <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Vitrines en ligne</a></li>

                    </ul>
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                    <ul class="list-unstyled list-inline social text-center">
                        <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-google-plus"></i></a></li>
                        <li class="list-inline-item"><a href="javascript:void();" target="_blank"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div>
                </hr>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                    <!--p>National Transaction Corporation is a Registered MSP/ISO of Elavon, Inc. Georgia [a wholly owned subsidiary of U.S. Bancorp, Minneapolis, MN]</p>
                    <p class="h6">&copy All right Reversed.<a class="text-green ml-2" href="https://www.sunlimetech.com" target="_blank">Sunlimetech</a></p-->
                </div>
                </hr>
            </div>
        </div>
    </section>


</div>



<script src="{{url('/js/assets/jquery-1.8.3.min.js')}}"></script>


@yield("script")
<!-- jQuery UI 1.11.4 -->

<!-- Morris.js charts -->

<!-- AdminLTE App -->
<script src="{{url('/js/assets/adminlte.min.js')}}"></script>
@yield('js')
<script src="{{url('/js/assets/bootstrap.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- AdminLTE for demo purposes -->



</body>
