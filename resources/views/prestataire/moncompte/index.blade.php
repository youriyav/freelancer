@extends('prestataire.moncompte.layout')
@section('menu')
    <ul class="nav nav-list" >
        <li class="myActive"><a href="{{route('monCompte')}}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li><a href="{{route('mesProjets')}}"><i class="fa fa-briefcase"></i> Mes Projets</a></li>
        <li><a href="{{route('mesCompetences')}}"><i class="fa fa-sitemap"></i> Mes compétences</a></li>
        <li><a href="{{route('nosServices')}}"><i class="fa fa-envelope"></i> Mes messages</a></li>
        <li><a href="{{route('nosServices')}}"><i class="fa fa-hand-o-up"></i> Mes dévis</a></li>
        <li><a href="{{route('parametres')}}"><i class="fa fa-gears"></i> Paramètre</a></li>
        <li><a href="{{route('nosServices')}}"><i class="fa fa-power-off"></i> Déconnexion</a></li>
    </ul>
@endsection()
@section('main_content_compte')
    <div class="panel panel-default">
        <div class="panel-heading ">
            <h4 class="text-primary">Informations personnelles</h4>
            <!--a href=""><i class="fa fa-edit pull-right fa-2x"></i></a-->
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                    <tr>
                        <th width="20%">Nom</th>
                        <td>
                            <span >{{Auth::user()->name}}</span>
                            <button class="btn btn-sm pull-right btnEdit" id="1">
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
                        <th width="20%">Prenom</th>
                        <td>
                            <span >{{Auth::user()->prenom}}</span>
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
                        <td disabled="disabled">yavoucko@yahoo.fr</td>
                    </tr>
                    <tr>
                        <th>Téléphone <i class="fa fa-mobile-phone pull-right fa-2x"></i></th>
                        <td>
                            <span >{{Auth::user()->phone}}</span>
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
                    <!--tr>
                        <th>Sexe</th>
                        <td>Mark</td>
                    </tr-->
                    <!--tr>
                        <th>Nationalité</th>
                        <td>Mark</td>
                    </tr-->
                    <tr>
                        <th>Description</th>
                        <td>
                            <span >{{Auth::user()->prestataire->description}}</span>
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
            <h4 class="text-primary">Informations de connextion
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
    <!--a href="#" class="btn btn-primary">My Sales Performance</a>
    <a href="#" class="btn btn-primary">Team Sales Performance</a-->
@endsection()
@section('compte_js')
    <script>
        $(function () {
            var mtype=0
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
                    if(mtype==1)
                    {
                        route="/update-name";
                        data={"idPrestataire":{{Auth::user()->id}},"name":_value,"_token":"<?php echo csrf_token() ?>"};
                    }
                    if(mtype==2)
                    {
                        route="/update-prenom";
                        data={"idPrestataire":{{Auth::user()->id}},"name":_value,"_token":"<?php echo csrf_token() ?>"};

                    }
                    if(mtype==3)
                    {
                        route="/update-phone";
                        data={"idPrestataire":{{Auth::user()->id}},"name":_value,"_token":"<?php echo csrf_token() ?>"};
                    }
                    if(mtype==4)
                    {
                        route="/update-description";
                        data={"idPrestataire":{{Auth::user()->id}},"name":_value,"_token":"<?php echo csrf_token() ?>"};
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
                        route="/update-password";
                        data={"idPrestataire":{{Auth::user()->id}},"oldPass":_value,"newPass":$('#newPass').val(),"_token":"<?php echo csrf_token() ?>"};

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
                                location.href="/mon-compte";
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