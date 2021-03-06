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
    <div class="col-lg-12 col-md-12" style="background-color:  #3c8dbc;padding-top: 15px;" >
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
                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs" style="padding: 5px;margin-top: 15px;" >
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
                <!-- ordinateur -->
                <div class="col-md-6 col-lg-6 hidden-sm hidden-xs" style="padding-bottom: 10px;margin-top: 20px;">
                    <div class="panel projet col-lg-12" style="padding-bottom: 10px;padding-top: 10px;border: solid 1px #428bca;margin-bottom: 0">
                        <div class="panel-heading" style="margin: 0;padding: 0;padding-left: 5px">

                            @foreach($projet->competences as $techno)
                                <?php $check=true ?>
                                @foreach($tmpListe as $tmp)
                                    @if($tmp==$techno->plateforme->id)
                                        {{ $check=false}}
                                    @endif
                                @endforeach
                                @if($check==true)
                                    <img src="/{{$techno->plateforme->logo->url}}" title="{{$techno->plateforme->libelle}}" width="20" height="20" style="margin-left: 0">
                                    <?php array_push($tmpListe,$techno->plateforme->id) ?>
                                @endif
                            @endforeach
                            <h4  class="text-primary inline">{{$projet->titre}}</h4>
                        </div>
                        <div class="panel-body" style="padding: 5px;color: black;">
                            <div class="text-summury">{{$projet->description}}</div>

                        </div>
                        <div class="panel-footer" style="padding-top: 5px;padding-bottom: 5px">
                            <div class="competences">
                                <h6>compétences requises</h6>
                                <div style="margin-left: 15px">
                                    @foreach($projet->competences as $techno )
                                        <button class="alert alert-info" style="padding: 3px;margin: 0">{{$techno->libelle}} </button>
                                    @endforeach</div>
                            </div>

                        </div>
                    </div>
                    @if(count($projet->offres)!=0)
                        <p class="text-center"><button class="btn btn-primary" id="btnOffre" style="margin-top: 10px"><i class="fa fa-hand-o-up"></i> Faire un dévis</button></p>
                    @else
                        <p class="text-center"><button class="btn btn-primary" id="btnOffre" style="margin-top: 10px"><i class="fa fa-hand-o-up"></i> soyez le 1er à faire un dévis</button></p>
                    @endif
                    <div class="row">
                        <div class="container-fluid">
                            @if(count($projet->offres)!=0)
                                <h3 class="text-primary" style="text-decoration: underline">Tout les dévis :</h3>
                                <div style="max-height: 400px;overflow-y: scroll;overflow-x: hidden;padding: 8px">
                                    @foreach($projet->offres as $offre)
                                        <div class="row">
                                            <div class="col-md-2 col-xs-2 col-md-2" style="">
                                                <div class="col-md-11"></div>
                                                <a href="">
                                                    <div class="">
                                                        @if($offre->user->isAgencyAdmin!=1)
                                                            <img class="img-responsive img-circle "  src="@if($offre->user->profil)/{{$offre->user->profil->url}} @else {{url('img/avatar.png')}} @endif" alt="profile">
                                                        @else
                                                            <img class="img-responsive img-circle"  src="@if($offre->user->agence->logo)/{{$offre->user->agence->logo->url}} @else {{url('img/avatar.png')}} @endif" alt="profile">
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                            <!--ordi-->
                                            <div class="col-md-10 hidden-xs hidden-sm">
                                                <div class="mypanel panel panel-default">
                                                    <div class="panel-heading" >
                                                        <div class=" row" style="padding: 5px;padding-bottom: 0;padding-top: 0">
                                                            <div class="pull-left">
                                                                <a href="@if($offre->user->isAgencyAdmin==1){{route('profil',["slug"=>$offre->user->agence->raisonSocial])}}@else {{route('profil',["slug"=>$offre->user->prestataire->slug->content])}} @endif">
                                                                    <strong>
                                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                                            @if($offre->user->id==Auth::user()->id)
                                                                                @if($offre->user->isAgencyAdmin!=1)
                                                                                    Moi
                                                                                @else
                                                                                    {{$offre->user->agence->raisonSocial}} (Agence) <span class="badge badge-primary">Pro</span>
                                                                                @endif
                                                                            @else
                                                                                @if($offre->user->isAgencyAdmin==1)
                                                                                    {{$offre->user->agence->raisonSocial}} (Agence) <span class="badge badge-primary">Pro</span>
                                                                                @else
                                                                                    {{$offre->user->login}} (freelancer) <span class="badge badge-primary">Pro</span>
                                                                                @endif

                                                                            @endif
                                                                        @else
                                                                            @if($offre->user->isAgencyAdmin==1)
                                                                                {{$offre->user->agence->raisonSocial}} (Agence) <span class="badge badge-primary">Pro</span>
                                                                            @else
                                                                                {{$offre->user->login}} (freelancer) <span class="badge badge-primary">Pro</span>
                                                                            @endif

                                                                        @endif
                                                                    </strong>
                                                                    <p style="margin: 0">
                                                                        <i style="color: #ffd740" class="fa fa-star"></i>
                                                                        <i style="color: #ff851b" class="fa fa-star"></i>
                                                                    </p>

                                                                    <span style="margin: 0" class="text-muted "><i class="fa fa-clock-o"></i> {{getDureeFromCarbone($offre->created_at)}}</span>
                                                            </div>
                                                            <div class="pull-right" >
                                                                <span class="">
                                                                     @if($offre->state==1)@endif<i class="fa fa-check-circle" style="color: green"></i> le client a consulté cette offre
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <p class="text-summury" style="margin: 0;padding: 0">{{$offre->description}}</p>
                                                    </div><!-- /panel-body -->
                                                    <div class="panel-footer">
                                                        <i class="fa fa-money" style="color: #3c8dbc"></i> <span style="font-weight: bold">Montant:</span> {{$offre->prix}} Fcfa &nbsp;<i style="color: #3c8dbc" class="fa fa-calendar-o"></i> <span style="font-weight: bold">Durée d'exécution:</span> {{$offre->duree}} Jours
                                                    </div>
                                                </div>
                                            </div>
                                            <!--mobil-->
                                            <div class="hidden-md hidden-lg col-xs-10 col-md-10">
                                                <div class="mypanel panel panel-default" style="padding: 0">
                                                    <div class="panel-heading" >
                                                        <div class=" row" style="padding-bottom: 0;padding-top: 0">
                                                            <div class="pull-left">

                                                                <a href="@if($offre->user->isAgencyAdmin==1){{route('profil',["slug"=>$offre->user->agence->raisonSocial])}}@else {{route('profil',["slug"=>$offre->user->prestataire->slug->content])}} @endif">
                                                                    <strong>
                                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                                            @if($offre->user->id==Auth::user()->id)
                                                                                @if($offre->user->isAgencyAdmin!=1)
                                                                                    Moi
                                                                                @else
                                                                                    {{$offre->user->agence->raisonSocial}} (Agence) <span class="badge badge-primary">Pro </span>
                                                                                @endif
                                                                            @else
                                                                                @if($offre->user->isAgencyAdmin==1)
                                                                                    {{$offre->user->agence->raisonSocial}} (Agence) <span class="badge badge-primary">Pro </span>
                                                                                @else
                                                                                    {{$offre->user->login}} (freelancer) <span class="badge badge-primary">Pro</span>
                                                                                    <span class="pull-right">@if($offre->state==1)@endif<i class="fa fa-check-circle " style="color: green"></i></span>
                                                                                @endif

                                                                            @endif
                                                                        @else
                                                                            @if($offre->user->isAgencyAdmin==1)
                                                                                {{$offre->user->agence->raisonSocial}} (Agence) <span class="badge badge-primary">Pro</span>
                                                                            @else
                                                                                {{$offre->user->login}} (freelancer) <span class="badge badge-primary">Pro</span>
                                                                            @endif

                                                                        @endif
                                                                    </strong></a>
                                                                <p style="margin: 0">
                                                                    <i style="color: #ffd740" class="fa fa-star"></i>
                                                                    <i style="color: #ff851b" class="fa fa-star"></i>
                                                                </p>

                                                                <span style="margin: 0" class="text-muted "><i class="fa fa-clock-o"></i> {{getDureeFromCarbone($offre->created_at)}}</span>
                                                            </div>
                                                            <div class="pull-right" >

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <p class="text-summury" style="margin: 0;padding: 0">{{$offre->description}}</p>
                                                    </div><!-- /panel-body -->
                                                    <div class="panel-footer">
                                                        <i class="fa fa-money" style="color: #3c8dbc"></i> <span style="font-weight: bold">Montant:</span> {{$offre->prix}} Fcfa &nbsp;<i style="color: #3c8dbc" class="fa fa-calendar-o"></i> <span style="font-weight: bold">Durée d'exécution:</span> {{$offre->duree}} Jours
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- mobil -->
                <div class="col-sm-12 col-xs-12 hidden-lg hidden-md" style="padding-bottom: 10px;margin-top: 120px;">
                    <div class="panel projet col-lg-12" style="padding-bottom: 10px;padding-top: 10px;border: solid 1px #428bca;margin-bottom: 0">
                        <div class="panel-heading" style="margin: 0;padding: 0;padding-left: 5px">
                            @foreach($projet->competences as $techno)
                                <?php $check=true ?>
                                @foreach($tmpListe as $tmp)
                                    @if($tmp==$techno->plateforme->id)
                                        {{ $check=false}}
                                    @endif
                                @endforeach
                                @if($check==true)
                                    <img src="/{{$techno->plateforme->logo->url}}" title="{{$techno->plateforme->libelle}}" width="20" height="20" style="margin-left: 0">
                                    <?php array_push($tmpListe,$techno->plateforme->id) ?>
                                @endif
                            @endforeach
                            <h4  class="text-primary inline">{{$projet->titre}}</h4>
                        </div>
                        <div class="panel-body" style="padding: 5px;color: black;">
                            <div class="text-summury">{{$projet->description}}</div>

                        </div>
                        <div class="panel-footer" style="padding-top: 5px;padding-bottom: 5px">
                            <div class="competences">
                                <h6>compétences requises</h6>
                                <div style="margin-left: 15px">
                                    @foreach($projet->competences as $techno )
                                        <button class="alert alert-info" style="padding: 3px;margin: 0">{{$techno->libelle}} </button>
                                    @endforeach</div>
                            </div>

                        </div>
                    </div>
                    @if(count($projet->offres)!=0)
                        <p class="text-center"><button class="btn btn-primary" id="btnOffre" style="margin-top: 10px"><i class="fa fa-hand-o-up"></i> Faire un dévis</button></p>
                    @else
                        <p class="text-center"><button class="btn btn-primary" id="btnOffre" style="margin-top: 10px"><i class="fa fa-hand-o-up"></i> soyez le 1er à faire un dévis</button></p>
                    @endif
                    <div class="row">
                        <div class="container-fluid">
                            @if(count($projet->offres)!=0)
                                <h3 class="text-primary" style="text-decoration: underline">Tout les dévis :</h3>
                                <div style="max-height: 400px;overflow-y: scroll;overflow-x: hidden;padding: 8px">
                                    @foreach($projet->offres as $offre)
                                        <div class="row">
                                            <div class="col-md-2 col-xs-2 col-md-2" style="">
                                                <div class="col-md-11"></div>
                                                <a href="">
                                                    <div class="">
                                                        @if($offre->user->isAgencyAdmin!=1)
                                                            <img class="img-responsive img-circle "  src="@if($offre->user->profil)/{{$offre->user->profil->url}} @else {{url('img/avatar.png')}} @endif" alt="profile">
                                                        @else
                                                            <img class="img-responsive img-circle"  src="@if($offre->user->agence->logo)/{{$offre->user->agence->logo->url}} @else {{url('img/avatar.png')}} @endif" alt="profile">
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                            <!--ordi-->
                                            <div class="col-md-10 hidden-xs hidden-sm">
                                                <div class="mypanel panel panel-default">
                                                    <div class="panel-heading" >
                                                        <div class=" row" style="padding: 5px;padding-bottom: 0;padding-top: 0">
                                                            <div class="pull-left">
                                                                <a href="@if($offre->user->isAgencyAdmin==1){{route('profil',["slug"=>$offre->user->agence->slug->content])}}@else {{route('profil',["slug"=>$offre->user->prestataire->slug->content])}} @endif">
                                                                    <strong>
                                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                                            @if($offre->user->id==Auth::user()->id)
                                                                                @if($offre->user->isAgencyAdmin!=1)
                                                                                    Moi
                                                                                @else
                                                                                    {{$offre->user->agence->raisonSocial}} (Agence) <span class="badge badge-primary">Pro</span>
                                                                                @endif
                                                                            @else
                                                                                @if($offre->user->isAgencyAdmin==1)
                                                                                    {{$offre->user->agence->raisonSocial}} (Agence) <span class="badge badge-primary">Pro</span>
                                                                                @else
                                                                                    {{$offre->user->login}} (freelancer) <span class="badge badge-primary">Pro</span>
                                                                                @endif

                                                                            @endif
                                                                        @else
                                                                            @if($offre->user->isAgencyAdmin==1)
                                                                                {{$offre->user->agence->raisonSocial}} (Agence) <span class="badge badge-primary">Pro</span>
                                                                            @else
                                                                                {{$offre->user->login}} (freelancer) <span class="badge badge-primary">Pro</span>
                                                                            @endif

                                                                        @endif
                                                                    </strong>
                                                                    <p style="margin: 0">
                                                                        <i style="color: #ffd740" class="fa fa-star"></i>
                                                                        <i style="color: #ff851b" class="fa fa-star"></i>
                                                                    </p>

                                                                    <span style="margin: 0" class="text-muted "><i class="fa fa-clock-o"></i> {{getDureeFromCarbone($offre->created_at)}}</span>
                                                            </div>
                                                            <div class="pull-right" >
                                                                <span class="">
                                                                     @if($offre->state==1)@endif<i class="fa fa-check-circle" style="color: green"></i> le client a consulté cette offre
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <p class="text-summury" style="margin: 0;padding: 0">{{$offre->description}}</p>
                                                    </div><!-- /panel-body -->
                                                    <div class="panel-footer">
                                                        <i class="fa fa-money" style="color: #3c8dbc"></i> <span style="font-weight: bold">Montant:</span> {{$offre->prix}} Fcfa &nbsp;<i style="color: #3c8dbc" class="fa fa-calendar-o"></i> <span style="font-weight: bold">Durée d'exécution:</span> {{$offre->duree}} Jours
                                                    </div>
                                                </div>
                                            </div>
                                            <!--mobil-->
                                            <div class="hidden-md hidden-lg col-xs-10 col-md-10">
                                                <div class="mypanel panel panel-default" style="padding: 0">
                                                    <div class="panel-heading" >
                                                        <div class=" row" style="padding-bottom: 0;padding-top: 0">
                                                            <div class="pull-left">

                                                                <a href="@if($offre->user->isAgencyAdmin==1){{route('profil',["slug"=>$offre->user->agence->slug->content])}}@else {{route('profil',["slug"=>$offre->user->prestataire->slug->content])}} @endif">
                                                                    <strong>
                                                                        @if(\Illuminate\Support\Facades\Auth::check())
                                                                            @if($offre->user->id==Auth::user()->id)
                                                                                @if($offre->user->isAgencyAdmin!=1)
                                                                                    Moi
                                                                                @else
                                                                                    {{$offre->user->agence->raisonSocial}} (Agence) <span class="badge badge-primary">Pro </span>
                                                                                @endif
                                                                            @else
                                                                                @if($offre->user->isAgencyAdmin==1)
                                                                                    {{$offre->user->agence->raisonSocial}} (Agence) <span class="badge badge-primary">Pro </span>
                                                                                @else
                                                                                    {{$offre->user->login}} (freelancer) <span class="badge badge-primary">Pro</span>
                                                                                    <span class="pull-right">@if($offre->state==1)@endif<i class="fa fa-check-circle " style="color: green"></i></span>
                                                                                @endif

                                                                            @endif
                                                                        @else
                                                                            @if($offre->user->isAgencyAdmin==1)
                                                                                {{$offre->user->agence->raisonSocial}} (Agence) <span class="badge badge-primary">Pro</span>
                                                                            @else
                                                                                {{$offre->user->login}} (freelancer) <span class="badge badge-primary">Pro</span>
                                                                            @endif

                                                                        @endif
                                                                    </strong></a>
                                                                <p style="margin: 0">
                                                                    <i style="color: #ffd740" class="fa fa-star"></i>
                                                                    <i style="color: #ff851b" class="fa fa-star"></i>
                                                                </p>

                                                                <span style="margin: 0" class="text-muted "><i class="fa fa-clock-o"></i> {{getDureeFromCarbone($offre->created_at)}}</span>
                                                            </div>
                                                            <div class="pull-right" >

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <p class="text-summury" style="margin: 0;padding: 0">{{$offre->description}}</p>
                                                    </div><!-- /panel-body -->
                                                    <div class="panel-footer">
                                                        <i class="fa fa-money" style="color: #3c8dbc"></i> <span style="font-weight: bold">Montant:</span> {{$offre->prix}} Fcfa &nbsp;<i style="color: #3c8dbc" class="fa fa-calendar-o"></i> <span style="font-weight: bold">Durée d'exécution:</span> {{$offre->duree}} Jours
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="col-md-3 hidden-sm hidden-xs" style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="container-fluid">
                                <div class="" style="padding: 5px;margin-top: 15px" >
                                    <div class="panel panel-primary " >
                                        <div class="panel-title panel-heading text-center">
                                            Détail du projet
                                        </div>
                                        <div class="panel-body ">
                                            <ul class="list-group collapse in">
                                                <li class="list-group-item " style="border: none;margin: 0;padding: 0"><i class="fa fa-calendar" style="color: #428bca"></i> Publié le {{$projet->created_at}}</li>
                                                <li class="list-group-item " style="border: none;margin: 0;padding: 0"><i class="fa fa-hand-o-up" style="color: #428bca"></i> Dévis proposé(s) :{{count($projet->offres)}}</li>
                                                <li class="list-group-item " style="border: none;margin: 0;padding: 0"><i class="fa fa-eye" style="color: #428bca"></i> {{$projet->nbrVue}} vues</li>
                                                <li class="list-group-item " style="border: none;margin: 0;padding: 0"><i class="fa fa-location-arrow" style="color: #428bca"></i> @if($projet->localisation==1) à distance @else sur place @endif</li>
                                                <li class="list-group-item " style="border: none;margin: 0;padding: 0"><i class="fa fa-money" style="color: #428bca"></i> Budget : {{$projet->budget->libelle}} Fcfa</li>
                                                <li class="list-group-item " style="border: none;margin: 0;padding: 0"><i class="fa fa-calendar-o" style="color: #428bca"></i> Démarrage : {{$projet->demarrage->libelle}} </li>

                                                <li> <a href="@if($projet->user->isAgencyAdmin==1){{route('profil',["slug"=>$projet->user->agence->slug->content])}}@else {{route('profil',["slug"=>$projet->user->prestataire->slug->content])}} @endif"><img src="/img/avatar.png" class="img img-circle pull-left" width="60" height="60" >Publié par: <br> &nbsp;{{$projet->user->login}}</a></li>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="container-fluid" style="" >
                            <div class="panel panel-primary" >
                                <div class="panel-body ">
                                    <div class="card" style="">
                                        <div class="view overlay">
                                            <p class="text-center">
                                                <img class="img img-thumbnail" height="150" src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg" width="300" alt="Card image cap">
                                            </p>
                                            @if(Auth::check())
                                                @if(\Illuminate\Support\Facades\Auth::user()->isAgencyAdmin==1)
                                                    <h4 class="text-center text-primary" style="font-weight: bold">{{Auth::user()->agence->raisonSocial}}, devenez une agence Pro et contactez ce client !</h4>
                                                @else
                                                    <h4 class="text-center text-primary" style="font-weight: bold">{{Auth::user()->login}}, devenez Membre Pro et contactez ce client !</h4>
                                                @endif
                                            @else
                                                <h4 class="text-center text-primary" style="font-weight: bold">Connectez-vous et contactez ce client !</h4>
                                            @endif
                                            <a href="#!">
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>

                                        <div class="card-body">

                                            @if(Auth::check())
                                                <p class="text-center">
                                                    <i class="fa fa-star fa-2x" style="color: green"></i>
                                                    <i class="fa fa-star fa-2x" style="color: orange"></i>
                                                    <i class="fa fa-star fa-2x" style="color: red"></i>
                                                </p>
                                            @endif
                                            <p class="card-text text-center" style="font-size: 1.3em;color: #3c3c3c"></p>
                                            @if(Auth::check())
                                                <p class="text-center"><a href="{{route('inscription')}}" class="btn btn-primary">Souscrire</a></p>
                                            @else
                                                <p class="text-center" style="margin-bottom: 0"><a href="{{route('seConnecter')}}" class="btn btn-primary">Se connecter</a></p>
                                                <p class="text-center" style="margin-bottom: 0;margin-top: 0">ou </p>
                                                <p class="text-center"><a href="{{route('inscription')}}" class="btn btn-primary">S'inscrire</a></p>
                                        @endif

                                        <!-- Button -->
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



    <div class="modal fade"  role="dialog" id="alert-modal" aria-hidden="true">
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
                    <p class="text-center"><a href="{{route('seConnecter',["next"=>"projets/".$projet->slug->content])}}" class="btn btn-primary " >Se connecter</a></p>
                    <p class="text-center"><a href="{{route('inscription')}}" class="btn btn-default">S'inscrire</a></p>
                    <p class="text-center"><button  class="btn btn-danger btn-large" data-dismiss="modal">Annuler</button></p>
                    <div class="row">

                    </div>
                </div>

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
<table class="pull-right">
    <tr>
        <th>test</th>
    </tr>
</table>