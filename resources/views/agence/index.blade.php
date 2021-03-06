@extends('prestataire.layout')
@section("css")
    <link rel="stylesheet" href="{{url('/css/prestataire/index.css')}}">
@endsection
@section('blingbling')
    <li class="dropdown notifications-menu center-block btnAddAnnonce " >
        <a href=""  class="">
            <span ><i class="fa fa-send fa-2x"></i> Déposer un projet</span>
        </a>
        <span class="blink_add hidden-sm"></span>
    </li>
@endsection
@section("mainEntete")
    <div class="col-lg-12 col-md-12" style="background-color:  #3c8dbc;padding-top: 0" >
        <h4 class="text-center hidden-xs" style="color: white">Bienvenue sur le</h4>
        <h2 class="text-center hidden-xs" style="color: white;margin-bottom: 0;margin-top: 0">site N°1 de mise en relation porteur </h2>
        <h2 class="text-center hidden-xs" style="color: white;margin-top: 0">de projet  et prestataire freeleance</h2>

        <h5 class="text-center hidden-sm hidden-md hidden-lg" style="color: white">Bienvenue sur le</h5>
        <h4 class="text-center hidden-sm hidden-md hidden-lg" style="color: white;margin-bottom: 0;margin-top: 0">site N°1 de mise en relation porteur de projet </h4>
        <h4 class="text-center hidden-sm hidden-md hidden-lg" style="color: white;margin-top: 0">et prestataire informatique</h4>

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
        <div  class="row hidden-xs" style="background-color: white;margin-bottom: 0;padding-bottom: 0">
            <a href="">
                <div class="col-lg-4 col-md-4 col-sm-4 text-center" style="border: solid 1px #3c8dbc" >
                    <h4 class="tmp"> <i class="fa fa-trophy"></i> 1ère communauté freelance du Sénégal</h4>
                    <h5 style="font-style: italic">plus de 142 757 freelances inscrits</h5>
                </div>
            </a>
            <a href="">
                <div class="col-lg-4 col-md-4 col-sm-4 text-center" style="border: solid 1px #3c8dbc">
                    <h4 class="tmp"> <i class="fa fa-clock-o"></i> Demandez un devis rapide pour votre projet</h4>
                    <h5 style="font-style: italic">plus de 142 757 freelances inscrits</h5>
                </div>
            </a>
            <a href="">
                <div class="col-lg-4 col-md-4 col-sm-4 text-center" style="border: solid 1px #3c8dbc">
                    <h4 class="tmp"> <i class="fa fa-institution"></i> Nos Agences Digitales</h4>
                    <h5 style="font-style: italic">Devenez agence et profitez de nombreux avantages:</h5>
                </div>
            </a>
        </div>

    <div style="background-color: white;padding-top: 4px" class="row text-center">
        <img height="40" width="150" src="{{ url('/img/play-store.png') }}"  alt="Cinque Terre">
        <img height="40" width="150" src="{{ url('/img/App-Store.jpg') }}"  alt="Cinque Terre">
    </div>
    </div>
@endsection

@section("main_content")
    <!--div class="row" >
            <div class="adbox-img " >
                <div id="transition-timer-carousel" class="carousel slide transition-timer-carousel " data-ride="carousel" style="min-height: 100px;">
                    <div class="carousel-inner center-block" style="">
                        <div class="item active">
                            <img src="https://moatsearch-data.s3.amazonaws.com/creative_screens/7b/f8/d4/7bf8d4dd35362e8a11a418d4c58bd59c.jpg" class="img-thumbnail" alt="Cinque Terre">
                        </div>
                        <div class="item">
                            <img src="https://moatsearch-data.s3.amazonaws.com/creative_screens/7b/f8/d4/7bf8d4dd35362e8a11a418d4c58bd59c.jpg" class="img-thumbnail" alt="Cinque Terre">

                        </div>

                        <div class="item">
                            <img src="{{ url('/img/ban.png') }}" class="img-thumbnail" alt="Cinque Terre">
                        </div>
                        <div class="item">
                            <img src="{{ url('/img/ban.png') }}" class="img-thumbnail" alt="Cinque Terre">
                        </div>
                    </div>

                </div>
            </div>
    </div-->
    <div class="row" style="margin-bottom: 10px;background-color: white">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs" style="padding: 5px" >
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
        <div class="col-lg-7 col-md-9" style="padding-bottom: 10px">

            <div class="row" style="margin-top: 20px">
                @foreach($projets as $projet )
                    <div class="panel projet col-lg-10 col-lg-offset-1" style="padding-bottom: 10px;padding-top: 10px;border: solid 1px #428bca">
                        <div class="panel-heading" style="margin: 0;padding: 0;padding-left: 5px">
                            <img src="/uploads/plateformes/plateforme_03.png" width="30" height="30"> <h4  class="text-primary inline"><a href="{{route('detailProjetUser',["slug"=>$projet->slug->content])}}">{{$projet->titre}}</a></h4>
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
                        <div class="panel-footer">

                            <i class="fa fa-clock-o"></i>&nbsp;{{getDureeFromCarbone($projet->created_at)}}
                            &nbsp;
                            <i class="fa fa-eye"></i> {{$projet->nbrVue}} vue(s)&nbsp;&nbsp;
                            <i class="fa fa-hand-o-up"> </i>&nbsp;&nbsp;{{count($projet->offres)}} offre(s)&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        <div class="col-md-2">
            <p class="text-center">
                <a href="" class="btn " style="background-color: orange;color: white;font-size: 1.3em">Vous êtes une agence,<br>creer votre vitrine</a>
            </p>
            <div  style="border: solid 1px cornflowerblue;margin-top: 40px;min-height: 150px">
                <img src="{{url('img/sen-delivery.png')}}" height="150">
            </div>
        </div>
    </div>
@endsection
@include('footer')
@section('js')
    <script>
        $(function () {


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
        });


    </script>
@endsection