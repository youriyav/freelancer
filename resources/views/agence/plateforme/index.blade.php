@extends('prestataire.layout')
@section("css")
    <link rel="stylesheet" href="{{url('/css/prestataire/index.css')}}">
@endsection
@section("mainEntete")
    <div class="col-lg-12 col-md-12" style="min-height: 120px;background: rgba(0,142 ,173 ,1) url('/img/back-header.png') repeat-x center top;" >
        <h5 class="text-center hidden-xs" style="color: white">Bienvenue sur le</h5>
        <h2 class="text-center hidden-xs" style="color: white;margin-bottom: 0;margin-top: 0">site N°1 de mise en relation porteur de projet </h2>
        <h2 class="text-center hidden-xs" style="color: white;margin-top: 0">et prestataire informatique</h2>

        <h5 class="text-center hidden-sm hidden-md hidden-lg" style="color: white">Bienvenue sur le</h5>
        <h4 class="text-center hidden-sm hidden-md hidden-lg" style="color: white;margin-bottom: 0;margin-top: 0">site N°1 de mise en relation porteur de projet </h4>
        <h4 class="text-center hidden-sm hidden-md hidden-lg" style="color: white;margin-top: 0">et prestataire informatique</h4>

        <div class=" top-filter tfilter-box bottom" style="margin-bottom: 20px;">
            <div class="container ">
                <form action="{{route('searchUser')}}" method="post" class="text-center center-block" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div   class="" >

                        <div class="col-sm-4 form-group-lg col-sm-offset-2" style="padding: 5px">
                            <select data-toggle="tmp" class="form-control" name="rubrique" id="rubrique" style="font-weight: bold">
                                <option value="0">Toutes les Plateformes</option>
                                @foreach($listeOfPlat as $plat)
                                    <option value="{{$plat->id}}" @isset($currentPlateforme) @if($currentPlateforme->id==$plat->id) selected style="font-weight: bold" @endif  @endisset>{{$plat->libelle}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-sm-4 form-group-lg" style="padding: 5px">
                            <select class="form-control" name="techno" id="techno">
                                <option value="0">Toutes les technologies</option>
                                @foreach($listeOfTechnologies as $techno)
                                    <option value="{{$techno->id}}">{{$techno->libelle}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-lg-1 form-group-lg " style="">
                            <button class="btn btn-lg btn-primary " style="" ><i class="fa fa-search"></i> Rechercher</button>
                        </div>

                    </div>
                </form>

            </div>

        </div>
        <p style="background-color: white;padding-top: 8px" class="text-center">
            <img height="40" width="150" src="{{ url('/img/play-store.png') }}"  alt="Cinque Terre">
            <img height="40" width="150" src="{{ url('/img/App-Store.jpg') }}"  alt="Cinque Terre">
        </p>
        <div  class="row hidden-xs" style="background-color: white">
            <div class="col-lg-4 col-md-4 col-sm-4 text-center" >
                <h4 class="tmp"> <i class="fa fa-trophy"></i> 1ère communauté freelance du Sénégal</h4>
                <h5 style="font-style: italic">plus de 142 757 freelances inscrits</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 text-center" >
                <h4 class="tmp"> <i class="fa fa-clock-o"></i> Demandez un devis rapide pour votre projet</h4>
                <h5 style="font-style: italic">plus de 142 757 freelances inscrits</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 text-center" >
                <h4 class="tmp"> <i class="fa fa-institution"></i> Nos Agences Digitales</h4>
                <h5 style="font-style: italic">Devenez agence en créant votre propre vitrine en ligne et profitez de nombreux avantages:</h5>
            </div>

        </div>
    </div>
@endsection

@section("main_content")
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs"style="padding: 5px" >
            <div class="panel panel-primary" >
                <div class="panel-title panel-heading">
                    <h3 class=" text-center ">Catégorie des projets</h3>

                </div>
                <div class="panel-body ">
                    <ul class="list-group collapse in">
                        @foreach($listeOfPlat as $plat)

                            <li class="list-group-item">
                                <a data-toggle="collapse" href="#{{$plat->id}}" @isset($currentPlateforme) @if($currentPlateforme->id==$plat->id) style="font-weight: bold;font-size: 1.2em" @endif  @endisset>
                                    <img class="" src="{{url($plat->logo->url) }}" width="30" height="30"> {{$plat->libelle}}
                                    <b class="pull-right fa fa-chevron-circle-right"></b>
                                </a>
                                <ul id="{{$plat->id}}" class="collapse @isset($currentPlateforme) @if($currentPlateforme->id==$plat->id) in @endif  @endisset">
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
        <div class="col-lg-7 col-md-9">
            <div class="row">
                <div class="adbox-img" >
                    <div id="transition-timer-carousel" class="carousel slide transition-timer-carousel " data-ride="carousel" style="min-height: 100px">
                        <div class="carousel-inner" style="">
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

                        <!--img src="https://moatsearch-data.s3.amazonaws.com/creative_screens/7b/f8/d4/7bf8d4dd35362e8a11a418d4c58bd59c.jpg" class="img-thumbnail" alt="Cinque Terre"-->
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                @if($currentPlateforme!=null)
                    <div class="panel projet">
                        <div class="panel-heading" style="margin: 0;padding: 0;padding-left: 5px">
                            <h4 class="text-primary"><a href="">Primary Panel</a></h4>
                        </div>
                        <div class="panel-body" style="padding: 5px;color: black;">
                            <div class="text-summury">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</div>
                            <div class="competences">
                                <button class="alert alert-info" style="padding: 0;margin: 0">Lorem </button>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <i class="fa fa-clock-o"> il y'a 5 min</i>&nbsp;&nbsp;
                            <i class="fa fa-eye"> 5 vue(s)</i>&nbsp;&nbsp;
                            <i class="fa fa-hand-o-up"> 5 offre(s)</i>&nbsp;&nbsp;
                        </div>
                    </div>
                    <hr style="border: solid 1px cornflowerblue">
                    <div class="panel projet">
                        <div class="panel-heading" style="margin: 0;padding: 0;padding-left: 5px">
                            <img src="/uploads/plateformes/plateforme_03.png" width="30" height="30"> <h4  class="text-primary inline"><a href="">Primary Panel</a></h4>
                        </div>
                        <div class="panel-body" style="padding: 5px;color: black;">
                            <div class="text-summury">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</div>
                            <div class="competences">
                                <button class="alert alert-info" style="padding: 0;margin: 0">Lorem </button>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <i class="fa fa-clock-o"> il y'a 5 min</i>&nbsp;&nbsp;
                            <i class="fa fa-eye"> 5 vue(s)</i>&nbsp;&nbsp;
                            <i class="fa fa-hand-o-up"> 5 offre(s)</i>&nbsp;&nbsp;
                        </div>
                    </div>
                @else
                    <div class="panel projet">
                        <img src="{{url('/img/search-icon.png')}}" width="100" height="100"><span style="color: red">0 projet trouvé par rapport à votre recherche</span>
                        <div class="text-center"><a href="{{route('indexPrestataire')}}" class="btn btn-primary"><i class="fa fa-mail-reply"></i> Retour</a></div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-2 hi" style="border: solid 1px cornflowerblue;margin-top: 100px;min-height: 150px">
            <img src="{{url('img/sen-delivery.png')}}" height="150">
        </div>
    </div>
@endsection
@include('footer')
@section('js')
    <script>
        $(function () {
            myFilter();
            console.log(listeOfTechnologies);
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
                myFilter();
            });
        });

        function myFilter () {
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
        }
    </script>
@endsection