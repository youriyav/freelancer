<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url('/css/assets/bootstrap.css')}}" />
    <link href="{{url('/css/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{url('/css/assets/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/assets/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/assets/AdminLTE.min.css')}}">
    @yield('css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="" >
    <header class="main-header" style="min-height: 70px;padding-top: 0;background-color:  #3c8dbc">
        <nav class="navbar navbar-static-top" >

            <a href="" class="brand" style="background-color: #3c8dbc">
                <h2 class="pull-left"><a href="{{route('indexPrestataire')}}" style="color: white">Jesuis-freelance</a></h2>
                <!--img src="{{ url('/img/sante-annonces-logo.png') }}" class="img-circle" alt="User Image"-->
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

                    @yield('blingbling')
                    <li class="dropdown notifications-menu">
                        <a href="{{route('noTarifs')}}" >
                            <i class="fa fa-money"></i> Nos Tarifs
                        </a>
                    </li>
                    @if(!Auth::check())
                        <li class="dropdown notifications-menu">
                            <a href="{{route('inscription')}}" >
                                <i class="fa fa-user"></i> Devenir Prestataire
                            </a>
                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="{{route('seConnecter')}}" >
                                <i class="fa fa-sign-in"></i> Se connecter
                            </a>
                        </li>
                    @endif
                    @if(Auth::check())
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-gears"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <ul class="menu">
                                        <li>
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
                            </ul>
                        </li>

                        <li class="dropdown messages-menu" id="btnMessage">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                @isset($Glog_messages)
                                    <span class="label label-danger hidden" id="nbrMessage">0</span>
                                @endisset
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">vous avez @isset($Glog_messages) {{count($Glog_messages)}} @endisset messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu" id="menu-message">
                                        
                                    </ul>
                                </li>
                            </ul>
                        </li>

                    @endif
                </ul>
            </div>
        </nav>

            @yield('mainEntete')


    </header>
    <div class="row container-fluid">
        <section class="content " style="background-color: #fafafa;padding-right: 18px;">
            @yield("main_content")
        </section>
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
                <div class="col-xs-12 col-sm-4 col-md-4">

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

<script src="{{url('/js/assets/adminlte.min.js')}}"></script>
@yield('js')
<script src="{{url('/js/assets/bootstrap.min.js')}}"></script>
<script>
    var lastNotificationId=0;
    var lastMessageId=0;
    var isConversationPage=0;
    var nbrNewMessageToNotif=0;
    function  updateNotification(nbr) {
        if(nbr==0)
        {
            $("#nbrNotification").text(0);
            $("#nbrNotification").addClass('hidden')
        }
        else
        {
            $("#nbrNotification").text(parseInt($("#nbrNotification").text())+nbr);
            $("#nbrNotification").removeClass('hidden');
        }
    }
    function  updateMessage(nbr) {
        if(nbr==0)
        {
            $("#nbrMessage").text(0);
            $("#nbrMessage").addClass('hidden')
        }
        else
        {
            $("#nbrMessage").text(parseInt($("#nbrMessage").text())+nbr);
            $("#nbrMessage").removeClass('hidden');
        }
    }
    $(function () {
        @if(isset($isConversation))
            isConversationPage=1;
        @endif
        @if(isset($Glog_notifications))
            updateNotification({{count($Glog_notifications)}});
        @endif
        @if(isset($Glog_messages))
            updateMessage({{count($Glog_messages)}});
        @endif

        $("#btnNotification").click(function () {
            updateNotification(0);
        });
        $("#btnMessage").click(function () {
            updateMessage(0);
        });
        @if(Auth::check())
        setInterval(function () {
            $.ajax({
                url :"/update-notification-message/"+lastNotificationId+"/"+lastMessageId,
                type : "get",
               // async:false,
                success : function(json)
                {
                    data=JSON.parse(json);
                    console.log(data);
                    var messages=data.messages;
                    var notifications=data.notifications;
                    console.log(messages);
                    type="";
                    _htmlMessage="";
                    message='[';
                    var nbrNewMessage=0;
                    var tmpNbrNonLus;
                    tmpNbrNonLus=0;
                    if (isConversationPage ==1)
                    {
                        for(i=0;i<prestataires.length;i++)
                        {
                            prestataire=prestataires[i];
                            //prestataire.nonLu=0;
                        }
                    }
                    nbrNewMessageToNotif=0;//parseInt(parseInt($("#nbrMessage").text()));
                    idMessage=0;
                    for(i=0;i<messages.length;i++)
                    {
                        idMessage=parseInt(messages[i].id)
                        _htmlMessage+='<li class="receive-message">';
                        _htmlMessage+='<a href="/conversation/'+messages[i].slug+'/?user='+messages[i].id+'">';
                        _htmlMessage+='<div class="pull-left">';
                        _htmlMessage+='<img src="/'+messages[i].profil+'" class="img-circle" alt="User Image">';
                        _htmlMessage+='</div>';
                        _htmlMessage+='<h4>'+messages[i].login+'';
                        _htmlMessage+='<small><i class="fa fa-clock-o"></i>'+messages[i].date+'</small>';
                        _htmlMessage+='</h4>';
                        _htmlMessage+='<p> '+messages[i].content+'</p>';
                        _htmlMessage+='</a> </li>';
                        $("#menu-message").append(_htmlMessage);
                        if (isConversationPage ==1)
                        {
                            if(messages[i].id==currentId)
                            {
                                if(nbrNewMessage!=0)
                                {
                                    message+=',';
                                }
                                message+='{';
                                text=messages[i].content;
                                membre_id=messages[i].id;
                                receiver_id=messages[i].id_receiver;
                                created_at=messages[i].date;
                                lastMessageId=messages[i].idMessage;
                                if(membre_id!= parseInt({{Auth::user()->id}}))
                                {
                                    type="sender";
                                }
                                else
                                {
                                    type="receiver";
                                }
                                message+='"content":"'+text+'",';
                                message+='"type":"'+type+'",';
                                message+='"date":"'+created_at+'"';
                                message+='}';
                                nbrNewMessage++;
                            }
                            else
                            {
                                for(i=0;i<prestataires.length;i++)
                                {
                                    prestataire=prestataires[i];
                                    if(prestataire.id==idMessage )
                                    {
                                        prestataire.nonLu++;
                                        nbrNewMessageToNotif++;
                                    }
                                }
                            }
                        }
                        else
                        {
                            if(messages.length>0)
                            {
                                nbrNewMessageToNotif++;
                            }
                        }
                    }
                    _htmlNotif="";
                    for(i=0;i<notifications.length;i++)
                    {
                        notif=notifications[i];
                        _htmlNotif+='<li>';
                        _htmlNotif+='<a href="'+notif.url+'">';
                        _htmlNotif+='<i class="fa fa-hand-o-up">'+notif.libelle+'</i>';
                        _htmlNotif+='</li>';
                    }
                    $("#menuNotifications").append(_htmlNotif);
                    console.log("nbrNotif: "+notifications.length);
                    if(notifications.length!=0)
                    {
                        updateNotification(notifications.length);
                    }
                    if(nbrNewMessageToNotif!=0)
                    {
                        updateMessage(nbrNewMessageToNotif);
                    }
                    if (isConversationPage ==1)
                    {
                        updateListPrestataire();
                    }
                    message+=']';
                    if(isConversationPage==1)
                    {
                        addMessageToConversation(message,0);
                    }
                },
                error :function(xhr,errmsg,err)
                {
                    console.log(xhr);
                }
            });

        },5000);
        @endif
    });
</script>
</body>