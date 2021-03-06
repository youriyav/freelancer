<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('admin/login','AdminController@loginAdmin')->name('loginAdmin');
Route::post('admin/login','AdminController@loginAdmin')->name('loginAdmin');
Route::middleware(['AuthAdmin'])->group(function () {
#------------------------------- plateforme --------------------------------
    Route::get('admin/logout','AdminController@logout')->name('logoutAdmin');
    Route::get('admin','AdminController@index')->name('indexAdmin');
    Route::get('admin/plateforme','AdminController@plateforme')->name('indexPlateformeAdmin');
    Route::get('admin/nouvelle-plateforme','AdminController@creerPlateforme')->name('creerPlateforme');
    Route::post('admin/nouvelle-plateforme','AdminController@creerPlateforme')->name('creerPlateforme');
    Route::get('admin/editer-plateforme/{id}','AdminController@editerPlateforme')->name('editerPlateforme')->where('id', '[0-9]+');
    Route::post('admin/editer-plateforme/{id}','AdminController@editerPlateforme')->name('editerPlateforme')->where('id', '[0-9]+');
    Route::get('admin/supprimer-plateforme/{id}','AdminController@supprimerPlateforme')->name('supprimerPlateforme')->where('id', '[0-9]+');
#------------------------------- end plateforme --------------------------------
#------------------------------- TECHONOLOGIES --------------------------------
    Route::get('admin/techologies','AdminController@techologies')->name('indextechologiesAdmin');
    Route::get('admin/nouvelle-technologie','AdminController@creerTechnologie')->name('creerTechnologie');
    Route::post('admin/nouvelle-technologie','AdminController@creerTechnologie')->name('creerTechnologie');
    Route::get('admin/editer-technologie/{id}','AdminController@editerTechnologie')->name('editerTechnologie')->where('id', '[0-9]+');
    Route::post('admin/editer-technologie/{id}','AdminController@editerTechnologie')->name('editerTechnologie')->where('id', '[0-9]+');
    Route::get('admin/supprimer-technologie/{id}','AdminController@supprimerTechnologie')->name('supprimerTechnologie')->where('id', '[0-9]+');
#------------------------------- END TECHONOLOGIES --------------------------------
#---------------------------------------- BUDGET------------------------------------
    Route::get('admin/budget','AdminController@budget')->name('indexBudgetAdmin');
    Route::get('admin/nouveau-budget','AdminController@creerBudget')->name('creerBudget');
    Route::post('admin/nouveau-budget','AdminController@creerBudget')->name('creerBudget');
    Route::get('admin/editer-budget/{id}','AdminController@editerBudget')->name('editerBudget')->where('id', '[0-9]+');
    Route::post('admin/editer-budget/{id}','AdminController@editerBudget')->name('editerBudget')->where('id', '[0-9]+');
    Route::get('admin/supprimer-budget/{id}','AdminController@supprimerBudget')->name('supprimerBudget')->where('id', '[0-9]+');
#-------------------------------- END BUDGET ----------------------------------------
#---------------------------------------- DESCRIPTION_FORMULE------------------------------------
    Route::get('admin/description-formule','AdminController@descriptFormule')->name('descriptFormule');
    Route::get('admin/nouvelle-description-formule','AdminController@creerDescriptFormule')->name('creerDescriptFormule');
    Route::post('admin/nouvelle-description-formule','AdminController@creerDescriptFormule')->name('creerDescriptFormule');
    Route::get('admin/editer-description-formule/{id}','AdminController@editerDescriptionFormule')->name('editerDescriptionFormule')->where('id', '[0-9]+');
    Route::post('admin/editer-description-formule/{id}','AdminController@editerDescriptionFormule')->name('editerDescriptionFormule')->where('id', '[0-9]+');
    Route::get('admin/supprimer-description-formule/{id}','AdminController@supprimerDescriptionFormule')->name('supprimerDescriptionFormule')->where('id', '[0-9]+');
#-------------------------------- END DESCRIPTION_FORMULE ----------------------------------------
#---------------------------------------- FORMULE------------------------------------
    Route::get('admin/formule-d-abonnement','AdminController@formule')->name('indexFormuleAdmin');
    Route::get('admin/nouvelle-formule','AdminController@creerFormule')->name('creerFormule');
    Route::post('admin/nouvelle-formule','AdminController@creerFormule')->name('creerFormule');
    Route::get('admin/editer-formule/{id}','AdminController@editerFormule')->name('editerFormule')->where('id', '[0-9]+');
    Route::post('admin/editer-formule/{id}','AdminController@editerFormule')->name('editerFormule')->where('id', '[0-9]+');
    Route::get('admin/supprimer-formule/{id}','AdminController@supprimerFormule')->name('supprimerFormule')->where('id', '[0-9]+');
#-------------------------------- END FORMULE ----------------------------------------
##---------------------------------------- Langue------------------------------------
    Route::get('admin/langue','AdminController@indexLangue')->name('indexLangue');
    Route::get('admin/nouvelle-langue','AdminController@creerLangue')->name('creerLangue');
    Route::post('admin/nouvelle-langue','AdminController@creerLangue')->name('creerLangue');
    Route::get('admin/editer-langue/{id}','AdminController@editerLangue')->name('editerLangue')->where('id', '[0-9]+');
    Route::post('admin/editer-langue/{id}','AdminController@editerLangue')->name('editerLangue')->where('id', '[0-9]+');
    Route::get('admin/supprimer-langue/{id}','AdminController@supprimerLangue')->name('supprimerLangue')->where('id', '[0-9]+');
#-------------------------------- END Langue ----------------------------------------
##---------------------------------------- Langue------------------------------------
    Route::get('admin/demarrage-projet','AdminController@indexDemarrage')->name('indexDemarrage');
    Route::get('admin/nouveau-demarrage-projet','AdminController@creerDemarrageProjet')->name('creerDemarrageProjet');
    Route::post('admin/nouveau-demarrage-projet','AdminController@creerDemarrageProjet')->name('creerDemarrageProjet');
    Route::get('admin/editer-demarrage-projet/{id}','AdminController@editerdemarrageProjet')->name('editerdemarrageProjet')->where('id', '[0-9]+');
    Route::post('admin/editer-demarrage-projet/{id}','AdminController@editerdemarrageProjet')->name('editerdemarrageProjet')->where('id', '[0-9]+');
    Route::get('admin/supprimer-demarrage-projet/{id}','AdminController@supprimerdemarrageProjet')->name('supprimerdemarrageProjet')->where('id', '[0-9]+');
#-------------------------------- END Langue ----------------------------------------
##---------------------------------------- Projet------------------------------------
    Route::get('admin/projets/{jour}','AdminController@indexProjet')->name('indexProjet');
    Route::get('admin/detail-projet/{id}','AdminController@detailProjet')->name('detailProjet');
    Route::get('admin/valider-projet/{id}','AdminController@ValiderProjet')->name('ValiderProjet');
    Route::get('admin/supprimer-projet/{id}','AdminController@supprimerProjet')->name('supprimerProjet');

    Route::get('admin/editer-demarrage-projet/{id}','AdminController@editerdemarrageProjet')->name('editerdemarrageProjet')->where('id', '[0-9]+');
    Route::post('admin/editer-demarrage-projet/{id}','AdminController@editerdemarrageProjet')->name('editerdemarrageProjet')->where('id', '[0-9]+');
    Route::get('admin/supprimer-demarrage-projet/{id}','AdminController@supprimerdemarrageProjet')->name('supprimerdemarrageProjet')->where('id', '[0-9]+');
#-------------------------------- END Projet ----------------------------------------#
#---------------------------------------- Commande------------------------------------
    Route::get('admin/commande/{jour}','AdminController@indexCommande')->name('indexCommande');
    Route::get('admin/commande/valider/{id}','AdminController@validerCommande')->name('validerCommande')->where('id', '[0-9]+');
#-------------------------------- END Commande ----------------------------------------
#---------------------------------------- Ajax------------------------------------
    Route::get('admin/update-descrip-position/{id}/{type}','AdminController@updateDescriptPosition')->name('updateDescriptPosition')->where('id', '[0-9]+')->where('type', '[0-9]+');
    Route::get('admin/update-formule-position/{id}/{type}','AdminController@updateFormulePosition')->name('updateFormulePosition')->where('id', '[0-9]+')->where('type', '[0-9]+');
    Route::get('admin/remove-formule-descript-value/{idFormule}/{idDescription}','AdminController@removeDescriptPosition')->name('removeDescriptPosition')->where('idFormule', '[0-9]+')->where('idDescription', '[0-9]+');
    Route::post('formule-descript-value','AdminController@updateDescriptFormuleValue')->name('updateDescriptFormuleValue');
#-------------------------------- END Ajax ----------------------------------------



});

#---------------------------------------- ROUTES PRESTATAIRES -----------------------------------------------

Route::get('/', 'PrestataireController@index')->name('indexPrestataire');
Route::get('/projets/{slug}', 'PrestataireController@detailProjetUser')->name('detailProjetUser');
Route::post('/nouvelle-offre', 'PrestataireController@nouvelleOffre')->name('nouvelleOffre');
Route::get('projet/{slugPlateforme}', 'PrestataireController@indexPlateForme')->name('indexPlateFormeUser');
Route::get('projet/{slugPlateforme}/{slugTechno}', 'PrestataireController@indexTechnoUser')->name('indexTechnoUser');
Route::post('projet/recherche', 'PrestataireController@searchUser')->name('searchUser');
Route::get('se-deconnecter', 'PrestataireController@seDeconnecter')->name('seDeconnecter');
Route::get('se-connecter', 'PrestataireController@seConnecter')->name('seConnecter');
Route::post('se-connecter', 'PrestataireController@seConnecter')->name('seConnecter');
Route::get('inscription', 'PrestataireController@inscription')->name('inscription');
Route::get('valider-compte/{key}', 'PrestataireController@validerCompte')->name('validerCompte');
Route::post('reinitialiser-compte', 'PrestataireController@reinitialiserCompte')->name('reinitialiserCompte');
Route::get('restaurer-compte/{key}', 'PrestataireController@restaurerCompte')->name('restaurerCompte');
Route::post('restaurer-compte/{key}', 'PrestataireController@restaurerCompte')->name('restaurerCompte');
Route::post('send-message', 'PrestataireController@sendMessageText')->name('sendMessage');

Route::get('test', 'PrestataireController@test')->name('test');
Route::get('nos-tarifs', 'PrestataireController@noTarifs')->name('noTarifs');
Route::post('inscription', 'PrestataireController@inscription')->name('inscription');
Route::get('profil/{slug}', 'PrestataireController@profil')->name('profil');
Route::post('send-email-to', 'PrestataireController@sendEmailTo')->name('sendEmailTo');


Route::middleware(['AuthUser'])->group(function () {
    #------------ profil ----------"
        Route::post('update-profil', 'PrestataireController@updateImageProfil')->name('updateImageProfil');
        Route::post('update-name', 'PrestataireController@updateName')->name('updateName');
        Route::post('update-prenom', 'PrestataireController@updatePrenom')->name('updatePrenom');
        Route::post('update-phone', 'PrestataireController@updatePhone')->name('updatePhone');
        Route::post('update-description', 'PrestataireController@updateDescription')->name('updateDescription');
        Route::post('update-password', 'PrestataireController@updatePassword')->name('updatePassword');
        Route::post('update-technologies', 'PrestataireController@updateTechnologies')->name('updateTechnologies');
        Route::post('update-langues', 'PrestataireController@updateLangues')->name('updateLangues');
    #------------ end profil ----------"
    Route::get('mon-compte', 'PrestataireController@monCompte')->name('monCompte');
    Route::get('/abonnement', 'PrestataireController@abonnement')->name('abonnement');
    Route::post('abonnement/nouveau', 'PrestataireController@nouveauAbonnement')->name('nouveauAbonnement');
    Route::get('abonnement/commande/{numero}', 'PrestataireController@detailCommande')->name('detailCommande');
    Route::get('mes-projets', 'PrestataireController@mesProjets')->name('mesProjets');
    Route::get('mes-projets/{slug}', 'PrestataireController@detailMonProjet')->name('detailMonProjet');
    Route::get('projets/{slug}/offres/{idOffre}', 'PrestataireController@detailOffre')->name('detailOffre');
    Route::get('update-notification-message/{lastNotificationId}/{lastMessageId}', 'PrestataireController@updateNotifMessage')->name('updateNotifMessage');
    Route::get('mes-comptences', 'PrestataireController@mesCompetences')->name('mesCompetences');
    Route::get('mes-devis', 'PrestataireController@mesDevis')->name('mesDevis');
    Route::get('nouveau-projet', 'PrestataireController@nouveauProjet')->name('nouveauProjet');
    Route::Post('nouveau-projet', 'PrestataireController@nouveauProjet')->name('nouveauProjet');

    Route::get('/conversation/{slug}', 'PrestataireController@conversation')->name('conversation');
    Route::get('/attribuer-projet/{slug}/{user}', 'PrestataireController@attribuerProjetUser')->name('attribuerProjetUser');
    Route::get('/loadMessage/{slug}/{id_prestataire}', 'PrestataireController@loadMessage')->name('loadMessage')->where('id_prestataire', '[0-9]+');
    Route::get('/loadMessage-last/{slug}/{id_prestataire}/{lastMessageId}', 'PrestataireController@loadLastMessage')->name('loadLastMessage')->where('id_prestataire', '[0-9]+');
    Route::post('chatt-message', 'PrestataireController@chattMessage')->name('chattMessage');

    #---------------------------- competences --------------------------------------------------#
    Route::post('new-url', 'PrestataireController@AddUrl')->name('AddUrl');
    Route::post('edit-url', 'PrestataireController@editUrl')->name('editUrl');
    Route::post('importer-image-realisation', 'PrestataireController@importerImageRealisation')->name('importerImageRealisation');
    Route::post('editer-image-realisation', 'PrestataireController@editerImageRealisation')->name('editerImageRealisation');
    Route::get('delete-url/{idSite}', 'PrestataireController@deleteUrl')->name('deleteUrl');
    Route::get('delete-picture/{idPicture}', 'PrestataireController@deletePicture')->name('deletePicture');
    #----------------------------end  competences ----------------------------------------------#
});
#-------------------------------------- END ROUTES PRESTATAIRES ---------------------------------------------

#-------------------------------------- ROUTES AGENCES -------------------------------------------------
Route::get('nouvelle-agence', 'AgenceController@nouvelleAgence')->name('nouvelleAgence');
Route::post('nouvelle-agence', 'AgenceController@nouvelleAgence')->name('nouvelleAgence');
Route::get('agence-afc', 'AgenceController@AfterCreation')->name('AfterCreation');
Route::middleware(['AuthAdminAgence'])->group(function () {
    Route::get('agence', 'AgenceController@indexAgence')->name('indexAgence');
    Route::get('parametres', 'AgenceController@parametres')->name('parametres');
    Route::post('agence/update-phone', 'AgenceController@updatePhone')->name('updatePhoneAgence');
    Route::post('agence/update-slogan', 'AgenceController@updateSlogan')->name('updateSlogan');
    Route::post('agence/update-bp', 'AgenceController@updateBoitePostale')->name('updateBoitePostale');
    Route::post('agence/update-description', 'AgenceController@updateDescription')->name('updateDescription');
    Route::post('agence/update-password', 'AgenceController@updatePassword')->name('updatePassword');
    Route::post('agence/update-logo', 'AgenceController@updateLogo')->name('updateLogo');
    Route::get('nos-services', 'AgenceController@nosServices')->name('nosServices');
    Route::get('nos-projets', 'AgenceController@nosProjets')->name('nosProjets');
    Route::post('agence/update-gps-coordonne', 'AgenceController@updateGpsCoordonne')->name('updateGpsCoordonne');
});
#-------------------------------------- END ROUTES AGENCES ---------------------------------------------





