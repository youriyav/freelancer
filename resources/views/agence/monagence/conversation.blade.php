@extends('prestataire.layout2')
@section('menu')
    <ul class="nav nav-list" >
        <li class="nav-header">Mon Compte</li>
        <li ><a href="{{route('monCompte')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active "><a href="{{route('mesProjets')}}"><i class="fa fa-briefcase"></i> Mes Projets</a></li>
        <li><a href="{{route('mesCompetences')}}"><i class="fa fa-sitemap"></i> Mes compétences</a></li>
    </ul>
@endsection()
@section('css')
    <link rel="stylesheet" href="{{url('/css/prestataire/conversation.css')}}" />
@endsection
@isset($message)
@section('header_content')
    <div style="border: solid 1px #3c8dbc;width: 350px;border-radius: 10px;margin: auto;margin-top: 30px;padding: 10px; " class="center-align">
        <p class="text-center"><i style="color: #3c8dbc" class="fa fa-check-circle fa-3x"></i></p>
        <p class="text-center">
           {!! $message !!}
        </p>
    </div>
@endsection()@endisset
@section('main_content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel with-nav-tabs panel-default">
                    <div class="panel-heading">
                        <h4 class="text-primary">{{$projet->titre}}</h4>
                    </div>
                    <div class="panel-body">
                        <button class="btn " data-toggle="collapse" href="#detail">...</button>
                        <div class="tab-content collapse"  id="detail">
                            <div class="text-summury">{{$projet->description}}</div>
                            <div class="competences">
                                <h6>compétences requises</h6>
                                <div style="margin-left: 15px">
                                    @foreach($projet->competences as $techno )
                                        <button class="alert alert-info" style="padding: 3px;margin: 0">{{$techno->libelle}} </button>
                                    @endforeach</div>

                            </div>
                            @if($projet->user->id!=Auth::user()->id)
                                <h4>votre offre</h4>
                                <div class="col-md-12" style="padding: 5px;margin: 0">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle" height="100" width="100"  src="@if($offre->user->profil)/{{$offre->user->profil->url}} @else {{url('img/avatar.png')}} @endif" alt="profile">
                                    </a>
                                    <div class="media-body">
                                        <div class="well well-lg">
                                            <h4 class="media-heading text-uppercase reviews">{{$offre->user->login}} </h4>

                                            <p class="text-summury"  style="font-weight: bold;margin:0px">Montant: {{$offre->prix}} Fcfa </p>
                                            <p class="text-summury"  style="font-weight: bold;margin:0px">Durée d'exécution: {{$offre->duree}} Jours </p>

                                            <p class="media-comment ">
                                                {{$offre->description}}
                                            </p>
                                            <p><i class="fa fa-clock-o"></i> {{getDureeFromCarbone($offre->created_at)}}</p>
                                            <!--a class="btn btn-warning btn-circle text-uppercase" data-toggle="collapse" href="#replyOne"><span class="glyphicon glyphicon-comment"></span> 2 comments</a-->
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <p class="pull-right"> <i class="fa fa-clock-o"></i>&nbsp;{{getDureeFromCarbone($projet->created_at)}}
                        &nbsp;&nbsp;<i class="fa fa-eye"></i> {{$projet->nbrVue}} vue(s)&nbsp;&nbsp;<i class="fa fa-hand-o-up"> </i>&nbsp;&nbsp;{{count($projet->offres)}} offre(s)&nbsp;<i class="fa fa-money"></i> Budget {{$projet->budget->libelle}} Fcfa</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">


        <div class="app col-md-9 col-md-offset-1" style="padding: 10px;">
            <h4></h4>
            <div class="row app-one" style="height: 550px">
                <div class="col-sm-4 side" >
                    <div class="side-one">
                        <div class="row heading">
                            <div class="col-sm-3 col-xs-3 heading-avatar">
                                <div class="heading-avatar-icon">
                                    <img src="@if(Auth::user()->profil)/{{Auth::user()->profil->url}} @else {{url('img/avatar.png')}} @endif">
                                    <small class="pull-right">vous</small>
                                </div>
                            </div>
                            <div class="col-sm-1 col-xs-1  heading-dot  pull-right">
                                <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
                            </div>
                            <div class="col-sm-2 col-xs-2 heading-compose  pull-right">
                                <i class="fa fa-comments fa-2x  pull-right" aria-hidden="true"></i>
                            </div>
                        </div>

                        <div class="row searchBox">
                            <div class="col-sm-12 searchBox-inner">
                                <div class="form-group has-feedback">
                                    <input id="searchText" type="text" class="form-control" name="searchText" placeholder="Rechercher">
                                    <span class="fa fa-search form-control-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row sideBar">
                            @foreach($users as $prest)
                                    <div class="row sideBar-body" id="conv_{{$prest->id}}" style="border-bottom: solid 1px #4db6ac ">
                                        <div class="col-sm-3 col-xs-3 sideBar-avatar">
                                            <div class="avatar-icon">
                                                <img src="@if($prest->profil)/{{$prest->profil->url}} @else {{url('img/avatar.png')}} @endif">
                                            </div>
                                        </div>
                                        <div class="col-sm-9 col-xs-9 sideBar-main">
                                            <div class="row" style="margin-bottom: 0">
                                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                                    <span class="name-meta" style="font-weight: bold">{{$prest->login}}</span>
                                                </div>
                                                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                                    <span class="time-meta pull-right">18:18</span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="col-sm-10 col-xs-10 ">
                                                    sdsd
                                                </div>
                                                <div class="col-sm-2 col-xs-2 pull-right    ">
                                                    <span class="badge nbrNonLu hidden" style="background-color: #4db6ac">1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-sm-8 conversation" style="overflow-y: auto;">
                    <div class="row heading">
                        <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
                            <div class="heading-avatar-icon">
                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" id="imgUser" hidden>
                            </div>
                        </div>
                        <div class="col-sm-8 col-xs-7 heading-name">
                            <a class="heading-name-meta " id="nameOfUser" ></a>
                            <span class="heading-online" style="color: black">En ligne</span>
                        </div>
                        <div class="col-sm-1 col-xs-1  heading-dot pull-right">
                            <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
                        </div>
                    </div>
                    <button id="btn_loader" class="center-block hidden btn btn-primary"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Chargement..."></button>
                    <div class="row message" id="conversation">
                    </div>

                    <div class="row reply fixed">
                        <div class="col-sm-1 col-xs-1 reply-emojis">
                            <i class="fa fa-smile-o fa-2x"></i>
                        </div>
                        <div class="col-sm-9 col-xs-9 reply-main">
                            <form id="messageForm" >
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="idReceiver" value="" id="idReceiver">
                                <input type="hidden" name="idProjet" value="{{$projet->id}}" id="idProjet">
                                <textarea name="message" class="form-control" rows="1" id="comment" disabled></textarea>
                            </form>
                        </div>
                        <div class="col-sm-1 col-xs-1 reply-send" >
                            <i class="fa fa-send fa-2x" aria-hidden="true" id="btn-send" style="color: #3c8dbc;"></i><!--button class="btn btn-sm" style="background-color: white;margin-top: -8px;"></button-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-2 hi" style="border: solid 1px cornflowerblue;margin-top: 100px;min-height: 150px">
            <img src="{{url('img/sen-delivery.png')}}" height="150">
        </div>

    </div>
@endsection()

@section('js')
<script src="{{url('/js/assets/notify.min.js')}}"></script>

    <script>
        var check=0;
        var blocConversation=$('#conversation');
        var messageForm=$('#messageForm');
        var txtMessage=$('#comment');
        var oldBloc=null;
        var lastMessageId=0;
        var currentId=0;
        var message='[]';
        var prestataires=[];
        function updateListPrestataire() {
            for(i=0;i<prestataires.length;i++)
            {
                prestataire=prestataires[i];
                id="conv_"+prestataire.id;
                $currentUserBloc=$("#"+id);
                $badge=$currentUserBloc.find(".nbrNonLu");
                if(prestataire.nonLu!=0)
                {
                    $badge.removeClass('hidden');
                }
                else
                {
                    $badge.addClass('hidden');
                }
                $badge.text(prestataire.nonLu);
            }
        }
        $(function () {
            @foreach($users as $prest)
                    nbrNonLu=0;
                    @foreach($messagesNonLus as $message)
                      @if($message->sender->id==$prest->id)
                        nbrNonLu++;
                      @endif
                    @endforeach
                prest={};
                prest.id='{{$prest->id}}';
                prest.nonLu=nbrNonLu;
                prestataires.push(prest);
            @endforeach
            updateListPrestataire();
            $('#btn-send').click(function () {
                if($('#comment').val().toString()!="")
                {
                    var today = new Date();
                    var hour = today.getHours();
                    var min = today.getMinutes();
                    if(hour<10) {
                        hour = '0'+hour
                    }
                    if(min<10) {
                        min = '0'+min
                    }
                    dateMessage=hour+":"+min;
                    textMessage=$('#comment').val().toString();
                    message='[{"content":"'+textMessage+'","type":"receiver","date":"'+dateMessage+'"}]';
                    addMessageToConversation(message);
                    messageForm.submit();
                    message="[]";

                }
            });
            $('.sideBar-body').click(function () {
                if(oldBloc!=null)
                {
                    oldBloc.css({"backgroundColor":'white'});
                }
                oldBloc=$(this);
                currentId=$(this).prop('id').split('_')[1];
                nbrNonLus=parseInt(oldBloc.find('.nbrNonLu').first().text());
                console.log(nbrNonLus);
                $("#idReceiver").val(currentId);
                $(this).css({"backgroundColor":'#aeeaef'});
                $('#imgUser').prop("src",$(this).find('img').prop('src'));
                $('#comment').prop("disabled",false);
                $("#imgUser").show();
                $("#nameOfUser").text($(this).find('span').text());
                $("#nameOfUser").show();
                data=JSON.parse(message);
                blocConversation.html("");
                $("#btn_loader").removeClass('hidden')
                $("#btn_loader").button('loading');
                $.ajax({
                    url :"/loadMessage/{{$projet->slug->content}}/"+currentId,
                    type : "get",
                    async:true,
                    success : function(json)
                    {
                        $('#comment').val('');
                        data=json;//JSON.parse(json);

                        type="";
                        message='[';
                        for(i=0;i<data.length;i++)
                        {
                            message+='{';
                            text=data[i].message;
                            membre_id=data[i].sender_id;
                            receiver_id=data[i].receiver_id;
                            created_at=data[i].created_at;
                            lastMessageId=data[i].id;
                            if(membre_id!={{Auth::user()->id}})
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
                            if(i!=data.length-1)
                            {
                                message+=',';
                            }
                        }
                        if(nbrNonLus!=0) {
                            totalMessage=0;
                            $(".receive-message").each(function (i, element) {
                                console.log(element);
                                tmpId = $(this).find('a').first().prop("href").split('?user=')[1];
                                console.log(tmpId);
                                if(tmpId==currentId)
                                {
                                    $(this).remove();
                                }
                                totalMessage++;
                            });
                            updateMessage(totalMessage - nbrNonLus);
                        }
                        message+=']';
                        if(data.length!=0)
                        {
                            updateConversation(lastMessageId);
                        }
                        addMessageToConversation(message,1);
                        for(i=0;i<prestataires.length;i++)
                        {
                            prestataire=prestataires[i];
                            if(prestataire.id==currentId)
                            {
                                prestataire.nonLu=0;
                            }
                        }
                        updateListPrestataire();
                        $("#btn_loader").button('reset');
                        $("#btn_loader").addClass('hidden');
                    },
                    error :function(xhr,errmsg,err)
                    {
                       // console.log(xhr);
                    }

                });
            });
            @isset($selected)
                $("#conv_{{$selected->id}}").click();
                $("#idReceiver").val({{$selected->id}});
            @endisset
            messageForm.submit(function (e) {
                $.ajax({
                    url :"{{route('chattMessage')}}",
                    data:new FormData(this),
                    processData: false,
                    contentType: false,
                    type : "post",
                    success : function(json)
                    {
                        $('#comment').val('');
                    },
                    error :function(xhr,errmsg,err)
                    {

                    }
                });
                e.preventDefault();
            });

            //updateConversation(lastMessageId);

        });
        function  updateConversation(lastId) {

        }
        function addMessageToConversation(tabJson,type)
        {
            data=JSON.parse(tabJson);
            _html="";
            for(i=0;i<parseInt(data.length);i++)
            {
                type=data[i].type;
                if(type=="sender")
                {
                    senderMessage=data[i].content;
                    dateMessage=data[i].date;
                    tmpSender='<div class="row message-body">\n' +
                        '                        <div class="col-sm-12 message-main-sender">' +
                        '                            <div class="sender">' +
                        '                                <div class="message-text">' + senderMessage +
                        '                                </div>' +
                        '                                <span class="message-time pull-right">'+dateMessage+'</span>' +
                        '                            </div>' +
                        '                        </div>' +
                        '                    </div>';
                    _html+=tmpSender;
                }
                else
                {
                    receiverMessage=data[i].content;
                    dateMessage=data[i].date;
                    tmpReceiver='<div class="row message-body">\n' +
                        '                        <div class="col-sm-12 message-main-receiver">' +
                        '                            <div class="receiver">' +
                        '                                <div class="message-text">' +receiverMessage+
                        '                                </div>' +
                        '                                <span class="message-time pull-right">'+dateMessage+'</span>' +
                        '                            </div>' +
                        '                        </div>' +
                        '                    </div>';
                    _html+=tmpReceiver;
                }

            }
            blocConversation.append(_html);
            if($("#conversation").height()>$(".app-one").height()){
                $("#conversation").css("bottom", "auto");
            }
            $('.app-one').scrollTop($('#conversation').scrollHeight);

            //shouldScroll = blocConversation.scrollTop + blocConversation.clientHeight === blocConversation.scrollHeight;
            //if (!shouldScroll) {
            //    scrollToBottom();
           // }
        }
        function scrollToBottom() {
            blocConversation.scrollTop = blocConversation.scrollHeight;
        }
    </script>


@endsection()