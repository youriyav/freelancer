@extends('admin.technologies.layout')
@section('content_main')
    <div class="row " >
        <div class="col-md-12">
            <div class="content-panel">
                <h4 style="text-decoration: underline" class="text-primary"><a href="{{route('indextechologiesAdmin')}}" data-toggle="tooltip" data-placement="bottom" title="Retour"><i class="fa fa-arrow-left"></i></a> Nouvelle Technologie </h4>
                <div class="row">

                    <div class="col-lg-6 col-lg-offset-3">
                        <div style="height: 60px">
                            @isset($message)<div class="alert alert-success text-center"  style="max-height: 55px" >{{$message}} </div>@endisset
                        </div>
                        <form role="form" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="libelle">Libellé</label>
                                <input value="@isset($libelle){{$libelle}}@endisset" class="form-control" id="libelle" name="libelle">
                                <p class="help-block " style="color: red">@isset($errorLibelle){{$errorLibelle}}@endisset</p>
                            </div>
                            <div class="form-group">
                                <label>Plateforme</label>
                                <select class="form-control" name="plateforme">
                                    <option value="0">Choisir une plateforme</option>
                                    @foreach($listes as $object)

                                        <option value="{{$object->id}}" @isset($plateforme)@if($plateforme==$object->id) selected @endif @endisset>{{$object->libelle}}</option>
                                    @endforeach
                                </select>
                                <p class="help-block " style="color: red">@isset($errorDescript){{$errorDescript}}@endisset</p>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                                <p class="help-block " style="color: red">@isset($errorDesc){{$errorDesc}}@endisset</p>
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
@endsection
@section('js')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $(".alert-success").fadeOut(5000);

        });

    </script>
@endsection