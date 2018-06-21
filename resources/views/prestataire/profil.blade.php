@extends('prestataire.layout')
@section("css")
    <style>
        .btnAddAnnonce
        {
            background-color: orange;
        }
        .thumbnail {
            padding:0;
        }
        .mypanel {
            position:relative;
            left: -20px;
        }
        .mypanel>.panel-heading:after,.panel>.panel-heading:before{
            position:absolute;
            top:11px;left:-16px;
            right:100%;
            width:0;
            height:0;
            display:block;
            content:" ";
            border-color:transparent;
            border-style:solid solid outset;
            pointer-events:none;
        }
        .mypanel>.panel-heading:after{
            border-width:7px;
            border-right-color:#f7f7f7;
            margin-top:1px;
            margin-left:2px;
        }
        .mypanel>.panel-heading:before{
            border-right-color:#ddd;
            border-width:8px;
        }
    </style>
@endsection
@section('blingbling')
    @if(\Illuminate\Support\Facades\Auth::check())
        @if(\Illuminate\Support\Facades\Auth::user()->isAgencyAdmin==1)
            <li class="dropdown notifications-menu center-block btnAddAnnonce " >
                <a href=""  class="">
                    <span ><i class="fa fa-star"></i> Dévenez une Agence Pro</span>
                </a>
            </li>
            @else
            <li class="dropdown notifications-menu center-block btnAddAnnonce " >
                <a href=""  class="">
                    <span ><i class="fa fa-star"></i> Dévenez Membre Pro</span>
                </a>
            </li>
        @endif
    @endif
@endsection
@section("mainEntete")
    <div class="col-lg-12 col-md-12" style="background-color:  #3c8dbc;padding-top: 15px" >
        <div class=" top-filter tfilter-box bottom" style="">
            <div class="container ">

            </div>
        </div>
        @endsection
        @section("main_content")
            <div class="row" style="">
                <div class="col-lg-3 col-md-3 " style="padding: 5px;margin-top: 15px" >
                    <div class="panel panel-primary hidden-xs hidden-sm" >

                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12" style="">
                    @if($type==1)
                        <div class="" >
                            <div class="modal-content">
                                <div class="modal-header">
                                   <p>
                                       <button class="btn btn-primary btnBack" title="Retour"><i class="fa fa-arrow-circle-left"></i> Retour</button>
                                   </p>
                                </div>
                                <div class="modal-body">
                                    <div class="row container-fluid">
                                        <img style="margin-right: 8px"  src="@if($agence->logo)/{{$agence->logo->url}} @else {{url('img/avatar.png')}} @endif" name="aboutme" width="140" height="140" border="0" class="img-circle pull-left"></a>
                                        <h4 class="media-heading" style="margin-bottom: 3px">{{$agence->raisonSocial}}</h4>
                                        <h4 class="media-heading "  style="margin-bottom: 3px"> Agence <small class="badge">Pro</small></h4>
                                        <h4 class="media-heading"  style="margin-bottom: 3px">Email:  <span style="font-size: 0.8em;color: #777"> {{$agence->email}}</span></h4>
                                        <h4 class="media-heading" style="margin-bottom: 3px">Tel : <span style="font-size: 0.8em;color: #777"> {{$agence->numero}}</span></h4>
                                        <h4 class="media-heading" style="margin-bottom: 3px">Status: <small><i class="fa fa-circle" style="color: green"></i> en ligne</small></h4>
                                        <h5 class="media-heading" style="margin-bottom: 3px"> Membre depuis {{date('d/m/Y', strtotime($agence->created_at))}}</h5>
                                        <h5 class="media-heading" style="margin-bottom: 3px;color: #ffd740">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half"></i>
                                        </h5>


                                    </div>
                                    <span><strong>Compétences: </strong></span>
                                    @foreach($agence->admin->technologies as $techno)
                                        <span class="label" style="background-color: {{$techno->coleur}};font-size: 0.9em">{{$techno->libelle}}</span>
                                    @endforeach

                                    <hr>
                                    <h4 style="text-decoration: underline;margin-bottom: 5px">Description</h4>
                                    <p class="text-left" >{{$agence->description}}</p>
                                    <br>
                                </div>
                                <div class="modal-footer">
                                    <center>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-envelope"></i> Envoyer un message</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-comments"></i> Chatter</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    @else

                            <div class="modal-content">
                                <div class="modal-header">
                                    <p>
                                        <button class="btn btn-primary btnBack" title="Retour"><i class="fa fa-arrow-circle-left"></i> Retour</button>
                                    </p>
                                </div>
                                <div class="modal-body">
                                    <div class="row container-fluid">
                                        <img style="margin-right: 8px"  src="@if($user->profil)/{{$user->profil->url}} @else {{url('img/avatar.png')}} @endif" name="aboutme" width="140" height="140" border="0" class="img-circle pull-left"></a>
                                        <h4 class="media-heading" style="margin-bottom: 3px">{{"$user->name $user->prenom"}} <small></small></h4>
                                        <h4 class="media-heading "  style="margin-bottom: 3px"> Freelancer <small class="badge">Pro</small></h4>
                                        <h4 class="media-heading"  style="margin-bottom: 3px">Email:  <span style="font-size: 0.8em;color: #777"> {{$user->email}}</span></h4>
                                        <h4 class="media-heading" style="margin-bottom: 3px">Tel : <span style="font-size: 0.8em;color: #777">{{$user->phone}}</span></h4>
                                        <h4 class="media-heading" style="margin-bottom: 3px">Status: <small><i class="fa fa-circle" style="color: green"></i> en ligne</small></h4>
                                        <h5 class="media-heading" style="margin-bottom: 3px"> Membre depuis {{date('d/m/Y', strtotime($user->created_at))}}</h5>
                                        <h5 class="media-heading" style="margin-bottom: 3px;color: #ffd740">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half"></i>
                                        </h5>


                                    </div>
                                    <span><strong>Compétences: </strong></span>
                                    @foreach($user->technologies as $techno)
                                        <span class="label" style="background-color: {{$techno->coleur}};font-size: 0.9em">{{$techno->libelle}}</span>
                                    @endforeach



                                    <hr>
                                    <h4 style="text-decoration: underline;margin-bottom: 5px">Description</h4>
                                    <p class="text-left text-summury" >
                                        {{$user->prestataire->description}}
                                    </p>
                                    <br>
                                </div>
                                <div class="modal-footer">
                                    <center>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-envelope"></i> Envoyer un message</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-comments"></i> Chatter</button>
                                    </center>
                                </div>
                            </div>

                    @endif
                </div>
                <div class="col-md-3 hidden-sm hidden-xs" style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <div class="" style="padding: 5px;margin-top: 15px" >
                                    <div class="panel panel-primary " >

                                        <div class="panel-body ">
                                            <p class="text-center" style="color: red">votre publicité ici</p>
                                            <p class="text-center" style="color: red"><img src="{{url('img/sen-delivery.png')}}" height="150"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="login-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white">&times;</span>
                    </button>
                    <h5 class="modal-title">Nouveau dévis</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="" id="reinitForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <label for="libelle">à combien pouvez réaliser ce projet?</label>
                        <div class="form-group input-group" style="margin-bottom: 0">
                            <input type="number"  class="form-control" id="montant" name="montant">
                            <span class="input-group-addon" style="background-color: #aab2bd;color: black;font-weight: bold">Fcfa</span>
                        </div>
                        <p style="color: red" id="errorMontant"></p>
                        <label for="libelle">en combien de jours pouvez réaliser ce projet?</label>
                        <div class="form-group input-group" style="margin-bottom: 0">
                            <input type="number"  class="form-control" id="duree" name="duree">
                            <span class="input-group-addon" style="background-color: #aab2bd;color: black;font-weight: bold">Jours</span>
                        </div>
                        <p style="color: red" id="errorDuree"></p>
                        <label for="libelle">Faite une pétite description par rapport à votre offre</label>
                        <div class="form-group" style="margin-bottom: 0">
                            <textarea class="form-control" rows="5" name="description" id="description"></textarea>
                        </div>
                        <p style="color: red;margin-top: 0" id="errorDescription"></p>
                    </form>
                    <div class="row">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary btn-large" id="btnValidate"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> ...">Valider</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="success-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white">&times;</span>
                    </button>
                    <h5 class="modal-title" id="tile-modal-location"></h5>
                </div>
                <div class="modal-body">
                    <p class="text-center text-primary" id="result"><i class="fa fa-check-circle fa-3x"></i></p>
                    <p class="text-center" id="succes-message"></p>
                    <div class="row">

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-large" data-dismiss="modal">Ok</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">

            <div class="loginmodal-container">

                <p class="text-center text-primary" id="result"><i class="fa fa-check-circle fa-3x"></i></p>
                <p class="text-center" id="succes-message"></p>
                <p class="text-center"><button class="btn btn-primary btn-large" data-dismiss="modal">Ok</button></p>
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" role="dialog" id="alert-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold;max-height: 20px;min-height: 60px">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white">&times;</span>
                    </button>
                    <h5 class="modal-title"> </h5>
                </div>
                <div class="modal-body">
                    <p class="text-center text-summury" id="succes-message">Pour faire un dévis, vous devriez vous connecter</p>
                    <p class="text-center"><a href="{{route('seConnecter',["next"=>"projets/"])}}" class="btn btn-primary " >Se connecter</a></p>
                    <p class="text-center"><a href="{{route('inscription')}}" class="btn btn-default">S'inscrire</a></p>
                    <p class="text-center"><button  class="btn btn-danger btn-large" data-dismiss="modal">Annuler</button></p>
                    <div class="row">

                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="loginmodal-container">

                <p class="text-center text-summury" id="succes-message">Pour faire une offre, vous devriez vous connecter</p>
                <p class="text-center"><a href="{{route('seConnecter')}}" class="btn btn-primary " >Se connecter</a></p>
                <p class="text-center"><a href="{{route('inscription')}}" class="btn btn-default">S'inscrire</a></p>
                <p class="text-center"><button  class="btn btn-danger btn-large" data-dismiss="modal">Annuler</button></p>
            </div>
        </div>
    </div>
@endsection
@include('footer')
@section('js')
    <script src="{{url('/js/assets/jquery-ui.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.uniform.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.inputlimiter.1.3.1.min.js')}}"></script>
    <script src="{{url('/js/assets/chosen.jquery.min.js')}}"></script>

    <script src="{{url('/js/assets/bootstrap-colorpicker.js')}}"></script>
    <script src="{{url('/js/assets/jquery.tagsinput.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.validVal.min.js')}}"></script>
    <script src="{{url('/js/assets/daterangepicker.js')}}"></script>
    <script src="{{url('/js/assets/moment.min.js')}}"></script>
    <script src="{{url('/js/assets/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('/js/assets/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{url('/js/assets/bootstrap-switch.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.dualListBox-1.3.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.autosize.min.js')}}"></script>

    <script src="{{url('/js/assets/formsInit.js')}}"></script>
    <script>
        $(function () {


            $(".btnBack").click(function () {
                window.history.back();
            });
            //Events that reset and restart the timer animation when the slides change
            $("#transition-timer-carousel").on("slide.bs.carousel", function(event) {
                //The animate class gets removed so that it jumps straight back to 0%
                $(".transition-timer-carousel-progress-bar", this)
                    .removeClass("animate").css("width", "0%");
            }).on("slid.bs.carousel", function(event) {
                //The slide transition finished, so re-add the animate class so that
                //the timer bar takes time to fill up
                $(".transition-timer-carousel-progress-bar", this)
                    .addClass("animate").css("width", "100%");
            });

            //Kick off the initial slide animation when the document is ready
            $(".transition-timer-carousel-progress-bar", "#transition-timer-carousel")
                .css("width", "100%");

            $('.carousel-inner').carousel({
                interval: 3000,
                cycle: true
            });
        });


    </script>
@endsection
<table class="pull-right">
    <tr>
        <th>test</th>
    </tr>
</table>