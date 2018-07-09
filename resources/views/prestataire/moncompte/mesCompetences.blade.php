@extends('prestataire.moncompte.layout')
@section('menu')
    <ul class="nav nav-list" >
        <li ><a href="{{route('monCompte')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('mesProjets')}}"><i class="fa fa-briefcase"></i> Mes Projets</a></li>
        <li class="myActive"><a href="{{route('mesCompetences')}}"><i class="fa fa-briefcase"></i> Mes compétences</a></li>
    </ul>
@endsection()
@section('compte_css')
    <link href="{{url('/css/assets/jquery-ui.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/chosen.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/uniform.default.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/jquery.inputlimiter.1.0.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/colorpicker.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/jquery.tagsinput.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/daterangepicker-bs3.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/datepicker.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/bootstrap-timepicker.min.css')}}" rel="stylesheet" />
    <link href="{{url('/css/assets/bootstrap-switch.css')}}" rel="stylesheet" />
@endsection
@section('main_content_compte')
    <div class="panel panel-default">
        <div class="panel-heading text-primary">
            <h4 class="text-primary">Mes compétences</h4>
            <!--a href=""><i class="fa fa-edit pull-right fa-2x"></i></a-->
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table  table-bordered ">
                    <tbody>
                    <tr>
                        <th width="30%">Langue(s) parlée(s)</th>
                        <td>
                            <form class="form-horizontal">
                                <select id="description" name="description[]" required data-placeholder="ajouter des description"  class="form-control chzn-select" multiple="multiple" tabindex="8" style="height:50px;">
                                    @foreach($listeLangue as $langue)
                                        <option  value="{{$langue->id}}" @foreach(Auth::user()->langues as $langue2) @if($langue2->id==$langue->id) selected @endif @endforeach >{{$langue->libelle}}</option>
                                    @endforeach
                                </select>
                                <div class="hidden blocBtn" style="margin-top: 8px">
                                    <button class="btn btn-sm btn-primary pull-right btnSaveEdit" id="1"  data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i class="fa fa-save" style=""></i></button>
                                    <button class="btn btn-sm btn-danger pull-right btnCancelEdit" id="1" style="margin-right: 3px" ><i class="fa fa-times" style=""></i></button>&nbsp;

                                </div>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <th width="30%">Technologies</th>
                        <td>
                            <form class="form-horizontal">
                                <select id="description" name="description[]" required data-placeholder="ajouter des description"  class="form-control chzn-select" multiple="multiple" tabindex="8" style="height:50px;">
                                    @foreach($listeOfPlat as $plat)
                                        <option value="82" style="background-color:#888888; font-weight: bold;text-transform: uppercase;color: white" disabled=""> ----- {{$plat->libelle}} ----- </option>
                                        <span class="main_select">@foreach($plat->technologies as $techno)
                                            <option  value="{{$techno->id}}" @foreach(Auth::user()->technologies as $tech) @if($tech->id==$techno->id) selected @endif @endforeach >{{$techno->libelle}}</option>
                                        @endforeach</span>
                                    @endforeach
                                </select>
                                <div class="hidden blocBtn" style="margin-top: 8px">
                                    <button class="btn btn-sm btn-primary pull-right btnSaveEdit" id="2"  data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i class="fa fa-save" style=""></i></button>
                                    <button class="btn btn-sm btn-danger pull-right btnCancelEdit" id="2" style="margin-right: 3px" ><i class="fa fa-times" style=""></i></button>&nbsp;

                                </div>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading text-primary">
            <h4 class="text-primary">Mes réalisations</h4>
            <p class="text-summury">vos réalisations permettent de rendre le client plus confiant en vers vous.</p>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead>
                    <tr>
                        <th colspan="2">Url (vous pouvez ajouter des liens des applications, sites etc.. dont vous avez eu à réaliser .)<button class="btn btn-sm btn-primary pull-right" id="add-url"><i class="fa fa-plus-circle"></i> Ajouter</button></th>
                    </tr>
                    </thead>
                    <tbody id="listSite">
                    @foreach(\Illuminate\Support\Facades\Auth::user()->prestataire->sites as $site)
                        <tr>
                            <td width="30%" id="libelle_{{$site->id}}">{{$site->libelle}}</td>
                            <td>
                                @if(starts_with($site->url,"http://") or starts_with($site->url,"https://"))
                                    <a href="{{$site->url}}" target="_blank" id="url_{{$site->id}}">{{$site->url}}</a>
                                @else
                                    <a href="http://{{$site->url}}" target="_blank" id="url_{{$site->id}}">{{$site->url}}</a>
                                @endif

                                <div class="pull-right">
                                    <button id="editsite_{{$site->id}}" class="btn btn-default btn_edit_url" href=""><i class="fa fa-edit"></i></button>
                                    <button id="delsite_{{$site->id}}" class="btn btn-danger btn_delete_url" href=""><i class="fa fa-trash-o" ></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th colspan="2">Images (vous pouvez ajouter des images, des capture d'écran de vos ralisations)<button class="btn btn-sm btn-primary pull-right" id="btnImport"><i class="fa fa-upload"></i> Importer</button></th>
                                        <input type="file" name="attachement" style="display: none;"  id="attachementImport">
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="panel-body">
                                <div class="row" id=" container-pictures">
                                    @foreach(\Illuminate\Support\Facades\Auth::user()->prestataire->pictures as $picture)
                                        <div class=" col-md-4" id="bloc_{{$picture->id}}">
                                            <div class="thumbnail">
                                                <img src="{{$picture->url}}" alt="...">
                                                <div class="caption">
                                                    <!--h3>Thumbnail label</h3-->
                                                    <p>...</p>
                                                    <p>
                                                        <button id="btn_edit_{{$picture->id}}"  class="btn btn-edit-picture" style="background-color: transparent;margin-right: 0;padding: 0" role="button"><i class="fa fa-edit " title="editer"></i></button>
                                                        <button id="btn_del_{{$picture->id}}"  class="btn btn btn-delete-picture" role="button" style="background-color: transparent;margin-left: 5px;padding: 0"><i style="color: red" class="fa fa-trash-o" title="supprimer"></i></button>
                                                        <a href="{{$picture->url}}" target="_blank" class="btn btn-default pull-right" role="button">Voir</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('footer')
@include('prestataire.moncompte.modalCompetences')
    <a href="#" class="btn btn-primary">My Sales Performance</a>
    <a href="#" class="btn btn-primary">Team Sales Performance</a>
@endsection()
@section('compte_js')
    @include('prestataire.moncompte.competence-js')
    <script>

        var idSite;
        var actionType;
        var idPicture;
        function editPicture($this)
        {
            actionType=2;
            idPicture=$this.prop("id").split('_')[2];
            $('#attachementImport').click();
        }
        function deletePicture($this)
        {
            idPicture=$this.prop("id").split('_')[2];
            $("#modalDeletePicture").modal('toggle');
        }
        $("#btnDeletePicture").click(function (e) {
            $this=$(this);
            $this.button('loading');
            $.ajax({
                url :"/delete-picture/"+idPicture,
                type : "GET",
                success : function(json)
                {
                    console.log(json);
                    $this.button('reset');
                    $("#modalDeletePicture").modal('toggle');
                    $("#bloc_"+idPicture).fadeOut();

                },
                error :function(xhr,errmsg,err)
                {
                    console.log(xhr);
                    $this.button('reset');
                    $("#modalDeletePicture").modal('toggle');
                }
            });
        });
        $(function () {
            formInit();
            $(".chzn-select").change(function () {
                $this=$(this);
                $blocBtn=$this.parent().find(".blocBtn");
                $blocBtn.removeClass('hidden');
            });
            $uploadCrop = $('#upload-realisation').croppie({
                viewport: {
                    width: 250,
                    height: 250
                },
                enforceBoundary: false,
                enableExif: true
            });

            $(".btn-edit-picture").click(function () {
                $this=$(this);
                editPicture($this);
            });
            $(".btn-delete-picture").click(function () {
                $this=$(this);
                deletePicture($this);
            });

            $('#modalImportImage').on('shown.bs.modal', function(){
                // alert('Shown pop');
                $uploadCrop.croppie('bind', {
                    url: rawImg
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            });

            $('#btnImport').click(function () {
                actionType=1;
                $('#attachementImport').click();
            });
            $('#attachementImport').on('change', function ()
            {
                imageId = $(this).data('id');
                tempFilename = $(this).val();
                //$('#cancelCropBtn').data('id', imageId);
                readFile(this);
            });


            $(".btn_delete_url").click(function (e) {
                $this=$(this);
                deleteSite($this);
            });

            $(".btn_edit_url").click(function (e) {
                $this=$(this);
                editSite($this);
            });
            $("#add-url").click(function (e) {
                $("#modalNewUrl").modal('toggle');
            });
            $("#btnAddUrl").click(function (e) {
                $this=$(this);
                $libelle=$("#add_url_libelle").val();
                $url=$("#add_url_url").val();
                $isError=false;
                $('#error_add_url_libelle').text("");
                $('#error_add_url_lien').text("");
                if($libelle=="")
                {
                    $('#error_add_url_libelle').text("Veuillez remplir ce champs");
                    $isError=true;
                }
                if($url=="")
                {
                    $('#error_add_url_lien').text("Veuillez remplir ce champs");
                    $isError=true;
                }
                if(!$isError)
                {
                    $this.button('loading');
                    $.ajax({
                        url :"/new-url",
                        data:{"libelle":$libelle,"url":$url,"_token":"<?php echo csrf_token() ?>"},
                        type : "post",
                        success : function(json)
                        {
                            console.log(json);
                            $this.button('reset');
                            murl="";
                            if(startWith("http://",$url) || startWith("https://",$url))
                            {
                                murl =$url;
                            }
                            else
                            {
                                murl="http://"+$url;
                            }
                            _html='<tr>' +
                                '<td width="30%" id="libelle_'+json+'">'+$libelle+'</td>' +
                                '<td>' +
                                '<a href="'+murl+'" target="_blank" id="url_'+json+'">'+murl+'</a>' +
                                ' <div class="pull-right">' +
                                '<button id="editsite_'+json+'" class="btn btn-default btn_edit_url btn_new_edit_url" href=""><i class="fa fa-edit"></i></button> ' +
                                '<button id="delsite_'+json+'" class="btn btn-danger btn_delete_url btn_new_delete_url" href=""><i class="fa fa-trash-o"></i></button>' +
                                '</div></td>' +
                                '</tr>';
                            $("#listSite").append(_html);
                            $(".btn_new_delete_url").click(function (e) {
                                $this=$(this);
                                deleteSite($this);
                            });
                            $(".btn_new_edit_url").click(function (e) {
                                $this=$(this);
                                editSite($this)
                            });
                            $("#modalNewUrl").modal('toggle');
                            $.notify("Lien ajouté avec succès!", "info");

                        },
                        error :function(xhr,errmsg,err)
                        {
                            console.log(xhr);
                            $this.button('reset');
                            $("#modalNewUrl").modal('toggle');
                        }
                    });
                }
            });
            $("#btnEditUrl").click(function (e) {
                $this=$(this);
                $libelle=$("#edit_url_libelle").val();
                $url=$("#edit_url_url").val();
                $isError=false;
                $('#error_edit_url_libelle').text("");
                $('#error_edit_url_lien').text("");
                if($libelle=="")
                {
                    $('#error_edit_url_libelle').text("Veuillez remplir ce champs");
                    $isError=true;
                }
                if($url=="")
                {
                    $('#error_edit_url_lien').text("Veuillez remplir ce champs");
                    $isError=true;
                }
                if(!$isError)
                {
                    $this.button('loading');
                    $.ajax({
                        url :"/edit-url",
                        data:{"id":idSite,"libelle":$libelle,"url":$url,"_token":"<?php echo csrf_token() ?>"},
                        type : "post",
                        success : function(json)
                        {
                            console.log(json);
                            $this.button('reset');
                            $("#modalEditUrl").modal('toggle');
                            $("#libelle_"+idSite).text($libelle);
                            $("#url_"+idSite).text($url);

                            if(startWith("http://",$url) || startWith("https://",$url))
                            {
                                $("#url_"+idSite).prop("href",$url);
                            }
                            else
                            {
                                $("#url_"+idSite).prop("href","http://"+$url);
                            }
                            $.notify("modification éffectuée avec succès!", "info");

                        },
                        error :function(xhr,errmsg,err)
                        {
                            console.log(xhr);
                            $this.button('reset');
                            $("#modalEditUrl").modal('toggle');
                        }
                    });
                }
            });
            $("#btnDeleteUrl").click(function (e) {
                $this=$(this);
                $this.button('loading');
                $.ajax({
                        url :"/delete-url/"+idSite,
                        type : "GET",
                        success : function(json)
                        {
                            console.log(json);
                            $this.button('reset');
                            $("#modalDeleteUrl").modal('toggle');
                            $("#delsite_"+idSite).parent().parent().parent().fadeOut()

                        },
                        error :function(xhr,errmsg,err)
                        {
                            console.log(xhr);
                            $this.button('reset');
                            $("#modalDeleteUrl").modal('toggle');
                        }
                });
            });

            $(".btnCancelEdit").click(function (e) {
                e.preventDefault();
                mtype=$(this).attr('id');
                $this=$(this);
                $form=$this.parent().parent();
                $this.parent().addClass("hidden");
                if(mtype==1)
                {
                    _html='<select id="description" name="description[]" required data-placeholder="ajouter des description"  class="form-control chzn-select" multiple="multiple" tabindex="8" style="height:50px;">\n';
                    check=0;

                    for(j=0;j<listeLangue.length;j++)
                    {
                        check=0;
                            for(y=0;y<listeUserLangue.length;y++)
                            {
                                if(listeLangue[j].id==listeUserLangue[y].id)
                                {
                                    check=1;
                                }
                            }
                            if(check==1)
                            {
                                _html+='<option  value="'+listeLangue[j].id+'"  selected>'+listeLangue[j].libelle+'</option>'
                            }
                            else
                            {
                                _html+='<option  value="'+listeLangue[j].id+'"  >'+listeLangue[j].libelle+'</option>'
                            }
                    }
                    _html+='</select>';
                    $form.html(_html);
                }
                else
                {
                    console.log(listeOfPlat);
                    console.log(listeOfTechnologies);
                    _html='<select id="description" name="description[]" required data-placeholder="ajouter des description"  class="form-control chzn-select" multiple="multiple" tabindex="8" style="height:50px;">';
                    check=0;
                    for(i=0;i<listeOfPlat.length;i++)
                    {
                        _html+='<option value="82" style="background-color:#888888; font-weight: bold;text-transform: uppercase;color: white" disabled=""> ----- '+listeOfPlat[i].libelle+' ----- </option>';
                        for(j=0;j<listeOfTechnologies.length;j++)
                        {
                            check=0;
                            if(listeOfPlat[i].id==listeOfTechnologies[j].plateforme_id)
                            {
                                for(y=0;y<listeUserTechno.length;y++)
                                {
                                    if(listeOfTechnologies[j].id==listeUserTechno[y].id)
                                    {
                                        check=1;
                                    }
                                }
                                if(check==1)
                                {
                                    _html+='<option  value="'+listeOfTechnologies[j].id+'"  selected>'+listeOfTechnologies[j].libelle+'</option>'
                                }
                                else
                                {
                                    _html+='<option  value="'+listeOfTechnologies[j].id+'"  >'+listeOfTechnologies[j].libelle+'</option>'
                                }

                            }
                        }
                    }
                    _html+='</select>';
                    $form.html(_html);
                }
                formInit();

            });
            $(".btnSaveEdit").click(function (e) {
                e.preventDefault();
                mtype=$(this).attr('id');
                var $this = $(this);
                $select=$this.parent().parent().find('select');
                route="";
                data="";
                if(mtype==1)
                {
                    route="/update-langues";
                    data={"idPrestataire":'{{Auth::user()->id}}',"langues":$select.val(),"_token":"<?php echo csrf_token() ?>"};
                }
                if(mtype==2)
                {
                    route="/update-technologies";
                    data={"idPrestataire":'{{Auth::user()->id}}',"technologies":$select.val(),"_token":"<?php echo csrf_token() ?>"};
                }

                $this.button('loading');
                $.ajax({
                    url :route,
                    data:data,
                    type : "post",
                    success : function(json)
                    {
                        if(mtype==1)
                        {
                            listeUserLangue=JSON.parse(json);
                        }
                        else
                        {
                            listeUserTechno=JSON.parse(json);
                        }

                        console.log(listeUserTechno);
                        $this.button('reset');
                        $this.parent().addClass('hidden');
                    },
                    error :function(xhr,errmsg,err)
                    {
                        console.log(xhr);
                        $this.button('reset');
                    }
                });
            });

            $('#btnImporter').on('click', function (ev) {
                var $this = $(this);
                $uploadCrop.croppie('result', {
                    type: 'base64',
                    format: 'jpeg',
                    size: {width: 1000, height: 1000}
                }).then(function (resp) {
                    $('#item-img-output').attr('src', resp);
                    $this.button('loading');
                    if(actionType==1)
                    {
                        $.ajax({
                            url :"/importer-image-realisation",
                            data:{"image":resp,"_token":"<?php echo csrf_token() ?>"},
                            type : "post",
                            success : function(json)
                            {
                                console.log(json);
                                _data=JSON.parse(json);
                                dd(_data);
                                $this.button('reset');

                                _html='<div class=" col-md-4" id="bloc_'+_data.id+'">' +
                                    '<div class="thumbnail">' +
                                    '<img src="/'+_data.url+'" alt="...">' +
                                    '<div class="caption">' +
                                    '<p>...</p>' +
                                    '<p>' +
                                    '<button id="btn_edit_'+_data.id+'"  class="btn btn-edit-picture" style="background-color: transparent;margin-right: 0;padding: 0" role="button"><i class="fa fa-edit " title="editer"></i></button>' +
                                    '<button id="btn_del_'+_data.id+'"  class="btn btn-delete-picture" style="background-color: transparent;margin-right: 0;padding: 0" role="button"><i style="color:red" class="fa fa-trash-o" title="supprimer"></i></button>' +
                                    '<a href="/'+_data.url+'" target="_blank" class="btn btn-default pull-right" role="button">Voir</a>' +
                                    '</p>' +
                                    '</div>' +
                                    '</div>'+
                                    '</div>';
                                $("#container-pictures").append(_html);
                                $("#btn_edit_"+_data.id).click(function () {
                                    $this=$(this);
                                    editPicture($this);
                                });
                                $("#btn_del_"+_data.id).click(function () {
                                    $this=$(this);
                                    deletePicture($this);
                                });
                                $("#bloc_"+_data.id).hide();
                                $('#modalImportImage').modal('toggle');
                                $("#bloc_"+_data.id).fadeIn(3000);
                                $.notify("fichier envoyé avec succès!", "info");
                            },
                            error :function(xhr,errmsg,err)
                            {
                                console.log(xhr);
                                $this.button('reset');
                                $('#modalImportImage').modal('toggle');
                            }
                        });
                    }
                    else
                    {
                        $.ajax({
                            url :"/editer-image-realisation/",
                            data:{"idPicture":idPicture,"image":resp,"_token":"<?php echo csrf_token() ?>"},
                            type : "post",
                            success : function(json)
                            {
                                console.log(json);
                                _data=JSON.parse(json);
                                dd(_data);
                                $this.button('reset');
                                $('#modalImportImage').modal('toggle');
                                $("#bloc_"+idPicture).fadeTo("slow",0.1,function () {
                                    $("#bloc_"+idPicture).find('img').first().attr('src', resp);
                                    $("#bloc_"+idPicture).fadeTo("slow",1);
                                });
                                $.notify("fichier modifié avec succès!", "info");
                            },
                            error :function(xhr,errmsg,err)
                            {
                                console.log(xhr);
                                $this.button('reset');
                                $('#modalImportImage').modal('toggle');
                            }
                        });

                    }




                });
            });
            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.upload-realisation').addClass('ready');
                        $('#modalImportImage').modal('toggle');
                        rawImg = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
                else {
                    swal("Sorry - you're browser doesn't support the FileReader API");
                }
            }

        });
    </script>

@endsection