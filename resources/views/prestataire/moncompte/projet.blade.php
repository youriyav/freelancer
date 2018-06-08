@extends('prestataire.moncompte.layout')
@section('menu')
    <ul class="nav nav-list" >

        <li ><a href="{{route('monCompte')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="myActive "><a href="{{route('mesProjets')}}"><i class="fa fa-briefcase"></i> Mes Projets</a></li>
        <li><a href="{{route('mesCompetences')}}"><i class="fa fa-sitemap"></i> Mes compétences</a></li>
    </ul>
@endsection()
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
    <div class="row" style="margin-bottom: 10px">

        <form action="{{route('searchUser')}}" method="post"  class="text-center center-block">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div   class="" >
                <div class="col-sm-3 form-group-lg col-sm-offset-2" style="padding: 5px">
                    <select data-toggle="tmp" class="form-control" name="slugPlat" id="rubrique">
                        <option value="0">Toutes les Plateformes</option>

                        @foreach($listeOfPlat as $plat)
                            <option value="{{$plat->id}}" style="background-color:#DEDEDE; font-weight: bold;text-transform: uppercase;" disabled=""> ----- {{$plat->libelle}} ----- </option>
                            @foreach($plat->technologies as $cat)
                                <option value="{{$cat->id}}" @isset($rubriqueSelected) @if($rubriqueSelected->id==$cat->id) selected @endif     @endisset>{{$cat->libelle}} </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 form-group-lg" style="padding: 5px">
                    <select class="form-control" name="slugTechno" id="techno">
                        <option value="0">Tout projets</option>
                        <option value="0">cloturé</option>
                        <option value="0">en cours</option>

                    </select>
                </div>

                <div class="col-sm-12 col-lg-1 form-group-lg " style="">
                    <button class="btn btn-lg btn-primary " style="" ><i class="fa fa-search"></i> Rechercher</button>
                </div>
            </div>
        </form>
    </div>
    <div class="panel panel-default">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1default" data-toggle="tab">Touts</a></li>
                    <li class=""><a href="#tab2default" data-toggle="tab">Projets remportés</a></li>
                    <li><a href="#tab3default" data-toggle="tab">Projets créés</a></li>

                </ul>

            </div>

            <div class="panel-body">

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1default">
                        @foreach($projets as $projet )
                            <div class="panel projet">
                                <div class="panel-heading" style="margin: 0;padding: 0;padding-left: 5px">
                                    <img src="/uploads/plateformes/plateforme_03.png" width="30" height="30"> <h4  class="text-primary inline"><a href="{{route('detailMonProjet',["slug"=>$projet->slug->content])}}">{{$projet->titre}}</a></h4>
                                </div>
                                <div class="panel-body" style="padding: 5px;color: black;">
                                    <div class="text-summury" style="color: black">{{$projet->description}}</div>
                                    <div class="competences">
                                        <h6 style="color: #3c8dbc">compétences requises</h6>
                                        <div style="margin-left: 15px">
                                        @foreach($projet->competences as $techno )
                                            <button class="alert alert-info" style="padding: 3px;margin: 0">{{$techno->libelle}} </button>
                                        @endforeach</div>

                                    </div>
                                </div>
                                <div class="panel-footer">

                                    <i class="fa fa-clock-o"></i>&nbsp;{{getDureeFromCarbone($projet->created_at)}}
                                    &nbsp;
                                    <i class="fa fa-eye"></i> {{$projet->nbrVue}} vue(s)&nbsp;&nbsp;
                                    <i class="fa fa-hand-o-up"> </i>&nbsp;&nbsp;{{count($projet->offres)}} offre(s)&nbsp;&nbsp;
                                     @if($projet->state==0)<i class="fa fa-circle" style="color: orange"></i> en cours de validation @endif &nbsp;&nbsp;
                                     @if($projet->state==1)<i class="fa fa-circle" style="color: green"></i> publié @endif &nbsp;&nbsp;
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="tab2default">
                    </div>
                    <div class="tab-pane fade" id="tab3default">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()