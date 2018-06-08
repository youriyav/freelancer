@extends('prestataire.projet.layout')
@section('css')
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
@section('main_content')
    <div class="row" style="margin-bottom: 10px;">
        <h3 class="text-center text-primary" style="">Prêts à trouver votre freelance ?</h3>
        <h3 class="text-center text-primary" style="margin-bottom: 20px;margin-top: 0">Déposez votre projet en quelques secondes</h3>
        <!--h3 class="text-center text-primary" style="text-decoration: underline;margin-bottom: 20px">Déposer un projet gratuitement</h3-->
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs"style="padding: 5px" >
            <div class="panel panel-primary" >
                <div class="panel-title panel-heading">
                    <h3 class=" text-center ">Pourquoi déposer un projet ici?</h3>
                </div>
                <div class="panel-body ">
                    <ul class="list-group">
                        <li class="list-group-item" style="color: #428bca"><i class="fa fa-check-circle fa-2x"  style="float: left"></i> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px">Déposez gratuitement votre projet en détaillant précisément vos besoins et vos attentes</span></li>
                        <li class="list-group-item" style="color: #428bca"><i class="fa fa-check-circle fa-2x"  style="float: left"></i> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px">Nous communiquerons immédiatement votre projet aux prestataires qui correspondent à vos critères</span></li>
                        <li class="list-group-item" style="color: #428bca"><i class="fa fa-check-circle fa-2x"  style="float: left"></i> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px">Recevez des dévis par rapport à votre projet</span></li>
                        <li class="list-group-item" style="color: #428bca"><i class="fa fa-check-circle fa-2x " style="float: left"></i> <span style="font-weight: bold;font-size: 1.3em;margin-left: 5px"></span></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-9" style="background-color: white">
            <form id="registerForm" role="form" class="col-lg-8 col-lg-offset-2 form-horizontal" method="post" action="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label>Titre</label>
                    <input required id="titre" type="text" class="form-control" placeholder="" name="titre" >
                    <p style="color: red" id="erroPassConf">@isset($tabError){{$tabError[4]}}@endisset</p>
                </div>
                <div class="form-group">
                    <label>Décrivez votre projet en quelques mots</label>
                    <textarea class="form-control" rows="3" name="descrip"></textarea>

                    <p style="color: red" id="erroPassConf">@isset($tabError){{$tabError[4]}}@endisset</p>
                </div>
                <div class="form-group">
                    <label>Choisissez une ou plusieurs compétences</label>
                    <select id="description" name="description[]" required data-placeholder="ajouter des description"  class="form-control chzn-select" multiple="multiple" tabindex="8" style="height:50px;">
                        @foreach($listeOfPlat as $plat)
                            <option value="82" style="background-color:#888888; font-weight: bold;text-transform: uppercase;color: white" disabled=""> ----- {{$plat->libelle}} ----- </option>
                            <span class="main_select">@foreach($plat->technologies as $techno)
                                    <option  value="{{$techno->id}}">{{$techno->libelle}}</option>
                                @endforeach</span>
                        @endforeach
                    </select>

                    <p style="color: red" id="erroPassConf">@isset($tabError){{$tabError[4]}}@endisset</p>
                </div>
                <div class="form-group">
                    <label>Quand votre projet doit-il démarrer ?</label>
                    $listeTypeDemarrage
                    <select class="form-control" name="demarrage">
                        @foreach($listeTypeDemarrage as $type)
                            <option  value="{{$type->id}}">{{$type->libelle}}</option>
                        @endforeach
                    </select>
                    <p style="color: red" id="erroPassConf">@isset($tabError){{$tabError[4]}}@endisset</p>
                </div>
                <div class="form-group">
                    <label>Quel est votre budget approximatif ?</label>
                    <select class="form-control" name="budget">
                        @foreach($listeBudget as $budget)
                            <option  value="{{$budget->id}}"  >{{$budget->libelle}}</option>
                        @endforeach
                    </select>
                    <p style="color: red" id="erroPassConf">@isset($tabError){{$tabError[4]}}@endisset</p>
                </div>
                <div class="form-group">
                    <input type="submit" value="Valider" class="btn btn-primary btn-large col-md-12">
                </div>
            </form>
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
@endsection
@section('js')
    <script src="{{url('/js/assets/jquery-ui.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.uniform.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.inputlimiter.1.3.1.min.js')}}"></script>
    <script src="{{url('/js/assets/chosen.jquery.min.js')}}"></script>

    <script src="{{url('/js/assets/bootstrap-colorpicker.js')}}"></script>
    <script src="{{url('/js/assets/jquery.tagsinput.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.validVal.min.js')}}"></script>
    <script src="{{url('/js/assets/daterangepicker.js')}}"></script>
    <script src="{{url('/js/assets/moment.min.js')}}"></script>
    <script src="{{url('/js/assets/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('/js/assets/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{url('/js/assets/bootstrap-switch.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.dualListBox-1.3.min.js')}}"></script>
    <script src="{{url('/js/assets/jquery.autosize.min.js')}}"></script>

    <script src="{{url('/js/assets/formsInit.js')}}"></script>
    <script>
        $(function () {
            formInit();
        });
    </script>

@endsection