@extends('prestataire.layout')
@section("css")
    <link rel="stylesheet" href="{{url('/css/prestataire/index.css')}}">
@endsection
@section("mainEntete")
    <div class="col-lg-12 col-md-12" style="min-height: 100px;background-color:  #3c8dbc;" >
        <h2 class="text-center " style="text-decoration: underline;margin-bottom: 20px;color: white">Les formules abonnements</h2>

    </div>
@endsection

@section("main_content")
    <section class="content row" style="background-color: #fafafa">
        <div class="row" style="margin-bottom: 10px;">
            @foreach($listeOffre as $formule)
            <div class="col-lg-4 col-md-4"style="padding: 5px" >
                <div class="panel" style="border: solid 1px {{$formule->couleur}}" >
                    <div class="panel-title panel-heading" style="background-color: {{$formule->couleur}};color: white">
                        <h3 class="text-center" style="padding: 0;margin: 0px">{{$formule->libelle}}</h3>
                    </div>
                    <div class="panel-body ">
                        <h2 class="text-center" style="color: {{$formule->couleur}};font-weight: bold;margin-top: 0">{{$formule->prix}} Fcfa / Mois</h2>
                        <ul class="list-group">
                            @foreach($formule->descriptions as $description)
                                <li class="list-group-item" style="color: {{$formule->couleur}};border: solid 1px {{$formule->couleur}}"><i class="fa fa-check-circle fa-2x"  style="float: left"></i> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px">{{$description->libelle}}</span></li>
                            @endforeach
                        </ul>
                        <p class="text-center"><button class="btn btn-lg btn-abn" id="{{$formule->id}}" style="background-color: {{$formule->couleur}};color: white">S'abonner</button></p>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
        <div>
            <p class="text-center">Pour toute question, vous pouvez <a href="">nous contacter</a> sans hésiter</p>
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
    <div class="modal fade" id="l" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="loginmodal-container">
                <h3 id="label" class="text-center" style="margin-bottom: 0">Réinitialier votre mot de passe</h3><br>
                <h3 id="prix" class="text-center" style="margin-top: 0">Réinitialier votre mot de passe</h3><br>

                <div class="container" style="position: absolute;margin-left: 80px" id="laoder" hidden>
                    <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                        <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                    </svg>
                </div>


            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="login-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white">&times;</span>
                    </button>
                    <h5 class="modal-title">Suppression</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="" id="reinitForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <label>Nombre de mois</label>
                        <div class="form-group input-group">
                            <select class="form-control" id="nbrMois" name="nbrMois">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                                <option value="12">12</option>
                            </select>
                            <span class="input-group-addon" id="spanMois">Mois</span>
                        </div>
                        <p style="color: red" id="errorLogin"></p>
                        <h3 class="text-center" id="total"></h3>

                    </form>
                    <div class="row">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary btn-large" id="btnAbn"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> ...">S'abonner</button>

                </div>
            </div>
        </div>
    </div>
    @include('footer')
@endsection
@include('footer')
@section('js')
    <script>
        var formules=[];
        var formule;
        $(function () {
            console.log(listeOffre);
            $(".btn-abn").click(function (e) {
                id =$(this).prop('id');
                formule=getFormule(id);
                $("#btnReinitSubmit").css({backgroundColor:formule.couleur});
                $("#label").text("Formule "+formule.libelle);
                $("#label").css({color:formule.couleur});
                $("#prix").text(formule.prix+"/Fcfa");
                $("#prix").css({color:formule.couleur});
                $("#total").text("Total "+formule.prix+"/Fcfa");
                $("#spanMois").css({backgroundColor:formule.couleur,color:"white"});
                $("#nbrMois").val(1);
                $("#login-modal").modal('toggle');
            });
            $("#nbrMois").change(function () {
                total=formule.prix*parseInt($(this).val());
                $("#total").text("Total "+total+"/Fcfa");
            });
            $("#btnAbn").click(function (e) {
                $this=$(this).prop('disabled','disabled');
                $("#btnCancel").prop('disabled','disabled');
                e.preventDefault();
                $this.button('loading');
                $.ajax({
                    url :"{{route('nouveauAbonnement')}}",
                    data:{'idFormule':formule.id,'quantite': $("#nbrMois").val(),"_token":"<?php echo csrf_token() ?>"},
                    type : "post",
                    success : function(json)
                    {
                        $this.prop('disabled','');
                        $("#btnCancel").prop('disabled','');
                        console.log(json);
                        $this.button('reset');
                        redirect_lien="/abonnement/commande/"+json;
                        location.href=redirect_lien;
                    },
                    error :function(xhr,errmsg,err)
                    {
                        $("#laoder").hide();
                        console.log(xhr);
                    }
                });
            });
        });
        function getFormule(id)
        {
            for(i=0;i<listeOffre.length;i++)
            {
                if(listeOffre[i].id==id)
                {
                    return listeOffre[i];
                }
            }
        }
    </script>
@endsection