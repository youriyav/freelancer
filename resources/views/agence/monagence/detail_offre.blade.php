@extends('prestataire.layout2')

@section('css')

    <link rel="stylesheet" href="{{url('/css/assets/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/assets/bootstrap-wysihtml5-0.0.2.css')}}">
    <link rel="stylesheet" href="{{url('/css/assets/Markdown.Editor.hack.css')}}">
    <link rel="stylesheet" href="{{url('/css/assets/jquery.cleditor.css')}}">
    <link rel="stylesheet" href="{{url('/css/assets/jquery.cleditor-hack.css')}}">
    <link rel="stylesheet" href="{{url('/css/assets/bootstrap-wysihtml5-hack.css')}}">
    <style>
        ul.wysihtml5-toolbar > li {
            position: relative;
        }
    </style>
@endsection
@section('main_content')
    <div class="row">
        <div class="col-lg-3 col-md-2 hidden-sm hidden-xs"style="padding: 5px" >
            <div class="panel panel-primary" >
                <div class="panel-title panel-heading">
                    <h3 class=" text-center ">Comment ça marche?</h3>
                </div>
                <div class="panel-body ">
                    <ul class="list-group">
                        <li class="list-group-item" style="color: #428bca"><span style="font-weight: bold;font-size: 1.3em;float: left">1. </span> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px;">Le client dépose un projet</span></li>
                        <li class="list-group-item" style="color: #428bca"><span style="font-weight: bold;font-size: 1.3em;float: left">2. </span> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px;">Les freelances proposent des devis</span></li>
                        <li class="list-group-item" style="color: #428bca"><span style="font-weight: bold;font-size: 1.3em;float: left">3. </span> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px;">Ils échangent sur la messagerie privée</span></li>
                        <li class="list-group-item" style="color: #428bca"><span style="font-weight: bold;font-size: 1.3em;float: left">4. </span> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px;">Le client choisit un prestataire</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="row">
                    <div class="col-md-12 media-list" style="padding: 5px;margin: 0">
                        <a class="pull-left" href="#">
                            <img class="media-object img-circle" height="40" width="40"  src="@if($offre->user->profil)/{{$offre->user->profil->url}} @else {{url('img/avatar.png')}} @endif" alt="profile">
                        </a>
                        <a href="" class="media-heading reviews"> &nbsp;{{$offre->user->login}} </a>
                        <div class="media-body">
                            <div class="well well-lg">


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
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="box">
                                            <div class="collapse" id="offre{{$offre->id}}">
                                                <div class="panel panel-default">
                                                    <div class="panel-footer">

                                                    <form>
                                                        <textarea rows="4" id="" type="text" style="margin-bottom: 8px" class="form-control txtMessage"></textarea>
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
                                <!--div class="row body collapse in" id="offre{{$offre->id}}" >
                                    <div class="col-lg-12">
                                        <div class="box">
                                            <header>

                                            </header>

                                            <div id="cleditorDiv" >
                                                <form  style="height: 300px" class="" id="test">
                                                    <textarea id="cleditor" class="form-control"></textarea>

                                                    <div class="form-actions no-margin-bottom" id="cleditorForm">
                                                        <br />
                                                        <p class="text-right"><input type="submit" value="Envoyer" class="btn btn-primary" /></p>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div-->

                            </div>

                        </div>
                    </div>

            </div>
        </div>



            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs"style="padding: 5px;" >
                <div class="panel panel-primary" >
                    <div class="panel-title panel-heading">
                        <h5 class=" text-center ">Profil du freelance</h5>
                    </div>
                    <div class="panel-body ">
                        <div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
                            <img src="/@if($offre->user->profil)/{{$offre->user->profil->url}} @else {{url('img/avatar.png')}} @endif" class="img img-responsive img-thumbnail">
                            <p class="text-center" style="margin-bottom: 0"><a href="">{{$offre->user->login}}</a></p>
                        </div>
                        <div class="row" style="padding-left: 5px">

                            <p class="text-center">Membre {{getDureeFromCarbone($offre->user->created_at)}}</p>
                            <h6 class="text-primary" style="margin-bottom: 0">Compétences</h6>
                            <p class=""> @foreach($offre->user->technologies as $techno) <span class="badge" style="margin-bottom: 5px">{{$techno->libelle}}</span> @endforeach </p>
                            <h6 class="text-primary" style="margin-bottom: 0">Langues parlées</h6>
                            <p class=""> @foreach($offre->user->langues as $langue) <span class="text-summury" style="margin-bottom: 5px">{{$langue->libelle}},</span> @endforeach </p>
                        </div>
                    </div>
                </div>
            </div>





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
@section('js')
<script src="{{url('/js/assets/notify.min.js')}}"></script>
<script src="{{url('/js/assets/wysihtml5-0.3.0.js')}}"></script>
<script src="{{url('/js/assets/bootstrap-wysihtml5-hack.js')}}"></script>
<script src="{{url('/js/assets/jquery.cleditor.min.js')}}"></script>

<script src="{{url('/js/assets/Markdown.Converter.js')}}"></script>
<script src="{{url('/js/assets/Markdown.Sanitizer.js')}}"></script>
<script src="{{url('/js/assets/Markdown.Editor-hack.js')}}"></script>

<script src="{{url('/js/assets/editorInit.js')}}"></script>


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
            //formWysiwyg();

        });
    </script>


@endsection()