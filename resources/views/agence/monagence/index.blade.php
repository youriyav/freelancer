@extends('agence.monagence.layout')
@section('menu')
    <ul class="nav nav-list" >
        <li class="myActive"><a href="{{route('indexAgence')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('nosProjets')}}"><i class="fa fa-briefcase"></i> Nos Projets</a></li>
        <li><a href="{{route('nosServices')}}"><i class="fa fa-sitemap"></i> Nos Services</a></li>
        <li><a href="{{route('nosServices')}}"><i class="fa fa-envelope"></i> Mes messages</a></li>
        <li><a href="{{route('nosServices')}}"><i class="fa fa-hand-o-up"></i> Mes dévis</a></li>
        <li><a href="{{route('nosServices')}}"><i class="fa fa-power-off"></i> Déconnexion</a></li>
    </ul>
@endsection()
@section('main_content_compte')
    <div class="panel panel-default">
        <div class="panel-heading ">
            <h4 class="text-primary">Infos Agence</h4>
            <!--a href=""><i class="fa fa-edit pull-right fa-2x"></i></a-->
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                    <tr>
                        <th width="20%">Raison Sociale</th>
                        <td>
                            <span >{{$agence->raisonSocial}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%">Slogan</th>
                        <td>
                            <span >{{$agence->slogan}}</span>
                            <button class="btn btn-sm pull-right btnEdit" id="2">
                                <i class="fa fa-edit pull-right"></i>
                            </button>
                            <div class="hidden editName">
                                <input type="text" class="form-control input" style="height: 30px;margin-top: 5px"  >
                                <p style="color: red" class="error"></p>
                                <button class="btn btn-sm btn-primary pull-right btnSaveEdit"  data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i class="fa fa-save" style=""></i></button>
                                <button class="btn btn-sm btn-danger pull-right btnCancelEdit" style="margin-right: 3px" ><i class="fa fa-times" style=""></i></button>&nbsp;
                            </div>
                        </td>

                    </tr>
                    <tr disabled="">
                        <th>Email <i class="fa fa-envelope pull-right"></i></th>
                        <td disabled="disabled">{{$agence->email}}</td>
                    </tr>
                    <tr>
                        <th>Téléphone <i class="fa fa-mobile-phone pull-right fa-2x"></i></th>
                        <td>
                            <span >{{$agence->numero}}</span>
                            <button class="btn btn-sm pull-right btnEdit" id="3">
                                <i class="fa fa-edit pull-right"></i>
                            </button>
                            <div class="hidden editName">
                                <input type="text" class="form-control input" style="height: 30px;margin-top: 5px"  >
                                <p style="color: red" class="error"></p>
                                <button class="btn btn-sm btn-primary pull-right btnSaveEdit"  data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i class="fa fa-save" style=""></i></button>
                                <button class="btn btn-sm btn-danger pull-right btnCancelEdit" style="margin-right: 3px" ><i class="fa fa-times" style=""></i></button>&nbsp;

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Boite Postale <i class="fa fa-inbox pull-right fa-2x"></i></th>
                        <td>
                            <span >{{$agence->boitePostal}}</span>
                            <button class="btn btn-sm pull-right btnEdit" id="6">
                                <i class="fa fa-edit pull-right"></i>
                            </button>
                            <div class="hidden editName">
                                <input type="text" class="form-control input" style="height: 30px;margin-top: 5px"  >
                                <p style="color: red" class="error"></p>
                                <button class="btn btn-sm btn-primary pull-right btnSaveEdit"  data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i class="fa fa-save" style=""></i></button>
                                <button class="btn btn-sm btn-danger pull-right btnCancelEdit" style="margin-right: 3px" ><i class="fa fa-times" style=""></i></button>&nbsp;

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>
                            <span >{{$agence->description}}</span>
                            <button class="btn btn-sm pull-right btnEdit" id="4">
                                <i class="fa fa-edit pull-right"></i>
                            </button>
                            <div class="hidden editName">
                                <textarea rows="3" type="text" class="form-control input" style="margin-top: 5px"  ></textarea>
                                <p style="color: red" class="error"></p>
                                <button class="btn btn-sm btn-primary pull-right btnSaveEdit"  data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i class="fa fa-save" style=""></i></button>
                                <button class="btn btn-sm btn-danger pull-right btnCancelEdit" style="margin-right: 3px" ><i class="fa fa-times" style=""></i></button>&nbsp;
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading text-primary">
            <h4 class="text-primary">Adresse</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                    <tr>
                        <th width="20%">Adresse <i class="fa fa-location-arrow pull-right fa-2x"></i></th>
                        <td>
                            <span >{{$agence->adresse}}</span>
                            <button class="btn btn-sm pull-right btnEdit" id="7">
                                <i class="fa fa-edit pull-right"></i>
                            </button>
                            <div class="hidden editName">
                                <textarea rows="3" type="text" class="form-control input" style="margin-top: 5px"  ></textarea>
                                <p style="color: red" class="error"></p>
                                <button class="btn btn-sm btn-primary pull-right btnSaveEdit"  data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i class="fa fa-save" style=""></i></button>
                                <button class="btn btn-sm btn-danger pull-right btnCancelEdit" style="margin-right: 3px" ><i class="fa fa-times" style=""></i></button>&nbsp;
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%">Adresse <i class="fa fa-map-marker pull-right fa-2x"></i></th>
                        <td>
                            @if($agence->longitude==null)
                                <button  class="btn btn-primary" id="btn-location">Définir la position de votre agence sur google map</button>
                            @else
                                <button  class="btn btn-primary"  id="btn-location">Modifier la position de votre agence sur google map</button>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading text-primary">
            <h4 class="text-primary">Info de connextion</h4>
            <!--a href=""><i class="fa fa-edit pull-right fa-2x"></i></a-->
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                    <tr>
                        <th>Login</th>
                        <td>{{Auth::user()->login}}</td>
                    </tr>
                    <tr>
                        <th width="20%">Mot de passe</th>
                        <td>
                            <span >*******</span>
                            <button class="btn btn-sm pull-right btnEdit" id="5">
                                <i class="fa fa-edit pull-right"></i>
                            </button>
                            <div class="hidden editName">
                                <label for="oldPass">Ancien mot de passe</label>
                                <input id="oldPass" type="password" class="form-control input" style="height: 30px;margin-top: 5px"  >
                                <p style="color: red" class="error"></p>
                                <label for="newPass">Nouveau mot de passe</label>
                                <input id="newPass" type="password" class="form-control " style="height: 30px;margin-top: 5px" >
                                <p style="color: red" id="errorPass"></p>
                                <label for="newPassConf">confirmé nouveau mot de passe</label>
                                <input id="newPassConf" type="password" class="form-control " style="height: 30px;margin-top: 5px"  >
                                <p style="color: red" id="errorPassConf"></p>
                                <button class="btn btn-sm btn-primary pull-right btnSaveEdit"  data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i class="fa fa-save" style=""></i></button>
                                <button class="btn btn-sm btn-danger pull-right btnCancelEdit" style="margin-right: 3px" ><i class="fa fa-times" style=""></i></button>&nbsp;

                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalLocation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white">&times;</span>
                    </button>
                    <h5 class="modal-title" id="tile-modal-location">Définir la position de votre agence</h5>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-4 ">
                        <div style="display: block; width: 540px; height: 400px;">
                            <div id="map" style="height: 100%;">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
                <div class="modal-footer">
                        <div class="pull-left" style="margin-top: -15px" >
                            <div class="row" style="margin: 0">
                                @if($agence->longitude==null)
                                    <p>Latitude:<span id="lati">non définie</span></p>
                                @else
                                    <p>Latitude:<span id="lati">{{$agence->latitude}}</span></p>
                                @endif
                            </div>
                            <div class="row" style="margin: 0;">
                                @if($agence->longitude==null)
                                    <p>Longitude:<span id="longi">non définie</span></p>
                                @else
                                    <p>Longitude:<span id="longi">{{$agence->longitude}}</span></p>
                                @endif
                            </div>
                        </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary btn-large" id="btnUpdateLocation"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Mise à jour...">Mettre à jour</button>

                </div>
            </div>
        </div>
    </div>
    <!--a href="#" class="btn btn-primary">My Sales Performance</a>
    <a href="#" class="btn btn-primary">Team Sales Performance</a-->
@endsection()
@section('compte_js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoYTOg7ACi_NsdiRJPeVnPOLs7KkjDw3k&callback=initMap" async defer></script>
    <script src="{{url('/js/assets/notify.min.js')}}"></script>
    <script>
        var map;
        var clickLat;
        var clickLon;
        var myEvent=null;
        var markers = [];
        var longitude="{{$agence->longitude}}";
        var latitude="{{$agence->latitude}}";
        var api_key_map="AIzaSyBoYTOg7ACi_NsdiRJPeVnPOLs7KkjDw3k";
        var isUpdated=0;
        function addMarker(location) {
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            markers.push(marker);
        }
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }
        function clearMarkers() {
            setMapOnAll(null);
        }
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 14.7283189, lng: -17.4446152},
                zoom: 12,
                gestureHandling: 'greedy'
            });
            google.maps.event.addListener(map, 'click', function(event) {
                deleteMarkers();
                addMarker(event.latLng);
                myEvent=event;
                $("#lati").text(event.latLng.lat());
                $("#longi").text(event.latLng.lng());

            });
            if(longitude!="")
            {
                var myLatLng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
                addMarker(myLatLng);
                //myEvent=myLatLng;
                console.log(myEvent);
                isUpdated=1;
            }

        }
        $(function () {
            var mtype=0;
            $("#btnUpdateLocation").click(function () {
                var $this = $(this);
                console.log(myEvent);
                if(myEvent!=null)
                {
                    $this.button('loading');
                    _data={"lat":myEvent.latLng.lat(),"lng":myEvent.latLng.lng(),"_token":"<?php echo csrf_token() ?>"};
                    $.ajax({
                        url :"/agence/update-gps-coordonne",
                        data:_data,
                        type : "post",
                        success : function(json)
                        {
                            console.log(json);
                            $this.button('reset');
                            $("#tile-modal-location").text("Modifier la position de votre agence");
                            $("#modalLocation").modal('toggle');
                            longitude=myEvent.latLng.lng();
                            latitude=myEvent.latLng.lat();
                            $.notify("Mise à jour éffectuée avec succès!", "info");
                        },
                        error :function(xhr,errmsg,err)
                        {
                            console.log(xhr);
                            $this.button('reset');
                            $("#modalLocation").modal('toggle');
                        }
                    });
                }
                else
                {
                    if(isUpdated==1)
                    {
                        $("#modalLocation").modal('toggle');
                    }
                    else
                    {
                        $("#btnUpdateLocation").notify("veuillez définir votre position sur la carte d'abord", "error",{ position:"right" });

                    }
                }
            });
            $("#btn-location").click(function () {
                myEvent=null;
                if(longitude=="")
                {
                    $("#tile-modal-location").text("Définir la position de votre agence");
                }
                else
                {
                    $("#tile-modal-location").text("Modifier la position de votre agence");
                }
                $("#modalLocation").modal('toggle');
            });
            $('.btnEdit').click(function () {
                mtype=$(this).attr('id');
                $(this).hide();
                $(this).parent().find('span').hide();
                if(mtype!=5)
                {
                    $(this).parent().find(".input").val($(this).parent().find('span').text());
                }
                $(this).parent().find(".editName").removeClass('hidden');
            });
            $('.btnCancelEdit').click(function () {
                $(this).parent().addClass('hidden');
                $(this).parent().parent().find('.btnEdit').show();
                $(this).parent().parent().find('span').show();
                //$("#blocName").removeClass('hidden');
            });
            $('.btnSaveEdit').click(function () {
                var $this = $(this);
                var _value =$this.parent().find('.input').val();
                var btnEdit = $this.parent().parent().find('.btnEdit');
                var error = $this.parent().parent().find('.error');
                var _span = $this.parent().parent().find('span');
                error.text("");
                if(_value!="")
                {
                    route="";
                    data="";
                    if(mtype==2)
                    {
                        route="/agence/update-slogan";
                        data={"value":_value,"_token":"<?php echo csrf_token() ?>"};

                    }
                    if(mtype==3)
                    {
                        route="/agence/update-phone";
                        data={"value":_value,"_token":"<?php echo csrf_token() ?>"};
                    }
                    if(mtype==4)
                    {
                        route="/agence/update-description";
                        data={"value":_value,"_token":"<?php echo csrf_token() ?>"};
                    }
                    if(mtype==6)
                    {
                        route="/agence/update-bp";
                        data={"value":_value,"_token":"<?php echo csrf_token() ?>"};
                    }
                    if(mtype==7)
                    {
                        route="/agence/update-adresse";
                        data={"value":_value,"_token":"<?php echo csrf_token() ?>"};
                    }

                    $('#errorPass').text("");
                    $('#newPassConf').text("");
                    if(mtype==5)
                    {
                        isError=0;
                        if($('#newPass').val()=="")
                        {
                            $('#errorPass').text("veuiller remplir ce champs");
                            isError++;
                        }
                        if($('#newPassConf').val()=="")
                        {
                            $('#errorPassConf').text("veuiller remplir ce champs");
                            isError++;
                        }
                        if($('#newPass').val()!="" && $('#newPassConf').val()!="")
                        {
                            if($('#newPass').val()!=$('#newPassConf').val())
                            {
                                $('#errorPassConf').text("les deux mots de passe ne sont pas identiques");
                                isError++;
                            }
                        }
                        if(isError!=0)
                        {
                            return 0;
                        }
                        route="/agence/update-password";
                        data={"oldPass":$("#oldPass").val(),"newPass":$('#newPass').val(),"_token":"<?php echo csrf_token() ?>"};

                    }
                    $this.button('loading');
                    $.ajax({
                        url :route,
                        // processData: false,
                        //contentType: false,
                        data:data,
                        type : "post",
                        //beforeSend: function(xhr){xhr.setRequestHeader("X-CSRFToken", csrftoken);},
                        success : function(json)
                        {
                            console.log(json);
                            $this.button('reset');
                            _span.text(_value);
                            $(this).parent().addClass('hidden');
                            btnEdit.show();
                            _span.show();
                            $this.parent().addClass('hidden');
                            if(mtype==5)
                            {
                                location.href="/agence";
                            }

                        },
                        error :function(xhr,errmsg,err)
                        {
                            console.log(xhr);

                            $this.button('reset');
                            if(mtype==5)
                            {
                                if(xhr.status==401)
                                {
                                    error.text("mot de passe incorrect");
                                }
                            }
                        }
                    });
                }
                else
                {
                    error.text("veuiller remplir ce champ")
                }



            });
        });
    </script>
@endsection