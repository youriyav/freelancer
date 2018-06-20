@extends('admin.formule.layout')
@section('content_main')
    <div class="row " >
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-advance table-hover">
                    <h4 style=""> Liste Formules <span class="pull-right"><a href="{{route('creerFormule')}}" data-toggle="tooltip" data-placement="bottom" title="Ajouter!"><i class="fa fa-plus-circle fa-2x"></i></a></span></h4>
                    <hr>
                    <thead>
                    <tr>
                        <th><i class=""></i>Libelle</th>
                        <th><i class=""></i>Prix</th>
                        <th><i class=""></i>Type</th>
                        <th><i class="" style="width: 40%"></i>Description</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listes as $object)
                        <tr id="form_{{$object->position}}" style="">
                            <td class="libelle">{{$object->libelle}}</td>
                            <td class="">{{$object->prix}} Fcfa</td>
                            <td class="">@if($object->type==1) Agence @else Prestataire @endif </td>
                            <td class="" style="width: 50%" >
                                @foreach($object->descriptions()->orderBy('position', 'ASC')->get() as $descript)
                                    <div class="row" style="margin: 0;padding: 0;margin-bottom: 5px">
                                        - {{$descript->libelle}}
                                        @if($descript->hasValue==1)
                                            <?php $currentFormuleValue=\App\FormuleDescriptionValue::where("description_formule_id",$descript->id)->where("formule_id",$object->id)->first() ?>

                                                @if($currentFormuleValue)
                                                    <span class="badge badge-primary " id="descriptValue_{{$descript->id}}_{{$object->id}}">{{"($currentFormuleValue->value)"}}</span>
                                                @else
                                                    <span class="badge" style="background-color: orange" id="descriptValue_{{$descript->id}}_{{$object->id}}">non défini</span>
                                                @endif

                                                <input @if($descript->hasValue==1) checked @endif type="checkbox" id="descript_{{$descript->id}}_{{$object->id}}" class="hasValue">
                                                @if($descript->hasValue==1)
                                                    <i id="edit_{{$descript->id}}_{{$object->id}}" class="btn fa fa-edit btnEditValue" style="padding: 0;margin-top: -5px"></i>
                                                @endif
                                            @else
                                            <input type="checkbox" id="descript_{{$descript->id}}_{{$object->id}}" class="hasValue">
                                        @endif
                                    </div> @endforeach
                            </td>
                            <td>
                                <button class="btn btn-info btnUp" id="up_{{$object->id}}" data-loading-text="<i class='fa fa-spinner fa-spin '></i> ..."><i class="fa fa-arrow-circle-up"></i></button>
                                <button class="btn btn-warning btnDown" id="down_{{$object->id}}" data-loading-text="<i class='fa fa-spinner fa-spin '></i> ..."><i class="fa fa-arrow-circle-down"></i></button>
                                <a href="{{route('editerFormule',['id'=>$object->id])}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil fa-2x"></i></a>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="valueModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold">
                    <h5 class="modal-title">Définir la valeur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="btnCancelValue">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="col-md-8 col-md-offset-2">
                        <form class="">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtValue">
                                <p style="color: red;" id="txtError" hidden>veuillez remplir ce champs</p>
                            </div>
                        </form>
                    </div>
                    <div class="row">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="" class="btn btn-secondary btnCancelValue" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary btn-large" id="btnValidate"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Chargement...">Valider</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="removeValueModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="btnCancelRemove">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="col-md-8 col-md-offset-2">
                        <p class="text-center">Etes vous certains de continuer l'action?</p>
                    </div>
                    <div class="row">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="" class="btn btn-secondary btnCancelRemove" data-dismiss="modal">Non</button>
                    <button class="btn btn-primary btn-large" id="btnRemove"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Chargement...">Oui</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script src="{{url('/js/assets/notify.min.js')}}"></script>
    <script>
        var $idDescription;
        var $idFormule;
        var $type;
        var $currenthasValue;
        $(document).ready(function(){

            $(".btnUp").click(function (e) {
                e.preventDefault();
                $this=$(this);
                currentId=$(this).prop('id').split('_')[1];
                currentRow=$this.parent().parent();
                console.log(currentRow);
                $this.button('loading');
                $.ajax({
                    url :"/admin/update-formule-position/"+currentId+"/2",
                    type : "get",
                    success : function(json)
                    {
                        _data=JSON.parse(json);
                        console.log(_data);
                        $position=_data.old;
                        $nestPsi=_data.new;
                        $this.button('reset');
                        $("#form_"+$nestPsi).before(currentRow);
                        $("#form_"+$nestPsi).prop("id","form_"+$position);
                        currentRow.prop("id","form_"+$nestPsi);
                    },
                    error :function(xhr,errmsg,err)
                    {
                        $this.button('reset');
                        console.log(xhr);
                    }
                });
            });

            $(".btnDown").click(function (e) {
                e.preventDefault();
                $this=$(this);
                currentId=$(this).prop('id').split('_')[1];
                currentRow=$this.parent().parent();
                $position=parseInt(currentRow.prop('id').split('_')[1]);
                $nestPsi=parseInt($position)+1;
                console.log(currentRow);
                $this.button('loading');
                $.ajax({
                    url :"/admin/update-formule-position/"+currentId+"/1",
                    type : "get",
                    success : function(json)
                    {
                        _data=JSON.parse(json);
                        console.log(_data);
                        $position=_data.old;
                        $nestPsi=_data.new;
                        $this.button('reset');
                        $("#form_"+$nestPsi).after(currentRow);
                        currentRow.prop("id","form_"+$nestPsi);
                        $("#form_"+$nestPsi).prop("id","form_"+(parseInt($position)));
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
                $('.modal-body').text("Voulez supprimer la formule "+$(this).parent().parent().find('.libelle').text()+"?");
                $('#btnDelete').attr("href","/admin/supprimer-formule/"+$(this).attr('id'));
                $("#deleteModal").modal('toggle');
            });

            $("#btnValidate").click(function () {
                var $this = $(this);
                $("#txtError").hide();

                if($("#txtValue").val()=="")
                {
                    $("#txtError").show();
                    return 0;
                }
                $this.button('loading');
                _data={"type":$type,"idFormue":$idFormule,"idDescript":$idDescription,"value":$("#txtValue").val(),"_token":"<?php echo csrf_token() ?>"};
                $.ajax({
                    url :"/formule-descript-value",
                    data:_data,
                    type : "post",
                    success : function(json)
                    {
                        console.log(json);
                        //alert($idDescription);
                        //alert($idFormule);
                        $this.button('reset');
                        $("#valueModal").modal('toggle');
                        $.notify("Mise à jour éffectuée avec succès!", "info");
                        if($type==1)
                        {
                            location.href="/admin/formule-d-abonnement";
                        }
                        $("#descriptValue_"+$idDescription+"_"+$idFormule).text($("#txtValue").val());
                    },
                    error :function(xhr,errmsg,err)
                    {
                        console.log(xhr);
                        $this.button('reset');
                        $("#valueModal").modal('toggle');
                    }
                });


            });
            $(".btnCancelValue").click(function () {
                $currenthasValue.prop('checked',false);
            });
            $(".btnCancelRemove").click(function () {
                $currenthasValue.prop('checked',true);
            });
            $("#btnRemove").click(function () {
                var $this = $(this);
                $this.button('loading');
                $.ajax({
                    url :"/admin/remove-formule-descript-value/"+$idFormule+"/"+$idDescription,
                    type : "get",
                    success : function(json)
                    {
                        console.log(json);
                        $this.button('reset');
                        $("#removeValueModal").modal('toggle');
                        $.notify("Mise à jour éffectuée avec succès!", "info");
                        location.href="/admin/formule-d-abonnement";
                    },
                    error :function(xhr,errmsg,err)
                    {
                        console.log(xhr);
                        $this.button('reset');
                        $("#valueModal").modal('removeValueModal');
                    }
                });


            });

            $(".hasValue").change(function () {
                $this=$(this);
                $currenthasValue=$this;
                $idDescription=$this.prop('id').split('_')[1];
                $idFormule=$this.parent().parent().parent().prop('id').split('_')[2];
                if($this.prop('checked')==true)
                {
                    $("#txtValue").val("");
                    $type=1;
                    $("#valueModal").modal('toggle');
                }
                else
                {
                    $("#removeValueModal").modal('toggle');
                }
            });
            $(".btnEditValue").click(function () {
                $this=$(this);
                $idDescription=$this.prop('id').split('_')[1];
                $idFormule=$this.prop('id').split('_')[2];
                //alert($idFormule);
                //$idFormule=$this.parent().parent().parent().prop('id').split('_')[1];
                $("#txtValue").val("");
                //alert($("#descriptValue_"+$idDescription+"_"+$idFormule).text());
                if($("#descriptValue_"+$idDescription+"_"+$idFormule).text()=="non défini")
                {
                    $type=1;
                }
                else
                {
                    $type=2;
                }
                //alert($type);
                $("#valueModal").modal('toggle');

            });
        });
    </script>
@endsection