@extends('admin.descriptionFormule.layout')
@section('content_main')
    <div class="row " >
        <div class="col-md-12">
            <div class="content-panel">
                <h4 style="text-decoration: underline" class="text-primary"><a href="{{route('descriptFormule')}}" data-toggle="tooltip" data-placement="bottom" title="Retour"><i class="fa fa-arrow-left"></i></a> Editer Description </h4>
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <div style="height: 60px">
                            @isset($message)<div class="alert alert-success text-center"  style="max-height: 55px" >{{$message}} </div>@endisset
                        </div>
                        <form role="form" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="libelle">Libellé</label>
                                <input type="text" value="@isset($descritions){{$descritions->libelle}}@endisset" class="form-control" id="libelle" name="libelle">
                            </div>
                            <div class="form-group ">
                                <label for="libelle">Type</label>
                                <select class="form-control" name="type">
                                    <option value="1" >Agence</option>
                                    <option value="2" @if($descritions->type==2) selected @endif >Prestataire</option>
                                </select>
                            </div>
                            <p class="help-block " style="color: red">@isset($errorLibelle){{$errorLibelle}}@endisset</p>
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
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();

        });

    </script>
@endsection