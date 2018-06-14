@extends('prestataire.layout')
@section("css")
    <link rel="stylesheet" href="{{url('/css/prestataire/index.css')}}">
@endsection
@section("mainEntete")
    <div class="container col-lg-12 col-md-12" style="min-height: 100px;background-color:  #3c8dbc;" >
        <h2 class="text-center " style="text-decoration: underline;margin-bottom: 20px;color: white">Finalisation de votre commande</h2>

    </div>
@endsection

@section("main_content")
    <section class="content row" >
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading text-primary">
                        <h4 class="text-primary text-center">Votre Commande</h4>
                        <!--a href=""><i class="fa fa-edit pull-right fa-2x"></i></a-->
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table  table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th class="text-center">Quantite</th>
                                        <th class="text-center">Montant HT</th>
                                        <th class="text-center">Montant TTC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($commande->lignes as $ligne)
                                    <tr>
                                        <td>{{$ligne->libelle}}</td>
                                        <td class="text-center">{{$ligne->quantite}}</td>
                                        <td class="text-center">{{$ligne->quantite*$ligne->prix}} Fcfa</td>
                                        <td class="text-center">{{$ligne->prix}} Fcfa</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-center">Total</th>
                                        <th class="text-center">{{$commande->montant_ttc}} Fcfa</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h3 class="text-center" style="margin: 0;margin-bottom:5px">Modes de payement</h3>
                    <div class="panel panel-default">
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1default" data-toggle="tab"><img width="30" class="img-circle" height="30" src="/img/bis.jpg"> Virement bancaire</a></li>
                                    <li class=""><a href="#tab2default" data-toggle="tab"><img width="30" class="img-circle" height="30" src="/img/orange_4.png"> OrangeMoney</a></li>
                                    <li class=""><a href="#wari" data-toggle="tab"><img width="30" class="img-circle" height="30" src="/img/wari.png"> Wari</a></li>
                                </ul>
                            </div>

                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1default">
                                            <p style="margin: 0"><span style="font-weight: bold">Banque:</span> Banque islamique du Sénégal</p>
                                            <p style="margin: 0"><span style="font-weight: bold">Ordre de virement:</span> {{$commande->numero}}</p>
                                            <p style="margin: 0"><span style="font-weight: bold">Montant:</span> {{$commande->montant_ttc}} Fcfa</p>
                                            <p style="margin: 0"><span style="font-weight: bold">Numero de compte:</span> 111111111111</p>
                                    </div>
                                    <div class="tab-pane fade" id="tab2default">
                                        <p style="margin: 0"><span style="font-weight: bold">Numero:</span> 778399425</p>
                                        <p style="margin: 0"><span style="font-weight: bold">Montant:</span> {{$commande->montant_ttc}} Fcfa</p>
                                    </div>
                                    <div class="tab-pane fade" id="wari">
                                        <p style="margin: 0"><span style="font-weight: bold">Numero:</span> 778399425</p>
                                        <p style="margin: 0"><span style="font-weight: bold">Montant:</span> {{$commande->montant_ttc}} Fcfa</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-right"><button class="btn btn-primary" style="margin: 0; margin-right: 5px">Terminer</button></p>
                    </div>









                    <!--div class="col-md-4" >
                        <p class="text-center"><button class="btn-sm">Wari</button></p>
                        <div style="border: solid 1px #3c8dbc">

                        </div>
                    </div-->
                </div>
            </div>
            <div class="col-md-3 col-md-offset-1">
                <h3 style="margin-top: 0" class="text-center">Mode de payement <!--a target="_blank" href="https://payexpresse.com">PayExpresse</a-->
                </h3>
                <p class="text-summury">Choisissez votre mode de payement et obtenez les informations relatives puis posseder au payement. Une fois le payement éffectué, envoyer un mail à <a href="mailto:contact@ec-innov.com">contact@ec-innov.com</a>
                 en précisant vos coordonnées plus les justificatifs du payement</p>
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
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="loginmodal-container">
                <h3 id="label" class="text-center" style="margin-bottom: 0">Réinitialier votre mot de passe</h3><br>
                <h3 id="prix" class="text-center" style="margin-top: 0">Réinitialier votre mot de passe</h3><br>

                <div class="container" style="position: absolute;margin-left: 80px" id="laoder" hidden>
                    <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                        <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                    </svg>
                </div>
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
                    <button style="margin-bottom: 10px" type="submit" id="btnAbn"  class="btn btn-lg btn-primary  col-md-12 col-sm-12 col-xs-12" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">S'abonner</button>
                    <button type="button"  id="btnCancel"       class="btn btn-lg btn-danger col-md-12 col-sm-12 col-xs-12" data-dismiss="modal">Annuler</button>
                </form>

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
            $("#btnTerminer").click(function (e) {
               _url="https://payexpress.com/api/payment/request-payment"
                $.ajax({
                    url :_url,
                    type : "get",
                    success : function(json)
                    {
                        console.log(json);
                    },
                    error :function(xhr,errmsg,err)
                    {
                        console.log(xhr);
                    }
                });
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