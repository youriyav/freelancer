@extends('admin.budget.layout')
@section('content_main')
    <div class="row " >
        <div class="col-md-12">
            <div class="content-panel">
                <h4 style="text-decoration: underline" class="text-primary"><a href="{{route('indexBudgetAdmin')}}" data-toggle="tooltip" data-placement="bottom" title="Retour"><i class="fa fa-arrow-left"></i></a> Nouveau Budget </h4>
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <div style="height: 60px">
                            @isset($message)<div class="alert alert-success text-center"  style="max-height: 55px" >{{$message}} </div>@endisset
                        </div>
                        <form role="form" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label for="libelle">Libellé</label>
                            <div class="form-group input-group">

                                <input type="text" value="{{$budget->libelle}}" class="form-control" id="libelle" name="libelle">
                                <span class="input-group-addon">Fcfa</span>
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