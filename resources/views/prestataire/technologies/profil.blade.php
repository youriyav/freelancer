@extends('prestataire.layout')
@section("css")
    <link rel="stylesheet" href="{{url('/css/prestataire/index.css')}}">
@endsection
@section("mainEntete")
    <div class="col-lg-12 col-md-12" style="min-height: 40px;background-color:  #3c8dbc;padding: 0;margin:0;" >
        <h2 class="text-center " style="text-decoration: underline;color: white">Les formules abonnements</h2>

    </div>
@endsection

@section("main_content")
    <section class="content row" style="background-color: #fafafa">
        <div class="row" style="">
            <div class="col-md-10 col-md-offset-1">
                @if(\Illuminate\Support\Facades\Auth::check())
                    @foreach($formules as $formule)
                        <div class="col-lg-4 col-md-4" style="padding: 5px" >
                            <div class="panel" style="border: solid 1px {{$formule->couleur}}" >
                                <div class="panel-title panel-heading" style="background-color: {{$formule->couleur}};color: white">
                                    <h3 class="text-center" style="padding: 0;margin: 0px">{{$formule->libelle}}</h3>
                                </div>
                                <div class="panel-body ">
                                    <h3 class="text-center" style="font-weight: bold;margin-top: 0">
                                        @if($formule->prix==0)
                                            Gratuit
                                        @else
                                            {{$formule->prix}} Fcfa / Mois
                                        @endif
                                    </h3>
                                    <table class="table">
                                        @foreach($descriptions as $description)
                                            <?php $check=false ?>
                                            <tr class="" style="border: solid 2px {{$formule->couleur}}" >
                                                <td class="" style="">{{$description->libelle}}</td>
                                                <td class="pull-right">
                                                    @foreach($formule->descriptions as $descrip)
                                                        @if($descrip->id==$description->id) <?php $check=true ?> @endif
                                                    @endforeach
                                                    @if($check==true)
                                                        @if($description->hasValue==1)
                                                            <?php $currentFormuleValue=\App\FormuleDescriptionValue::where("description_formule_id",$description->id)->where("formule_id",$formule->id)->first() ?>
                                                            @if($currentFormuleValue)
                                                                {{$currentFormuleValue->value}}
                                                            @endif
                                                        @else
                                                            <i class="fa fa-check fa-2x"  style="color: green;"></i>
                                                        @endif

                                                    @else
                                                        <i class="fa fa-times fa-2x"  style="color: red;"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                <!--ul class="list-group">
                                    @foreach($descriptions as $description)
                                            <?php $check=false ?>
                                                    <li class="list-group-item" style="border: solid 1px {{$formule->couleur}}">
                                            <span class="" style="font-weight: bold;font-size: 1.3em;margin-left: 5px">{{$description->libelle}}</span>
                                            <span class="pull-right">
                                                @foreach($formule->descriptions as $descrip)
                                                @if($descrip->id==$description->id) <?php $check=true ?> @endif
                                            @endforeach
                                            @if($check==true)
                                                <i class="fa fa-check-circle fa-2x"  style="float: left;color: green"></i>
                                            @else
                                                                                    <i class="fa fa-times-circle fa-2x"  style="float: left;color: red"></i>
                                            @endif

                                                                                        </span>
                                                                                    </li>
                                    @endforeach
                                                                            </ul-->
                                    <p class="text-center" style="margin: 0"><button class="btn btn-lg btn-abn" id="{{$formule->id}}" style="background-color: {{$formule->couleur}};color: white;margin: 0">S'abonner</button></p>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h1 class="text-center text-primary" style="text-decoration: underline;margin: 0">Offres Entreprise</h1>
                    @foreach($formules as $formule)
                        @if($formule->type==1)
                            <div class="col-lg-4 col-md-4" style="padding: 5px" >
                                <div class="panel" style="border: solid 1px {{$formule->couleur}}" >
                                    <div class="panel-title panel-heading" style="background-color: {{$formule->couleur}};color: white">
                                        <h3 class="text-center" style="padding: 0;margin: 0px">{{$formule->libelle}}</h3>
                                    </div>
                                    <div class="panel-body ">
                                        <h3 class="text-center" style="font-weight: bold;margin-top: 0">
                                            @if($formule->prix==0)
                                                Gratuit
                                            @else
                                                {{$formule->prix}} Fcfa / Mois
                                            @endif
                                        </h3>
                                        <table class="table">
                                            @foreach($descriptions as $description)
                                                <?php $check=false ?>
                                                <tr class="" style="border: solid 2px {{$formule->couleur}}" >
                                                    <td class="" style="">{{$description->libelle}}</td>
                                                    <td class="pull-right">
                                                        @foreach($formule->descriptions as $descrip)
                                                            @if($descrip->id==$description->id) <?php $check=true ?> @endif
                                                        @endforeach
                                                        @if($check==true)
                                                            @if($description->hasValue==1)
                                                                <?php $currentFormuleValue=\App\FormuleDescriptionValue::where("description_formule_id",$description->id)->where("formule_id",$formule->id)->first() ?>
                                                                @if($currentFormuleValue)
                                                                    {{$currentFormuleValue->value}}
                                                                @endif
                                                            @else
                                                                <i class="fa fa-check fa-2x"  style="color: green;"></i>
                                                            @endif

                                                        @else
                                                            <i class="fa fa-times fa-2x"  style="color: red;"></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    <!--ul class="list-group">
                            @foreach($descriptions as $description)
                                        <?php $check=false ?>
                                                <li class="list-group-item" style="border: solid 1px {{$formule->couleur}}">
                                    <span class="" style="font-weight: bold;font-size: 1.3em;margin-left: 5px">{{$description->libelle}}</span>
                                    <span class="pull-right">
                                        @foreach($formule->descriptions as $descrip)
                                            @if($descrip->id==$description->id) <?php $check=true ?> @endif
                                        @endforeach
                                        @if($check==true)
                                            <i class="fa fa-check-circle fa-2x"  style="float: left;color: green"></i>
@else
                                            <i class="fa fa-times-circle fa-2x"  style="float: left;color: red"></i>
@endif

                                                </span>
                                            </li>
@endforeach
                                            </ul-->
                                        <p class="text-center" style="margin: 0"><button class="btn btn-lg btn-abn" id="{{$formule->id}}" style="background-color: {{$formule->couleur}};color: white;margin: 0">S'abonner</button></p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach


                    <h1 class="text-center text-primary" style="text-decoration: underline;margin: 0">Offres Freelancer</h1>
                    @foreach($formules as $formule)
                        @if($formule->type==2)
                            <div class="col-lg-4 col-md-4" style="padding: 5px" >
                                <div class="panel" style="border: solid 1px {{$formule->couleur}}" >
                                    <div class="panel-title panel-heading" style="background-color: {{$formule->couleur}};color: white">
                                        <h3 class="text-center" style="padding: 0;margin: 0px">{{$formule->libelle}}</h3>
                                    </div>
                                    <div class="panel-body ">
                                        <h3 class="text-center" style="font-weight: bold;margin-top: 0">
                                            @if($formule->prix==0)
                                                Gratuit
                                            @else
                                                {{$formule->prix}} Fcfa / Mois
                                            @endif
                                        </h3>
                                        <table class="table">
                                            @foreach($descriptions as $description)
                                                <?php $check=false ?>
                                                <tr class="" style="border: solid 2px {{$formule->couleur}}" >
                                                    <td class="" style="">{{$description->libelle}}</td>
                                                    <td class="pull-right">
                                                        @foreach($formule->descriptions as $descrip)
                                                            @if($descrip->id==$description->id) <?php $check=true ?> @endif
                                                        @endforeach
                                                        @if($check==true)
                                                            @if($description->hasValue==1)
                                                                <?php $currentFormuleValue=\App\FormuleDescriptionValue::where("description_formule_id",$description->id)->where("formule_id",$formule->id)->first() ?>
                                                                @if($currentFormuleValue)
                                                                    {{$currentFormuleValue->value}}
                                                                @endif
                                                            @else
                                                                <i class="fa fa-check fa-2x"  style="color: green;"></i>
                                                            @endif

                                                        @else
                                                            <i class="fa fa-times fa-2x"  style="color: red;"></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    <!--ul class="list-group">
                            @foreach($descriptions as $description)
                                        <?php $check=false ?>
                                                <li class="list-group-item" style="border: solid 1px {{$formule->couleur}}">
                                    <span class="" style="font-weight: bold;font-size: 1.3em;margin-left: 5px">{{$description->libelle}}</span>
                                    <span class="pull-right">
                                        @foreach($formule->descriptions as $descrip)
                                            @if($descrip->id==$description->id) <?php $check=true ?> @endif
                                        @endforeach
                                        @if($check==true)
                                            <i class="fa fa-check-circle fa-2x"  style="float: left;color: green"></i>
@else
                                            <i class="fa fa-times-circle fa-2x"  style="float: left;color: red"></i>
@endif

                                                </span>
                                            </li>
@endforeach
                                            </ul-->
                                        <p class="text-center" style="margin: 0"><button class="btn btn-lg btn-abn" id="{{$formule->id}}" style="background-color: {{$formule->couleur}};color: white;margin: 0">S'abonner</button></p>

                                    </div>
                                </div>
                            </div>
                        @endif


                    @endforeach
                @endif

            </div>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="alert-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold;max-height: 20px;min-height: 60px">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white">&times;</span>
                    </button>
                    <h5 class="modal-title"> </h5>
                </div>
                <div class="modal-body">
                    <p class="text-center text-summury" id="succes-message">Pour vous abonner, vous devriez vous authentifier</p>
                    <p class="text-center"><a href="{{route('seConnecter',["next"=>"/abonnement"])}}" class="btn btn-primary " >Se connecter</a></p>
                    <p class="text-center"><a href="{{route('inscription')}}" class="btn btn-default">S'inscrire</a></p>
                    <p class="text-center"><button  class="btn btn-danger btn-large" data-dismiss="modal">Annuler</button></p>
                    <div class="row">

                    </div>
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
                @if(\Illuminate\Support\Facades\Auth::check())
                    id =$(this).prop('id');
                    formule=getFormule(id);
                    $("#btnReinitSubmit").css({backgroundColor:formule.couleur});
                    $("#label").text("Formule "+formule.libelle);
                    $("#label").css({color:formule.couleur});
                    console.log(formule.prix);
                    if(parseInt(formule.prix)==0)
                    {
                        $("#prix").text("Gratuit");
                        $("#total").text("Gratuit");
                    }
                    else
                    {
                        $("#prix").text(formule.prix+"/Fcfa");
                        $("#total").text("Total "+formule.prix+"/Fcfa");
                    }

                    $("#prix").css({color:formule.couleur});

                    $("#spanMois").css({backgroundColor:"#3c8dbc",color:"white"});
                    $("#nbrMois").val(1);
                    $("#login-modal").modal('toggle');
                @else
                $("#alert-modal").modal('toggle');
                @endif

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