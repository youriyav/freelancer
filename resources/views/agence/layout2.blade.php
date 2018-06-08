@extends('prestataire.layout')
@section("css")
    <link rel="stylesheet" href="{{url('/css/prestataire/index.css')}}">
@endsection
@section('nav')
    <nav class="navbar navbar-static-top" style="min-height: 40px;">
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
                <button type="button" class="[ navbar-toggle ]" data-toggle="collapse" data-target="#bs-message">
                    <span class="sr-only">message</span>
                    <span class="fa fa-envelope"></span>
                </button>
                <button type="button" class="[ navbar-toggle ]" data-toggle="collapse" data-target="#bs-message">
                    <span class="sr-only">notifications</span>
                    <span class="fa fa-bell"></span>
                </button>
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

                    @if(Auth::check())
                        <li>
                            <a href="#" class="[ dropdown-toggle ][ animate ]" data-toggle="dropdown"><i class="fa fa-user-circle-o"></i> Mon compte<span class="[ caret ]"></span></a>
                            <ul class="[ dropdown-menu ]" role="menu">
                                <li><a href="{{route('mesProjets')}}" class="[ animate ]">Mes Projets <span class="[ pull-right  ] fa fa-briefcase"></span></a></li>
                                <li><a href="#" class="[ animate ]">Paramètres <span class="[ pull-right  ] fa fa-gears"></span></a></li>
                                <li><a href="#" class="[ animate ]">Mon Profil <span class="[ pull-right  ] fa fa-user"></span></a></li>
                                <li><a href="#" class="[ animate ]">Se déconnecter <span class="[ pull-right  ] fa fa-sign-out"></span></a></li>

                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="[ collapse navbar-collapse ]" id="bs-message">
                <ul class="[ nav navbar-nav navbar-right ]">
                    <li><a href="#" class="[ animate ]">Agence</a></li>
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
                                        <a href="{{route('mesProjets')}}">Mes Projets<i class="fa fa-gears pull-right"></i></a>
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
                    <li class="dropdown messages-menu" id="btnNotification">
                        <a href="#"  class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            @isset($Glog_notifications)

                                <span class="label label-danger hidden" id="nbrNotification">0</span>
                            @endisset
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">vous avez @isset($Glog_notifications) {{count($Glog_notifications)}} @endisset notification (s)</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu" id="menuNotifications">

                                    @isset($Glog_notifications)
                                        @foreach($Glog_notifications as $notif)
                                            <li>
                                                <a href="{{$notif->url}}">
                                                    <i class="fa fa-hand-o-up"></i> {{$notif->libelle}}
                                                </a>
                                            </li>
                                        @endforeach @endisset
                                </ul>
                            </li>
                            <!--li class="footer"><a href="#">See All Messages</a></li-->
                        </ul>
                    </li>

                    <li class="dropdown messages-menu" id="btnMessage">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            @isset($Glog_messages)
                                <span class="label label-danger hidden" id="nbrMessage">0</span>
                        @endisset
                        <!--span class="label label-warning">4</span-->
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">vous avez @isset($Glog_messages) {{count($Glog_messages)}} @endisset messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu" id="menu-message">

                                    @isset($Glog_messages)
                                        @foreach($Glog_messages as $message)
                                            <li class="receive-message">
                                                <a href="{{route('conversation',["slug"=>$message->offre->projet->slug->content,"user"=>$message->sender->id])}}">
                                                    <div class="pull-left">
                                                        <img src="@if($message->sender->profil)/{{$message->sender->profil->url}} @else {{url('img/avatar.png')}} @endif" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        {{$message->sender->login}}
                                                        <small><i class="fa fa-clock-o"></i>{{getDureeFromCarbone($message->created_at)}}</small>
                                                    </h4>
                                                    <p> {{$message->message}}</p>
                                                </a>
                                            </li>
                                        @endforeach @endisset

                                </ul>
                            </li>
                            <!--li class="footer"><a href="#">See All Messages</a></li-->
                        </ul>
                    </li>

                @endif
            </ul>
        </div>
    </nav>
@endsection
@section("main_content")

@endsection
@include('footer')
