@extends('prestataire.layout')
@section("css")
    <link rel="stylesheet" href="{{url('/css/prestataire/index.css')}}">
@endsection
@section("mainEntete")
    <div class="col-lg-12 col-md-12 " style="max-height: 50px;background-color: #3c8dbc" >
        <div class=" top-filter tfilter-box bottom " style="margin-bottom: 20px;">
            <div class="container ">
                <form action="{{route('searchUser')}}" method="post"  class="text-center center-block">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div   class="" >
                        <div class="col-sm-4 form-group-lg col-sm-offset-2" style="padding: 5px">
                            <select data-toggle="tmp" class="form-control" name="slugPlat" id="rubrique">
                                <option value="0">Toutes les Plateformes</option>
                                @foreach($listeOfPlat as $plat)
                                    <option value="{{$plat->id}}" @if($currentPlateforme->id==$plat->id) selected @endif>{{$plat->libelle}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-sm-4 form-group-lg" style="padding: 5px">
                            <select class="form-control" name="slugTechno" id="techno">
                                <option value="0">Toutes les technologies</option>
                                @foreach($listeOfTechnologies as $techno)
                                    @if($techno->plateforme->id==$currentPlateforme->id)
                                        <option value="{{$techno->id}}" @if($currentPlateforme->id==$techno->id) selected @endif>{{$techno->libelle}}</option>
                                    @endif
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
    </div>
@endsection

@section("main_content")
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs" style="padding: 5px" >
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
        <div class="col-md-6 col-sm-12 col-xs-12 " style="padding-bottom: 10px;margin-top: 5px">
            <div class="row" style="margin-top: 20px">
                <!--h4>Derniers Projets en freelance</h4-->
                @foreach($projets as $projet )
                    <div class="panel projet col-lg-10 col-lg-offset-1" style="padding-bottom: 10px;padding-top: 10px;border: solid 1px #428bca">
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
                            <h4  class="text-primary inline"><a href="{{route('detailProjetUser',["slug"=>$projet->slug->content])}}">{{$projet->titre}}</a></h4>
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
                            <i class="fa fa-eye"></i> {{$projet->nbrVue}} vue(s)&nbsp;&nbsp;
                            <i class="fa fa-hand-o-up"> </i>&nbsp;&nbsp;{{count($projet->offres)}} offre(s)&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <?php $tmpListe=array() ?>
                @endforeach
            </div>
            <div class="pull-right">{{ $projets->links() }}</div>
        </div>
        <div class="hidden-md hidden-lg col-sm-12 col-xs-12" style="padding-bottom: 10px;">
            <div class="row" style="padding: 8px">
                <!--h4>Derniers Projets en freelance</h4-->
                @foreach($projets as $projet )
                    <div class="panel projet col-lg-10 col-lg-offset-1" style="padding-bottom: 10px;padding-top: 10px;border: solid 1px #428bca">
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
                            <h4  class="text-primary inline"><a href="{{route('detailProjetUser',["slug"=>$projet->slug->content])}}">{{$projet->titre}}</a></h4>
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
                            <i class="fa fa-eye"></i> {{$projet->nbrVue}} vue(s)&nbsp;&nbsp;
                            <i class="fa fa-hand-o-up"> </i>&nbsp;&nbsp;{{count($projet->offres)}} offre(s)&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <?php $tmpListe=array() ?>
                @endforeach
            </div>
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
                _html='<option value="0">Toutes les technologies</option>';
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