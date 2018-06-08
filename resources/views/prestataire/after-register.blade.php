@extends('prestataire.layout2')
@section("css")
    <link rel="stylesheet" href="{{url('/css/prestataire/index.css')}}">
@endsection

@section("main_content")
    <div class="row" >
        <div class="col-md-8 col-md-offset-2" >
            <div class="adbox-img center-block" >
                <div id="transition-timer-carousel" class="carousel slide transition-timer-carousel " data-ride="carousel" style="height: 100px">
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

    </div>
    <section class="content row" style="background-color: #fafafa">
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs"style="padding: 5px" >

            </div>
            <div class="col-lg-6 col-md-9" style="padding: 20px;padding-top: 0">
                <div  style="background-color: white" class="row">
                    <div class="col-md-12 " style="border: solid 1px #428bca;border-radius: 8px;padding: 25px">
                        <p class="text-center" style="color: #428bca"><i class="fa fa-check-circle fa-3x"></i></p>
                        <p class="text-center text-summury" >Félicitation {{$login}}! </p>
                        <p class="text-center text-summury" >Votre compte a été créé. </p>
                        <p class="text-center text-summury" >Un e-mail de confirmation vous a été envoyé, veuillez consulter votre boite mail pour activer votre compte</p>
                        <p class="text-center text-summury" style="margin-top: 15px"><a href="{{route('indexPrestataire')}}" class="btn btn-primary">Page d'acceuil</a> </p>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs"style="padding: 5px" >

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
    <!-- jQuery UI 1.11.4 -->

    <!-- Morris.js charts -->

    <!-- AdminLTE App -->
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
            $("#errorNom").text("");
            $("#errorPrenom").text("");
            $("#erroEmail").text("");
            $("#erroLogin").text("");
            $("#erroPass").text("");
            $("#erroPassConf").text("");
            $("#erroCondition").text("");

            if($("#nom").val()=="")
            {
                $("#errorNom").text("veuillez remplir ce champs");
                isError++;
            }
            if($("#prenom").val()=="")
            {
                $("#errorPrenom").text("veuillez remplir ce champs");
                isError++;
            }
            if($("#email").val()=="")
            {
                $("#erroEmail").text("veuillez remplir ce champs");
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