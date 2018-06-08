@extends('admin.demarrage_projet.layout')
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
                <h4 style="text-decoration: underline" class="text-primary"><a href="{{route('indexDemarrage')}}" data-toggle="tooltip" data-placement="bottom" title="Retour"><i class="fa fa-arrow-left"></i></a> Nouveau démarrage </h4>
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