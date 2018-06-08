@extends('admin.plateforme.layout')
@section('content_main')
    <div class="row " >
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-striped table-advance table-hover" style="font-size: 1.3em">
                    <h4 style=""> Liste Plateformes <span class="pull-right"><a href="{{route('creerPlateforme')}}" data-toggle="tooltip" data-placement="bottom" title="Ajouter!"><i class="fa fa-plus-circle fa-2x"></i></a></span></h4>
                    <hr>
                    <thead>
                    <tr>
                        <th><i class=""></i>Logo</th>
                        <th><i class=""></i>Libelle</th>
                        <th class="hidden-phone"><i class=""></i> Descrition</th>
                        <th class="hidden-phone"><i class="" style="width: 40%"></i> Technologies</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($listes as $object)
                        <?php $var = 0; ?>
                        <tr>
                            <td class="libelle">@if($object->logo !=null) <img src="{{ url($object->logo->url) }}" width="30" height="30">@endif</td>
                            <td class="libelle">{{$object->libelle}}</td>
                            <td class="hidden-phone">@if($object->description!=null){{$object->description}}@endif</td>
                            <td class="hidden-phone" style="width: 40%"> @foreach($object->technologies as $techno)<?php $var = $var+1; ?>{{$techno->libelle}}@if($var != count($object->technologies)), @endif @endforeach</td>

                            <td>
                                <a href="{{route('editerPlateforme',['id'=>$object->id])}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil fa-2x"></i></a>
                                <a class="btn btn-danger btn-xs" id="{{$object->id}}"><i class="fa fa-trash-o fa-2x"></i></a>
                            </td>
                        </tr>
                    @endforeach




                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
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
                $('.modal-body').text("Voulez supprimer la PlateForme "+$(this).parent().parent().find('.libelle').text()+"?");
                $('#btnDelete').attr("href","/admin/supprimer-plateforme/"+$(this).attr('id'));
                $("#deleteModal").modal('toggle');
            });
        });
    </script>
@endsection