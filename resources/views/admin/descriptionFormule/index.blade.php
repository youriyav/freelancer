@extends('admin.descriptionFormule.layout')
@section('content_main')
    <div class="row " >
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-striped table-advance table-hover">
                    <h4 style=""> Liste Descriptions Formules <span class="pull-right"><a href="{{route('creerDescriptFormule')}}" data-toggle="tooltip" data-placement="bottom" title="Ajouter!"><i class="fa fa-plus-circle fa-2x"></i></a></span></h4>
                    <hr>
                    <thead>
                    <tr>
                        <th><i class=""></i>Libelle</th>
                        <th><i class=""></i>Type</th>
                        <th><i class=""></i>Valeur</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="table_content">
                    @foreach($listes as $object)
                        <tr id="pos_{{$object->position}}">
                            <td class="libelle">{{$object->libelle}}</td>
                            <td class="">
                                @if($object->type==1)Agence @endif
                                @if($object->type==2)Prestataire @endif
                            </td>
                            <td>
                                {{$object->value}}
                            </td>
                            <td>
                                <button class="btn btn-info btnUp" id="up_{{$object->id}}" data-loading-text="<i class='fa fa-spinner fa-spin '></i> ..."><i class="fa fa-arrow-circle-up"></i></button>
                                <button class="btn btn-warning btnDown" id="down_{{$object->id}}" data-loading-text="<i class='fa fa-spinner fa-spin '></i> ..."><i class="fa fa-arrow-circle-down"></i></button>
                                <a href="{{route('editerDescriptionFormule',['id'=>$object->id])}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil fa-2x"></i></a>
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
            $(".btnDown").click(function (e) {
                e.preventDefault();
                $this=$(this);
                currentId=$(this).prop('id').split('_')[1];
                currentRow=$this.parent().parent();
                $position=parseInt(currentRow.prop('id').split('_')[1]);
                $nestPsi=parseInt($position)+1;
                //alert($position);
                //alert($nestPsi);
                console.log(currentRow);
                $this.button('loading');
                $.ajax({
                    url :"/admin/update-descrip-position/"+currentId+"/1",
                    type : "get",
                    success : function(json)
                    {
                        console.log(json);
                        $this.button('reset');

                        $("#pos_"+(parseInt($position)+1)).after(currentRow);
                        currentRow.prop("id","pos_"+$nestPsi);
                       $("#pos_"+(parseInt($position)+1)).prop("id","pos_"+(parseInt($position)));
                    },
                    error :function(xhr,errmsg,err)
                    {
                        $this.button('reset');
                        console.log(xhr);
                    }
                });

            });
            $(".btnUp").click(function (e) {
                e.preventDefault();
                $this=$(this);
                currentId=$(this).prop('id').split('_')[1];
                currentRow=$this.parent().parent();
                $position=parseInt(currentRow.prop('id').split('_')[1]);
                $nestPsi=parseInt($position)-1;

                console.log(currentRow);
                $this.button('loading');
                $.ajax({
                    url :"/admin/update-descrip-position/"+currentId+"/2",
                    type : "get",
                    success : function(json)
                    {
                        console.log(json);
                        $this.button('reset');
                        $("#pos_"+(parseInt($position)-1)).before(currentRow);
                        $("#pos_"+(parseInt($nestPsi))).prop("id","pos_"+$position);
                        currentRow.prop("id","pos_"+$nestPsi);
                    },
                    error :function(xhr,errmsg,err)
                    {
                        $this.button('reset');
                        console.log(xhr);
                    }
                });

            });
            $('[data-toggle="tooltip"]').tooltip();
            $('.btn-danger').click(function () {
                $('.modal-body').text("Voulez supprimer la description "+$(this).parent().parent().find('.libelle').text()+"?");
                $('#btnDelete').attr("href","/admin/supprimer-description-formule/"+$(this).attr('id'));
                $("#deleteModal").modal('toggle');
            });
        });
    </script>
@endsection