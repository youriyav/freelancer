@extends('prestataire.layout')
@section("css")
    <link rel="stylesheet" href="{{url('/css/prestataire/index.css')}}">
    <style>
        .btnAddAnnonce
        {
            background-color: orange;
        }
    </style>
@endsection
@section('blingbling')
    @if(\Illuminate\Support\Facades\Auth::check())
        <li class="dropdown notifications-menu center-block btnAddAnnonce " >
            <a href=""  class="">
                <span ><i class="fa fa-star"></i> Dévenez Membre Pro</span>
            </a>
        </li>
    @endif
@endsection
@section("mainEntete")
    <div class="col-lg-12 col-md-12" style="background-color:  #3c8dbc;padding-top: 15px" >
        <div class=" top-filter tfilter-box bottom" style="">
            <div class="container ">
                <form action="{{route('searchUser')}}" method="post"  class="text-center center-block">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div   class="" >
                        <div class="col-sm-4 form-group-lg col-sm-offset-2" style="padding: 5px">
                            <select data-toggle="tmp" class="form-control" name="slugPlat" id="rubrique">
                                <option value="0">Toutes les Plateformes</option>
                                @foreach($listeOfPlat as $plat)
                                    <option value="{{$plat->id}}">{{$plat->libelle}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-sm-4 form-group-lg" style="padding: 5px">
                            <select class="form-control" name="slugTechno" id="techno">
                                <option value="0">Toutes les technologies</option>
                                @foreach($listeOfTechnologies as $techno)
                                    <option value="{{$techno->id}}">{{$techno->libelle}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-lg-1 form-group-lg " style="">
                            <button class="btn btn-primary " style="" ><i class="fa fa-search"></i> Rechercher</button>
                        </div>

                    </div>
                </form>

            </div>

        </div>

@endsection

@section("main_content")
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs" style="padding: 5px;margin-top: 15px" >
            <div class="panel panel-primary" >
                <div class="panel-title panel-heading">
                    <h3 class=" text-center ">Catégorie des projets</h3>

                </div>
                <div class="panel-body ">
                    <ul class="list-group collapse in">
                        @foreach($listeOfPlat as $plat)

                            <li class="list-group-item ">
                                <a data-toggle="collapse" class="collapse in " href="#{{$plat->id}}">
                                    <img class="" src="{{url($plat->logo->url) }}" width="25" height="25"> {{$plat->libelle}}
                                    <b class="pull-right fa fa-chevron-circle-right"></b>
                                </a>
                                <ul id="{{$plat->id}}" class="collapse">
                                    <li class=""  style="margin-left: 20px">
                                        <span><a href="@if($plat->slug) {{route('indexPlateFormeUser',['slugPlateforme'=>$plat->slug->content])}} @endif ">Tous les projets</a></span>
                                    </li>
                                    @foreach($plat->technologies as $techno)
                                        <li class=""  style="margin-left: 20px">
                                            <span><a href="@if($techno->slug) {{route('indexTechnoUser',['slugPlateforme'=>$plat->slug->content,'slugTechno'=>$techno->slug->content])}} @endif ">{{$techno->libelle}}</a></span>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12" style="padding-bottom: 10px;margin-top: 20px">
            <div class="panel projet col-lg-12" style="padding-bottom: 10px;padding-top: 10px;border: solid 1px #428bca;margin-bottom: 0">
                <div class="panel-heading" style="margin: 0;padding: 0;padding-left: 5px">
                    <img src="/uploads/plateformes/plateforme_03.png" width="30" height="30"> <h4  class="text-primary inline">{{$projet->titre}}</h4>
                </div>
                <div class="panel-body" style="padding: 5px;color: black;">
                    <div class="text-summury">{{$projet->description}}</div>
                    <div class="competences">
                        <h6>compétences requises</h6>
                        <div style="margin-left: 15px">
                            @foreach($projet->competences as $techno )
                                <button class="alert alert-info" style="padding: 3px;margin: 0">{{$techno->libelle}} </button>
                            @endforeach</div>

                    </div>
                </div>
                <div class="panel-footer" style="padding-bottom: 0">
                    <p class="pull-right"><i class="fa fa-eye"></i> {{$projet->nbrVue}} vue(s)&nbsp;&nbsp;<i class="fa fa-hand-o-up"> </i>&nbsp;&nbsp;{{count($projet->offres)}} offre(s)&nbsp;</p>
                    <table class="table table-bordered" >
                        <tbody>
                        <tr style="width: 30%;margin: 0">
                            <th>Publié le</th>
                            <td>{{$projet->created_at}}</td>
                        </tr>
                        <tr style="width: 30%">
                            <th>Budget indicatif</th>
                            <td>{{$projet->budget->libelle}} Fcfa</td>
                        </tr>
                        <tr style="width: 30%">
                            <th>Auteur</th>
                            <td>{{$projet->user->name}}</td>
                        </tr>
                        <tr style="width: 30%">
                            <th>Démarrage</th>
                            <td>{{$projet->demarrage->libelle}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                @if(count($projet->offres)!=0)
                    <p class="text-center"><button class="btn btn-primary" id="btnOffre"><i class="fa fa-hand-o-up"></i> Faire un dévis</button></p>

                @else
                    <p class="text-center"><button class="btn btn-primary" id="btnOffre"><i class="fa fa-hand-o-up"></i> soyez le 1er à faire un dévis</button></p>

                @endif
            </div>
            <div class="row">
                @if(count($projet->offres)!=0)
                    <h3 class="text-primary">Les offres pour ce projet :</h3>
                    @foreach($projet->offres as $offre)
                        <div class="col-md-12" style="padding: 5px;margin: 0">
                            <a class="pull-left" href="#">
                                <img class="media-object img-circle" height="80" width="80"  src="@if($offre->user->profil)/ @else {{url('img/avatar.png')}} @endif" alt="profile">
                            </a>
                            <div class="media-body">
                                <div class="well well-lg">
                                    <h4 class="media-heading  reviews">@if($offre->user->id==Auth::user()->id)Moi @else{{$offre->user->login}} @endif</h4>

                                    <p class="text-summury"  style="font-weight: bold;margin:0px">Montant: {{$offre->prix}} Fcfa </p>
                                    <p class="text-summury"  style="font-weight: bold;margin:0px">Durée d'exécution: {{$offre->duree}} Jours </p>

                                    <p class="media-comment ">
                                        {{$offre->description}}
                                    </p>
                                    <p>
                                        <i class="fa fa-clock-o"></i> {{getDureeFromCarbone($offre->created_at)}}
                                        @if($offre->state==1)<i class="fa fa-check-circle" style="color: green"></i> le client a consulté cette offre @endif
                                    </p>
                                    <!--a class="btn btn-warning btn-circle text-uppercase" data-toggle="collapse" href="#replyOne"><span class="glyphicon glyphicon-comment"></span> 2 comments</a-->
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif
            </div>
        </div>
        <div class="col-md-3 hidden-md" style="margin-top: 20px">
            <div class="">
            </div>
            <div class="" style="margin-top: 50px;min-height: 150px;padding-right: 5px">
                <div class="col-md-12" style="">
                    <div class="card" style="border: solid 2px #428bca;">

                        <!-- Card image -->
                        <div class="view overlay">
                            <p class="text-center">
                                <img class="responsive-img" height="150" src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg" width="300" alt="Card image cap">
                            </p>
                            @if(Auth::check())
                                <h4 class="text-center text-primary" style="font-weight: bold">{{Auth::user()->login}}, devenez Membre Pro et contactez ce client !</h4>
                            @else
                                <h4 class="text-center text-primary" style="font-weight: bold">Connectez-vous et contactez ce client !</h4>
                            @endif
                            <a href="#!">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body">
                            <!-- Title -->

                            <!-- Text -->
                            @if(Auth::check())
                                <p class="text-center">
                                    <i class="fa fa-star fa-2x" style="color: green"></i>
                                    <i class="fa fa-star fa-2x" style="color: orange"></i>
                                    <i class="fa fa-star fa-2x" style="color: red"></i>

                                </p>
                            @endif
                            <p class="card-text text-center" style="font-size: 1.3em;color: #3c3c3c">
                            @if(Auth::check())
                                <p class="text-center"><a href="{{route('inscription')}}" class="btn btn-primary">Souscrire</a></p>
                            @else
                                <p class="text-center" style="margin-bottom: 0"><a href="{{route('seConnecter')}}" class="btn btn-primary">Se connecter</a></p>
                                <p class="text-center" style="margin-bottom: 0;margin-top: 0">ou </p>
                                <p class="text-center"><a href="{{route('inscription')}}" class="btn btn-primary">S'inscrire</a></p>
                                @endif
                                </p>
                                <!-- Button -->
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
                            <p class="text-center"><a href="{{route('seConnecter')}}" class="btn btn-primary " >Se connecter</a></p>
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

            $("#rubrique").change(function () {
                _html="";
                if($("#rubrique").val()==0)
                {
                    _html='<option value="0">Toutes les technologies</option>';
                    for(i=0;i<listeOfTechnologies.length;i++)
                    {
                        _html+='<option value="'+listeOfTechnologies[i].id+'">'+listeOfTechnologies[i].libelle+'</option>';
                    }

                }
                else
                {
                    _html+='<option value="">Tout</option>';
                    for(i=0;i<listeOfTechnologies.length;i++)
                    {
                        if(listeOfTechnologies[i].plateforme_id==$("#rubrique").val())
                        {
                            _html+='<option value="'+listeOfTechnologies[i].id+'">'+listeOfTechnologies[i].libelle+'</option>';
                        }

                    }
                }
                $("#techno").html(_html);
            });
            $("#btnValidate").click(function () {
                var $this = $(this);
                isError=0;
                $("#errorDuree").text("");
                $("#errorMontant").text("");
                if($("#montant").val()=="")
                {
                    $("#errorMontant").text("*");
                    isError=1;
                }
                if($("#duree").val()=="")
                {
                    $("#errorDuree").text("*");
                    isError=1;
                }
                if(isError==0)
                {
                    route="/nouvelle-offre";
                    montant=$("#montant").val();
                    duree=$("#duree").val();
                    description=$("#description").val();
                    @if(Auth::check())
                        data={"idPrestataire":'{{Auth::user()->id}}',"idProjet":'{{$projet->id}}',"montant":montant,"duree":duree,"description":description,"_token":"<?php echo csrf_token() ?>"};

                    @endif
                    $this.button('loading');
                    $(".btnCancel").prop('disabled','disabled');

                    $.ajax({
                        url :route,
                        data:data,
                        type : "post",
                        success : function(json)
                        {
                            res=JSON.parse(json);
                            $(".btnCancel").removeProp('disabled');
                            if(res.code==200)
                            {
                                $("#result").html('<i class="fa fa-check-circle fa-3x"></i>');
                            }
                            else
                            {
                                $("#result").html('<i style="color: red" class="fa fa-exclamation-circle fa-3x"></i>');
                            }
                            $this.button('reset');
                            $("#btnOffre").text('Faire une Offre');
                            $("#login-modal").modal('toggle');
                            $("#succes-message").text(res.message);
                            $("#success-modal").modal('toggle');
                        },
                        error :function(xhr,errmsg,err)
                        {
                            console.log(xhr);
                            //$this.button('reset');
                        }
                    });
                }
            });

        $("#btnOffre").click(function () {
            @if(Auth::check())
                $("#login-modal").modal('toggle');
            @else
                $("#alert-modal").modal('toggle');
            @endif

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