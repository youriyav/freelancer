@extends('prestataire.layout2')
@section("css")
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
    <section class="content row" style="background-color: #fafafa">
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs"style="padding: 5px" >
                <div class="panel panel-primary" >
                    <div class="panel-title panel-heading">
                        <h3 class=" text-center ">Pourquoi devrais je rester conneceter?</h3>
                    </div>
                    <div class="panel-body ">
                        <ul class="list-group">
                            <li class="list-group-item" style="color: #428bca"><i class="fa fa-check-circle fa-2x"  style="float: left"></i> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px">Plus de 30 000 projets par jour</span></li>
                            <li class="list-group-item" style="color: #428bca"><i class="fa fa-check-circle fa-2x"  style="float: left"></i> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px">Recever intantanement des notifications de chaque nouveau projet portant sur vos compétences</span></li>
                            <li class="list-group-item" style="color: #428bca"><i class="fa fa-check-circle fa-2x " style="float: left"></i> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px">Chatter avec vos amis freeleance ou bien vos clients</span></li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6" style="padding: 20px;padding-top: 0">
                <div style="background-color: white;min-height: 400px" class="row">
                    <h3 class="text-center text-primary" style="margin-bottom: 20px"><i class="fa fa-lock"></i> CONNEXION</h3>

                    <form  id="registerForm" role="form" class="col-lg-6 col-lg-offset-3 form-horizontal" method="post" action="{{route('seConnecter')}}" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @isset($next)<input type="hidden" name="next" value="{{ $next }}">@endisset
                        <div class="form-group" style="padding: 0">
                            <label>Login</label>
                            <input required id="login" type="text" class="form-control" value="@isset($login){{trim($login)}}@endisset" placeholder="login ou email" name="email" >
                            <p style="color: red" id="erroLogin">@isset($tabError){{$tabError[2]}}@endisset</p>
                        </div>
                        <div class="form-group" style="padding: 0">
                            <label>Mot de passe</label>
                            <input required  id="password" type="password" class="form-control" placeholder="" name="password" >

                            <p style="color: red" id="erroPass">@isset($error){{$error}}@endisset</p>
                        </div>

                        <div class="checkbox" style="padding: 0">
                            <label>
                                <input  class="uniform" id="condition" @isset($condition) @if($condition==1) @endif checked @endisset type="checkbox" value="1" name="condition" />  Rester connecter
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary col-lg-12" value="Valider" id="btn-inscipt">
                        </div>
                        <div class="form-group">
                            Pas encore membre ? <a href="{{route('inscription')}}">Cliquez-ici</a> pour vous inscrire
                            <div class="form-group text-center" style="margin-top: 10px">
                                <a id="passForget" class="" style="cursor: pointer">Mot de passe oublié ?</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs"style="padding: 5px" >
                <div class="panel panel-primary" >
                    <div class="panel-title panel-heading">
                        <h3 class=" text-center ">Comment ça marche?</h3>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="login-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white">&times;</span>
                    </button>
                    <h5 class="modal-title">Réinitialier votre mot de passe</h5><br>
                </div>
                <div class="modal-body">
                    <div class="container" style="position: absolute;margin-left: 80px" id="laoder" hidden>
                        <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                            <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                        </svg>
                    </div>
                    <form method="post" action="" id="reinitForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <input class="form-control " type="text" id="loginRenit" name="loginRenit" placeholder="email ou login" >
                                    <p style="color: red" id="errorLogin"></p>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">

                    <button type="button"  id="btnCancel" class="btn btn-danger " data-dismiss="modal">Annuler</button>
                    <button type="button"  id="btnReinitSubmit" class="btn  btn-primary"  data-loading-text="<i class='fa fa-spinner fa-spin '></i>Réinitialisation...">Réinitianiser</button>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="success-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <p class="text-center text-primary"><i class="fa fa-check-circle fa-3x"></i></p>
                    <p class="text-center" id="succes-message"></p>
                </div>
                <div class="modal-footer">
                    <p class="text-center"><button class="btn btn-primary btn-large" data-dismiss="modal">Ok</button></p>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('footer')
@section('js')
    <!-- jQuery UI 1.11.4 -->

    <!-- Morris.js charts -->

    <!-- AdminLTE App -->
    <script src="{{url('/js/assets/adminlte.min.js')}}"></script>
    <script>
        $(function () {
            $('#btnReinitSubmit').click(function (e) {
                e.preventDefault();
                $("#errorLogin").text("");
                if($("#loginRenit").val()=="")
                {
                    $("#errorLogin").text("veuillez remplir ce champs");
                    return 0;
                }
                $('#reinitForm').submit();
            });
            $('#reinitForm').submit(function (e) {
                $.ajax({
                    url :"{{route('reinitialiserCompte')}}",
                    data:new FormData(this),
                    processData: false,
                    contentType: false,
                    type : "post",
                    //beforeSend: function(xhr){xhr.setRequestHeader("X-CSRFToken", csrftoken);},
                    success : function(json)
                    {
                        $("#btnReinitSubmit").prop('disabled','');
                        $("#btnCancel").prop('disabled','');
                        $("#laoder").hide();
                        console.log(json);
                        res=JSON.parse(json);
                        $("#errorLogin").text(res.message);
                        if(res.code!="404")
                        {
                            $("#login-modal").modal('toggle');

                            // success-modal$("#succes-message").text(res.message);
                            $("#success-modal").modal('toggle');
                        }
                    },
                    error :function(xhr,errmsg,err)
                    {
                        $("#laoder").hide();
                        console.log(xhr);
                    }
                });
                e.preventDefault();
            });
            $("#passForget").click(function () {
                $("#login-modal").modal('toggle');
            });
            console.log("bad");
            if(typeof Usrelogin === 'undefined')
            {
                console.log("bad");
            }
            else
            {
                console.log("good");
                $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Félicitations '+Usrelogin+'!',
                    // (string | mandatory) the text inside the notification
                    text: 'Votre compte vient d\'être activé'
                });
            }

        });
    </script>
@endsection