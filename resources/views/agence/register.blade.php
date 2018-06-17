@extends('prestataire.layout2')
@section("css")
    <link rel="stylesheet" href="{{url('/css/agence/register.css')}}">
@endsection
@section("main_content")
    <div class="row" >
        <div class="col-md-6 col-md-offset-3" style="max-height: 100px;">
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
    <section class="content row" style="background-color: #fafafa;margin-top: -20px">
        <div class="row" style="margin-bottom: 10px;">
            <h3 class="text-center text-primary" style="text-decoration: underline;margin-bottom: 20px">Créer votre vitrine</h3>
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs"style="padding: 5px" >
                <div class="panel panel-primary" >
                    <div class="panel-title panel-heading">
                        <h3 class=" text-center ">Pourquoi créer un compte Agence?</h3>
                    </div>
                    <div class="panel-body ">
                        <ul class="list-group">
                            <li class="list-group-item" style="color: #428bca"><i class="fa fa-check-circle fa-2x"  style="float: left"></i> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px">Plus de 30 000 clients</span></li>
                            <li class="list-group-item" style="color: #428bca"><i class="fa fa-check-circle fa-2x"  style="float: left"></i> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px">Plus de 2 000 projets/mois</span></li>
                            <li class="list-group-item" style="color: #428bca"><i class="fa fa-check-circle fa-2x " style="float: left"></i> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px">1ère communauté de freelance au Sénégal</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-9" style="padding: 20px;padding-top: 0">
                <div style="background-color: white" class="row">
                    <form id="registerForm" role="form" class="col-md-10 col-md-offset-1 form-horizontal" method="post" action="{{route('nouvelleAgence')}}" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <fieldset class="scheduler-border ">
                            <legend class="scheduler-border">Infos Agence</legend>
                            <div class="form-group" >
                                <label>Raison social *</label>
                                <input required id="raisonSocial" type="text" class="form-control"  value="@isset($raisonSocial){{$raisonSocial}} @endisset"  placeholder="entrer le nom de votre entreprise" name="raisonSocial" >
                                <p style="color: red" id="errorRs">@isset($tabError){{$tabError[0]}}@endisset</p>
                            </div>
                            <div class="form-group ">
                                <label>Email *</label>
                                <input required id="email" type="text" class="form-control"  value="@isset($email){{$email}} @endisset"  placeholder="entrer l'email de votre entreprise" name="email" >
                                <p style="color: red" id="errorEmail">@isset($tabError){{$tabError[1]}}@endisset</p>
                            </div>
                            <div class="form-group">
                                <label>Numero *</label>
                                <input required id="numero" type="text" class="form-control"  value="@isset($numero){{$numero}} @endisset"  placeholder="entrer le numero de votre entreprise" name="numero" >
                                <p style="color: red" id="errorNumero">@isset($tabError){{$tabError[2]}}@endisset</p>
                            </div>

                            <div class="form-group">
                                <label>Boite postale (facultatif)</label>
                                <input id="bPostal" type="text" class="form-control"  value="@isset($bPostal){{$bPostal}} @endisset"  placeholder="entrer la bote postale de votre entreprise" name="bPostal" >
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Infos Administrateur</legend>
                            <div class="form-group">
                                <label>Login</label>
                                <input required id="login" type="text" class="form-control" value="@isset($login){{$login}} @endisset" placeholder="entrer votre login" name="login" >
                                <p style="color: red" id="erroLogin">@isset($tabError){{$tabError[3]}}@endisset</p>
                            </div>
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input required id="password" type="password" class="form-control"  placeholder="" name="password"  >
                                <p style="color: red" id="erroPass">@isset($tabError){{$tabError[4]}}@endisset</p>
                            </div>
                            <div class="form-group">
                                <label>confirmation Mot de passe</label>
                                <input required id="passwordConf" type="password" class="form-control" placeholder="" name="passwordConf" >
                                <p style="color: red" id="erroPassConf">@isset($tabError){{$tabError[5]}}@endisset</p>
                            </div>
                        </fieldset>
                        <div class="checkbox">
                            <label>
                                <input required class="uniform" id="condition" @isset($condition) @if($condition==1) @endif checked @endisset type="checkbox" value="1" name="condition" /> La création d'un compte implique que vous avez lu et accepté les termes et <a href="">conditions d'utilisation.</a>
                            </label>
                            <p style="color: red" id="erroCondition">@isset($tabError){{$tabError[6]}}@endisset</p>
                        </div>
                        <div class="form-group">
                            <p class="pull-right"><input type="submit" class="btn btn-primary btn-lg " value="Valider" id="btn-inscipt"></p>
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs"style="padding: 5px" >
                <div class="panel panel-primary" >
                    <div class="panel-title panel-heading">
                        <h3 class=" text-center ">Commenet ça marche?</h3>
                    </div>
                    <div class="panel-body ">
                        <ul class="list-group">
                            <li class="list-group-item" style="color: #428bca"><span style="font-weight: bold;font-size: 1.3em;float: left">1. </span> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px;">Le client dépose un projet</span></li>
                            <li class="list-group-item" style="color: #428bca"><span style="font-weight: bold;font-size: 1.3em;float: left">2. </span> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px;">Les freelances proposent des devis</span></li>
                            <li class="list-group-item" style="color: #428bca"><span style="font-weight: bold;font-size: 1.3em;float: left">3. </span> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px;">Ils échangent sur la messagerie privée</span></li>
                            <li class="list-group-item" style="color: #428bca"><span style="font-weight: bold;font-size: 1.3em;float: left">4. </span> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px;">Le client choisit un prestataire</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="col-lg-12">
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #428bca">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">&times;</button>
                        <h4 class="modal-title" id="H1"><br></h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                        <button id="btnNext"  class="btn btn-primary">Oui</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@include('footer')
@section('js')
    <script src="{{url('/js/assets/adminlte.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $('#btn-inscipt').click(function (e) {
                e.preventDefault();
                if(validation ()==0)
                {
                    $('.modal-body').text("un mail de confirmation sera envoyé à l'adresse "+$("#email").val()+" Etes vous sur que de continuer?");
                    $("#deleteModal").modal('toggle');
                    $("#btnNext").click(function () {
                        $("#registerForm").submit();
                    })
                }
            });
        });
        function  validation () {
            isError=0;
            $("#errorRs").text("");
            $("#errorNumero").text("");
            $("#errorEmail").text("");
            $("#erroLogin").text("");
            $("#erroPass").text("");
            $("#erroPassConf").text("");
            $("#erroCondition").text("");
            if($("#raisonSocial").val()=="")
            {
                $("#errorRs").text("veuillez remplir ce champs");
                isError++;
            }
            if($("#email").val()=="")
            {
                $("#errorEmail").text("veuillez remplir ce champs");
                isError++;
            }
            if($("#numero").val()=="")
            {
                $("#errorNumero").text("veuillez remplir ce champs");
                isError++;
            }
            if($("#login").val()=="")
            {
                $("#erroLogin").text("veuillez remplir ce champs");
                isError++;
            }
            if($("#password").val()=="")
            {
                $("#erroPass").text("veuillez remplir ce champs");
                isError++;
            }
            else
            {
                if($("#passwordConf").val()=="")
                {
                    $("#erroPassConf").text("veuillez remplir ce champs");
                    isError++;
                }
                else
                {
                    if($("#password").val()!=$("#passwordConf").val())
                    {
                        $("#erroPassConf").text("les deux mots de passe ne sont pas identiques");
                        isError++;
                    }

                }
            }

            if(!$("#condition").prop("checked"))
            {
                $("#erroCondition").text("veuillez cocher cette case");
                isError++;
            }
            return isError;

        }
    </script>
@endsection