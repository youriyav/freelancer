@extends('admin.projet.layout')

@section('content_main')
    <div class="row" style="margin-top: 10px">
    </div>
    <div class="row " style="margin-top: 10px">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Prestataire</th>
                        <th>Description</th>
                        <th>Montant</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($commandes as $commande )
                    <tr>
                        <td>#{{$commande->numero}}</td>
                        <td>{{$commande->user->name}} {{$commande->user->prenom}}</td>
                        <td>{{$commande->libelle}}</td>
                        <td>{{$commande->montant_ttc}} Fcfa</td>
                        <td>
                            <a href="" class="btn btn-social"><i class="fa fa-check-circle fa-2x" style="color: green" title="valider"></i></a>
                            <a href="" class="btn btn-social"><i class="fa fa-trash-o fa-2x"  style="color: red"  title="annuler"></i></a>
                            <a href="" class="btn btn-social"><i class="fa fa-refresh fa-2x"  style="color: yellow"  title="relancer"></i></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

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
                $('.modal-body').text("Voulez supprimer le type "+$(this).parent().parent().find('.libelle').text()+"?");
                $('#btnDelete').attr("href","/admin/supprimer-demarrage-projet/"+$(this).attr('id'));
                $("#deleteModal").modal('toggle');
            });
        });
    </script>
@endsection