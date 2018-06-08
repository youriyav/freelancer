@extends('admin.plateforme.layout')
@section('content_main')
    <div class="row " >
        <div class="col-md-12">
            <div class="content-panel">
                <h4 style="text-decoration: underline" class="text-primary"><a href="{{route('indexPlateformeAdmin')}}" data-toggle="tooltip" data-placement="bottom" title="Retour"><i class="fa fa-arrow-left"></i></a> Nouvelle Plateforme </h4>
                <div class="row">

                    <div class="col-lg-6 col-lg-offset-3">

                        <form role="form" method="post"  enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="libelle">Libellé</label>
                                <input value="{{$plateforme->libelle}}" class="form-control" id="libelle" name="libelle">
                                <p class="help-block " style="color: red">@isset($errorLibelle){{$errorLibelle}}@endisset</p>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3">@if($plateforme->description!=null){{$plateforme->description}}@endif</textarea>
                                <p class="help-block " style="color: red"></p>
                            </div>
                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" name="logo" />
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

        });

    </script>
@endsection