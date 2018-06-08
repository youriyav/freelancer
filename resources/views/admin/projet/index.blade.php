@extends('admin.projet.layout')

@section('content_main')
    <div class="row" style="margin-top: 10px">
        <form action="{{route('searchUser')}}" method="post"  class="text-center center-block">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-4 form-group-lg  col-md-offset-1" style="padding: 5px">
                    <select data-toggle="tmp" class="form-control" name="slugPlat" id="rubrique">
                        <option value="0">Toutes les Plateformes</option>
                        @foreach($listeOfPlat as $plat)
                            <option value="{{$plat->id}}">{{$plat->libelle}}</option>
                        @endforeach

                    </select>
                </div>
            <div class="col-md-4 form-group-lg" style="padding: 5px">
                <select class="form-control" name="slugTechno" id="techno">
                    <option value="0">Toutes les technologies</option>
                    @foreach($listeOfTechnologies as $techno)
                        <option value="{{$techno->id}}">{{$techno->libelle}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 col-lg-1 form-group-lg " style="padding-top: 5px">
                <button class="btn btn-primary " style="" ><i class="fa fa-search"></i> Rechercher</button>
            </div>


        </form>
    </div>
    <div class="row " style="margin-top: 10px">
        <div class="col-md-12">
            @foreach($projets as $projet )
                <div class="panel projet col-lg-10 col-lg-offset-1" style="padding-bottom: 10px;padding-top: 10px">
                    <div class="panel-heading" style="margin: 0;padding: 0;padding-left: 5px">
                        <img src="/uploads/plateformes/plateforme_03.png" class="img-circle" width="20" height="20" style="float: left"> <h4  class="text-primary inline"><a href="{{route('detailProjet',["id"=>$projet->id])}}">{{$projet->titre}}</a></h4>
                    </div>
                    <div class="panel-body" style="padding: 5px;color: black;">
                        <div class="text-summury">{{$projet->description}}</div>
                        <div class="competences">
                            <h6>compétences requises</h6>
                            <div style="margin-left: 15px">
                                @foreach($projet->competences as $techno )
                                    <button class="alert alert-info" style="padding: 3px;margin: 0">{{$techno->libelle}} </button>
                                @endforeach</div>

                        </div>
                    </div>
                    <div class="panel-footer">

                        <i class="fa fa-clock-o"></i>&nbsp;
                        {{getDureeFromCarbone($projet->created_at)}}
                        &nbsp;
                        <i class="fa fa-eye"></i> {{$projet->nbrVue}} vue(s)&nbsp;&nbsp;
                        <i class="fa fa-hand-o-up"> </i>&nbsp;&nbsp;{{count($projet->offres)}} offre(s)&nbsp;&nbsp;
                        @if($projet->state==0)<i class="fa fa-circle" style="color: orange"></i> en cours de validation @endif &nbsp;&nbsp;
                        @if($projet->state==1)<i class="fa fa-circle" style="color: green"></i> publié @endif &nbsp;&nbsp;
                        <p>
                            <i class="fa fa-user"> Publié par {{$projet->user->name}} </i>
                        </p>
                        <p class="text-right">
                           <a href="{{route('supprimerProjet',["id"=>$projet->id])}}" class="btn"  style="color: red;border: solid 1px red"><i class="fa fa-trash-o"></i> Supprimer</a>
                           <a href="{{route('ValiderProjet',["id"=>$projet->id])}}" class="btn"  style="color: green;border: solid 1px green"><i class="fa fa-check-circle"></i> Valider</a>
                           <a href="{{route('detailProjet',["id"=>$projet->id])}}" class="btn "  style="color: blue;border: solid 1px blue"><i class="fa fa-ellipsis-h"></i> Détail</a>
                       </p>
                    </div>
                </div>

                <hr class="col-md-8 col-lg-offset-2" style="border: solid 1px cornflowerblue;margin-top: 0;">


            @endforeach
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