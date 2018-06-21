@extends('admin.technologies.layout')
@section('content_main')
    <div class="row " >
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-striped table-advance table-hover">
                    <h4 style=""> Liste Technologies <span class="pull-right"><a href="{{route('creerTechnologie')}}" data-toggle="tooltip" data-placement="bottom" title="Ajouter!"><i class="fa fa-plus-circle fa-2x"></i></a></span></h4>
                    <hr>
                    <thead>
                    <tr>
                        <th><i class=""></i>Libelle</th>
                        <th><i class=""></i>Plateforme</th>
                        <th class="hidden-phone"><i class=""></i> Descrition</th>
                        <th class="hidden-phone"><i class=""></i> Couleur</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listes as $object)
                        <tr>
                            <td class="libelle">{{$object->libelle}}</td>
                            <td class="">{{$object->plateforme->libelle}}</td>
                            <td class="hidden-phone">@if($object->description!=null){{$object->description}}@endif</td>
                            <td class=""><i class="fa fa-circle fa-2x" @if($object->coleur) style="color: {{$object->coleur}}"@endif></i></td>

                            <td>
                                <a href="{{route('editerTechnologie',['id'=>$object->id])}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil fa-2x"></i></a>
                                <a class="btn btn-danger btn-xs" id="{{$object->id}}"><i class="fa fa-trash-o fa-2x"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>{!! $listes->appends(array('sort' => 'votes'))->links() !!}<!-- /content-panel -->
        </div>
    <!-- /col-md-12 -->
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
                        <a href="" id="btnDelete"  class="btn btn-primary">Oui</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $('.btn-danger').click(function () {
                $('.modal-body').text("Voulez supprimer la  technologie "+$(this).parent().parent().find('.libelle').text()+"?");
                $('#btnDelete').attr("href","/admin/supprimer-technologie/"+$(this).attr('id'));
                $("#deleteModal").modal('toggle');
            });
        });
    </script>
@endsection