<div class="modal fade" tabindex="-1" role="dialog" id="modalNewUrl">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white">&times;</span>
                </button>
                <h5 class="modal-title">Nouveau Url</h5>
            </div>
            <div class="modal-body">
                <form class="center-block">
                    <div class="form-group col-md-8 col-md-offset-2">
                        <label>Libéllé</label>
                        <input type="text" name="libelle" class="form-control" id="add_url_libelle">
                        <p id="error_add_url_libelle" style="color: red"></p>
                    </div>
                    <div class="form-group col-md-8 col-md-offset-2">
                        <label>Lien</label>
                        <input type="text" id="add_url_url" name="url" class="form-control" placeholder="www.example.com">
                        <p id="error_add_url_lien" style="color: red"></p>
                    </div>
                </form>
                <div class="row">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button class="btn btn-primary btn-large" id="btnAddUrl"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> ajout...">Ajouter</button>

            </div>
        </div>
    </div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="modalEditUrl">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white">&times;</span>
                </button>
                <h5 class="modal-title">Nouveau Url</h5>
            </div>
            <div class="modal-body">
                <form class="center-block">
                    <div class="form-group col-md-8 col-md-offset-2">
                        <label>Libéllé</label>
                        <input type="text" name="libelle" class="form-control" id="edit_url_libelle">
                        <p id="error_edit_url_libelle" style="color: red"></p>
                    </div>
                    <div class="form-group col-md-8 col-md-offset-2">
                        <label>Lien</label>
                        <input type="text" id="edit_url_url" name="url" class="form-control" placeholder="www.example.com">
                        <p id="error_edit_url_lien" style="color: red"></p>
                    </div>
                </form>
                <div class="row">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button class="btn btn-primary btn-large" id="btnEditUrl"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Mise à jour...">Mettre à jour</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalDeleteUrl">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white">&times;</span>
                </button>
                <h5 class="modal-title">Suppression Url</h5>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    Êtes vous certain de vouloir supprimer?
                </p>
                <div class="row">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                <button class="btn btn-primary btn-large" id="btnDeleteUrl"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Suppression...">Oui</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modalDeletePicture">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;color: white;font-size: 1.5em;font-weight: bold">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white">&times;</span>
                </button>
                <h5 class="modal-title">Suppression</h5>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    Êtes vous certain de vouloir supprimer cet élément?
                </p>
                <div class="row">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                <button class="btn btn-primary btn-large" id="btnDeletePicture"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Suppression...">Oui</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalImportImage">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Définir la taille d'image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-xs-12 col-sm-4 col-sm-offset-2">
                    <div style="display: block; width: 300px; height: 300px;">
                        <div id="upload-realisation"></div>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button class="btn btn-primary btn-large" id="btnImporter"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Chargement...">Importer</button>

            </div>
        </div>
    </div>
</div>
