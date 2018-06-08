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


@section("main_content")
    <div class="row">
        <div class="col-lg-8 col-md-9 col-lg-offset-2">
        <div class="adbox-img" >
            <div id="transition-timer-carousel" class="carousel slide transition-timer-carousel " data-ride="carousel" style="min-height: 100px">
                <div class="carousel-inner " style="">
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
    </div>
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-8  col-md-offset-2" style="min-height: 200px;border: solid 1px;margin-top: 10px;color: #428bca;padding-top: 10px">
            <p class="text-center"><img src="{{ url('/img/error-404.png') }}"></p>
            <p ><h2 class="text-center text-primary">page introuvable</h2></p>
            <p class="text-center"><a href="{{route('indexPrestataire')}}" class="btn btn-primary">Acceuil</a></p>
        </div>

    </div>
@endsection
@include('footer')
@section('js')

@endsection