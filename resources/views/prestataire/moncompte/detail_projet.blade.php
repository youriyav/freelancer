@extends('prestataire.moncompte.layout')
@section('menu')
    <ul class="nav nav-list" >
        <li class="nav-header">Mon Compte</li>
        <li ><a href="{{route('monCompte')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active "><a href="{{route('mesProjets')}}"><i class="fa fa-briefcase"></i> Mes Projets</a></li>
        <li><a href="{{route('mesCompetences')}}"><i class="fa fa-sitemap"></i> Mes compétences</a></li>
    </ul>
@endsection()
@section('compte_css')
    <link rel="stylesheet" href="{{url('/css/prestataire/modal.css')}}" />
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
@section('main_content_compte')
    <a href="{{route('mesProjets')}}"><i class="fa fa-arrow-left "></i> Mes projets</a>
    <div class="panel panel-default">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                <h4 class="text-primary">{{$projet->titre}}</h4>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="text-summury">{{$projet->description}}</div>
                    <div class="competences">
                        <h6>compétences requises</h6>
                        <div style="margin-left: 15px">
                            @foreach($projet->competences as $techno )
                                <button class="alert alert-info" style="padding: 3px;margin: 0">{{$techno->libelle}} </button>
                            @endforeach</div>

                    </div>
                </div>
            </div>
            <p class="pull-right"> <i class="fa fa-clock-o"></i>&nbsp; {{getDureeFromCarbone($projet->created_at)}}
                &nbsp;&nbsp;<i class="fa fa-eye"></i> {{$projet->nbrVue}} vue(s)&nbsp;&nbsp;<i class="fa fa-hand-o-up"> </i>&nbsp;&nbsp;{{count($projet->offres)}} offre(s)&nbsp;<i class="fa fa-money"></i> Budget {{$projet->budget->libelle}} Fcfa</p>
        </div>

    </div>
    <div class="row">
        @foreach($projet->offres as $offre)
            <div class="col-md-12 media-list" style="padding: 5px;margin: 0">
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
                    <p class="text-right">
                        <a  href="#offre{{$offre->id}}" title="envoyer un message" class="btn btn-info btn-circle" data-toggle="collapse"  id="reply"><i class="fa fa-envelope"></i> message à {{$offre->user->login}} </a>
                        <a href="{{route('attribuerProjetUser',['slug'=>$projet->slug->content,'user'=>$offre->user->id])}}" class="btn btn-circle btn-attribuer"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> attribution..."><i class="fa fa-link "></i> Attribuer à {{$offre->user->login}} le projet</a>
                    </p>
                        <div class="collapse" id="offre{{$offre->id}}">
                            <div class="panel panel-default">
                                <div class="panel-footer">
                                    <form>
                                        <textarea rows="4" id="" type="text" style="" class="form-control txtMessage"></textarea>
                                        <div class="text-right" >
                                            <button title="cliquez ici pour envoyer votre message" id="{{$offre->id}}" class="btn btn-primary btn-circle btnSendMessage" type="button" data-loading-text="<i class='fa fa-spinner fa-spin '></i> envoie..."><span class="fa fa-send"></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach

    </div>



@endsection()
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">

        <div class="loginmodal-container">
            <div class="modal-header" style="background-color: blue">
                <h4 class="modal-title"></h4>
            </div>
            <p class="text-center text-primary" id="result"><i class="fa fa-check-circle fa-3x"></i></p>
            <p class="text-center" id="succes-message"></p>
            <p class="text-center"><button class="btn btn-primary btn-large" data-dismiss="modal">Ok</button></p>
        </div>
    </div>
</div>

<div id="success" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #3c8dbc">
                <h4 class="modal-title"></h4>
                <br>
            </div>
            <div class="modal-body">
                <p class="text-summury text-center">Une fois attribué à un prestataire, le projet ne sera plus viblible au niveau de la plateforme </p>
                <p class="text-summury text-center">Voulez vous continuer</p>
            </div>
            <div class="modal-footer">

                    <button class="btn btn-danger" data-dismiss="modal" style="margin-right: 10px">Annuler</button>
                    <button class="btn btn-primary" id="btn-continuer"> Continuer</button>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dalog -->
</div>
@section('compte_js')
<script src="{{url('/js/assets/notify.min.js')}}"></script>

    <script>
        var currentBtn;
        $(function () {
           // $.notify("Hello World","success");
            $("#btn-continuer").click(function (e) {
                $("#success").modal('toggle');
                currentBtn.button('loading');
                $.ajax({
                    url :url,
                    type : "get",
                    async:true,
                    success : function(json)
                    {
                        data=json;//JSON.parse(json);
                        console.log(json);
                        $this.button('reset');
                    },
                    error :function(xhr,errmsg,err)
                    {
                        // console.log(xhr);
                    }
                });
            });
            $(".btn-attribuer").click(function (e) {
                $this=$(this);
                currentBtn=$this;
                url=$this.prop('href');
                e.preventDefault();
                //$this.removeClass('hidden')
                $("#success").modal('toggle');
            });
            $(".btnSendMessage").click(function (e) {
                $this=$(this);
                $txtMessage=$(this).parent().parent().find('.txtMessage');

                if($txtMessage.val()!="")
                {
                    $this.button('loading');
                    $txtMessage.prop('disabled','disabled');
                    @if(Auth::check())
                        route="/send-message";
                        data={"idOffre":$this.prop('id'),"message":$txtMessage.val(),"_token":"<?php echo csrf_token() ?>"};
                    $.ajax({
                        url :route,
                        data:data,
                        type : "post",
                        success : function(json)
                        {
                            res=JSON.parse(json);
                            console.log(res);
                            $txtMessage.notify(res.message,"info");
                            $txtMessage.removeProp('disabled');
                            $txtMessage.val("");
                            $this.button('reset');
                        },
                        error :function(xhr,errmsg,err)
                        {
                            console.log(xhr);
                            $this.button('reset');
                            $txtMessage.removeProp('disabled');
                            $txtMessage.notify("erreur lors de l'envoie");
                        }
                    });
                    @endif
                }
                else
                {
                    $txtMessage.notify("veuillez écrire quelque chose");
                }
            });
        });
    </script>


@endsection()