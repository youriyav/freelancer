@extends('prestataire.layout')
@section("css")
    <link rel="stylesheet" href="{{url('/css/prestataire/index.css')}}">
    <link rel="stylesheet" href="{{url('/css/assets/croppie.css')}}">
    @yield("compte_css")
@endsection
@section('blingbling')

@endsection
@section("mainEntete")

@endsection

@section("main_content")
    <div class="" style="margin-top: -40px">
        <div class="row"  style="">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-offset-0 col-sm-offset-0  toppad" >
                <div class="panel panel-info" style="border: none">
                    <div class="panel-body">
                        <div class="row" style="margin-top: 20px;">
                            <div class="demo"></div>
                            <div class="col-md-3 col-lg-3" align="" style="margin-left: 5px;">
                                @if(Auth::user()->profil)
                                    <p class="text-center"><img alt="User Pic" id="profilImg" src="@if(Auth::user()->profil){{ url(Auth::user()->profil->url) }}@endif" height="100" width="100" class="img-circle" style="border: solid 1px #0088cc"></p>
                                @else
                                    <p class="text-center"><img alt="User Pic" id="profilImg" src="{{url('img/avatar.png')}}" height="100" width="100" class="img-circle" style="border: solid 1px #0088cc"></p>
                                @endif
                                <p class="text-center"><button class="btn btn-primary" id="btnChangeProfil"><i class="fa fa-camera"></i> Modifier</button></p>
                                <input type="file" name="attachement" style="display: none;"  id="attachement">
                            </div>
                            <div class="col-md-3 col-lg-8" >
                                <p class="text-center pull-right">
                                    <a href="{{route('indexPrestataire')}}" class="btn btn-primary btn-lg"><i class="fa fa-home"></i> Acceuil du site</a>
                                    <a href="{{route('nouveauProjet')}}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Creer un projet</a>
                                </p>
                                <div class="row" style="">
                                    @yield('header_content')
                                </div>
                                <div class="row" >
                                    <div class="col-md-10 col-md-offset-1" style="max-height: 100px;">
                                        <div class="adbox-img " >
                                            <div id="transition-timer-carousel" class="carousel slide transition-timer-carousel " data-ride="carousel" style="min-height: 100px">
                                                <div class="carousel-inner" style="">
                                                    <div class="item active">
                                                        <img src="https://moatsearch-data.s3.amazonaws.com/creative_screens/7b/f8/d4/7bf8d4dd35362e8a11a418d4c58bd59c.jpg" class="img-thumbnail" alt="Cinque Terre">
                                                    </div>
                                                    <div class="item">
                                                        <img src="https://moatsearch-data.s3.amazonaws.com/creative_screens/7b/f8/d4/7bf8d4dd35362e8a11a418d4c58bd59c.jpg" class="img-thumbnail" alt="Cinque Terre">
                                                    </div>
                                                    <div class="item">
                                                        <img src="/img/ban.png" class="img-thumbnail" alt="Cinque Terre">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-3 col-lg-3 ">
                                <div class="sidebar-nav">
                                    <div class="well" style=" padding: 8px 0;margin-left: 5px">
                                        <ul class="nav nav-list" >
                                            <li class="nav-header"><h4>Mon Agence</h4></li>
                                            @yield('menu')
                                        </ul>
                                       <p class="text-center" style="margin-top: 10px"><a href="{{route('abonnement')}}" class="btn btn-lg" style="background-color: orange;color: white;padding: 5px;border-radius: 15px">Devenez une agence pro et <br>profiter des avantages</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-7 ">
                                @yield('main_content_compte')
                            </div>
                            <div class="col-lg-2 " style="border: solid 1px cornflowerblue;margin-top: 50px;min-height: 150px">
                                <img src="{{url('img/sen-delivery.png')}}" height="150">
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">

            <div class="loginmodal-container">

                <div id="my-image" >

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="cropImagePop">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Définir la taille d'image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-4 col-sm-offset-2">
                        <div style="display: block; width: 300px; height: 300px;">
                            <div id="upload-demo"></div>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary btn-large" id="btnClose"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Chargement...">Mettre à jour</button>

                </div>
            </div>
        </div>
    </div>





    <div id="" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Crop Image</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-4 col-sm-offset-2">
                        <div style="display: block; width: 300px; height: 300px;">
                            <div id="upload-demo"></div>
                        </div>
                    </div>
                </div>
                <p class="text-center"><button class="btn btn-primary btn-large" id="btnClose"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Chargement...">Mettre à jour</button></p>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@include('footer')

@section('js')
    <script src="{{url('/js/assets/croppie.min.js')}}"></script>
    <script>
        $(function () {
           // $("#cropImagePop").modal('toggle');
            var $uploadCrop,
                tempFilename,
                rawImg,
                imageId;
            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.upload-demo').addClass('ready');
                        $('#cropImagePop').modal('show');
                        rawImg = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
                else {
                    swal("Sorry - you're browser doesn't support the FileReader API");
                }
            }

            $uploadCrop = $('#upload-demo').croppie({
                viewport: {
                    width: 250,
                    height: 250
                },
                enforceBoundary: false,
                enableExif: true
            });
            $('#cropImagePop').on('shown.bs.modal', function(){
                // alert('Shown pop');
                $uploadCrop.croppie('bind', {
                    url: rawImg
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            });

            $('#attachement').on('change', function () { imageId = $(this).data('id'); tempFilename = $(this).val();
                $('#cancelCropBtn').data('id', imageId); readFile(this); });
            $('#cropImageBtn').on('click', function (ev) {
                $uploadCrop.croppie('result', {
                    type: 'base64',
                    format: 'jpeg',
                    size: {width: 1000, height: 1000}
                }).then(function (resp) {
                    $('#item-img-output').attr('src', resp);
                    $('#cropImagePop').modal('hide');
                });
            });
            $('#btnChangeProfil').click(function () {
                $('#attachement').click();
            });
            $('#btnClose').click(function () {
                var $this = $(this);
                $this.button('loading');
                $uploadCrop.croppie('result', {
                    type: 'base64',
                    format: 'jpeg',
                    size: {width: 300, height: 300}
                }).then(function (resp) {
                    $('#profilImg').attr('src', resp);
                    $.ajax({
                        url :"{{route('updateImageProfil')}}",
                        data:{"profil":resp,"_token":"<?php echo csrf_token() ?>"},
                        type : "post",
                        success : function(json)
                        {
                            console.log(json);
                            $this.button('reset');
                            $("#cropImagePop").modal('toggle');
                        },
                        error :function(xhr,errmsg,err)
                        {
                            console.log(xhr);
                            $this.button('reset');
                            $("#cropImagePop").modal('toggle');
                        }
                    });
                })});
        });
    </script>
    @yield('compte_js')
@endsection