@extends('admin.formule.layout')
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
@section('content_main')
    <div class="row " >
        <div class="col-md-12">
            <div class="content-panel">
                <h4 style="text-decoration: underline" class="text-primary"><a href="{{route('indexFormuleAdmin')}}" data-toggle="tooltip" data-placement="bottom" title="Retour"><i class="fa fa-arrow-left"></i></a> Nouvelle Formule </h4>
                <div class="row">

                    <div class="col-lg-6 col-lg-offset-3">
                        <div style="height: 60px">
                            @isset($message)<div class="alert alert-success text-center"  style="max-height: 55px" >{{$message}} </div>@endisset
                        </div>
                        <form role="form" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label for="libelle">Libellé</label>
                            <div class="form-group ">
                                <input type="text" value="@isset($libelle){{$libelle}}@endisset" class="form-control" id="libelle" name="libelle" required>
                            </div>
                            <p class="help-block " style="color: red">@isset($errorLibelle){{$errorLibelle}}@endisset</p>
                            <label for="libelle">Type</label>
                            <div class="form-group ">
                                <select class="form-control" name="type" id="type">
                                    <option value="1">Agence</option>
                                    <option value="2">Prestataire</option>
                                </select>
                            </div>
                            <label for="libelle">Prix</label>
                            <div class="form-group input-group">
                                <input  type="number" value="@isset($prix){{$prix}}@endisset" class="form-control" id="prix" name="prix" required>
                                <span class="input-group-addon" >Fcfa</span>
                            </div>

                            <p class="help-block " style="color: red">@isset($errorPrix){{$errorPrix}}@endisset</p>



                            <label for="cp1" class="control-label">Couleur</label>
                            <div class="form-group input-group">

                                <input type="text" class="form-control"  name="color" value="@isset($color){{$color}} @endisset" id="cp1" required />
                                <span class="input-group-addon" id="colorIndicator" style="background-color: #8fff00"></span>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-lg-4">Fonctionnalités</label>
                                <div class="col-lg-8"></div>
                                <select id="description" name="description[]" required data-placeholder="ajouter des description"  class="form-control chzn-select" multiple="multiple" tabindex="4" style="height:50px;">
                                    @foreach($listes as $object)
                                        <option value="{{$object->id}}">{{$object->libelle}} @if($object->type==1)(Agence) @else (Prestataire) @endif</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="next" value="1"/> Enregister et creer
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div>
    @include("footer")
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
    <script src="{{url('/js/assets/bootstrap-inputmask.js')}}"></script>
    <script src="{{url('/js/assets/formsInit.js')}}"></script>
    <script>
        $(function () {
           /* $("#type").change(function () {
                _html="";
                $value=$(this).val();
               for (i=0;i<listes.length;i++)
               {
                   $item=listes[i];
                   //agence
                   if($value==1)
                   {
                       if($item.type==1)
                       {
                           _html+='<option value="'+$item.id+'">'+$item.libelle+'</option>';
                       }
                   }
                   else//prestataire
                   {
                       if($item.type==2)
                       {
                           _html+='<option value="'+$item.id+'">'+$item.libelle+'</option>';
                       }
                   }
               }
               console.log(_html);
                $(".chosen-container").remove();
                $("#description").html(_html);
                formInit();
            });*/
            $('[data-toggle="tooltip"]').tooltip();
            $(".alert-success").fadeOut(5000);
            $("#cp1").change(function () {
               // alert('good');
            });
            formInit();
            $("#description").change(function () {
               // alert('good');
            });
        });
        $('#cp1').colorpicker().on('changeColor', function (ev) {
            //alert('good');
            $('#colorIndicator').css('background-color', ev.color.toHex());
        });

    </script>
@endsection