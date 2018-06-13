<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Commande;
use App\DemarrageProjet;
use App\Formule;
use App\Langue;
use App\LigneCommande;
use App\Message;
use App\Notification;
use App\Offre;
use App\Photo;
use App\plateforme;
use App\Prestataire;
use App\Projet;
use App\Slug;
use App\Technologie;
use App\User;
use App\Validation;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;
use SendGrid\Content;
use SendGrid\Email;
use Zend\Ldap\Ldap;

class PrestataireController extends Controller
{
    protected $user;
    private  $Glog_messages;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if( Auth::check())
            {
                $this->user = Auth::user();
                $Glog_notifications=Notification::orderBy('id', 'DESC')->where('user_id',Auth::user()->id)->where('isReaded',0)->get();
                $Glog_messages=Message::where('isReaded',0)->where('receiver_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
                foreach ($Glog_notifications as $notif)
                {
                    $notif->isReaded=1;
                    //$notif->save();
                }
                foreach ($Glog_messages as $message)
                {
                    $message->isReaded=1;
                    //$message->save();
                }
                View::share([
                    'Glog_notifications'=>$Glog_notifications,
                    'Glog_messages'=>$Glog_messages
                ]);
            }

            return $next($request);
        });
    }
    public  $act=0;
    public function index()
    {
        $listeOfTechnologies=Technologie::where('isDeleted',0)->get();
        $listeOfPlat=plateforme::where('isDeleted',0)->get();
        $projets=Projet::where('state',1)->get();
        JavaScript::put([
            'listeOfTechnologies' => $listeOfTechnologies,
            'listeOfPlat' => $listeOfPlat
        ]);
        return view('prestataire.index',['listeOfTechnologies'=>$listeOfTechnologies,'listeOfPlat'=>$listeOfPlat,"projets"=>$projets]);
    }
    public function detailProjetUser($slug)
    {
        $currentSlug=Slug::where(['content'=>$slug,])->first();
        if($currentSlug)
        {
            $projet=$currentSlug->projet;
            $projet->nbrVue++;
            $projet->save();
            return view('prestataire.projet.detail',['projet'=>$projet]);
        }
        else
        {
            abort(404, 'The resource you are looking for could not be found');
        }

    }
    public function attribuerProjetUser($slug,$user)
    {
        $currentSlug=Slug::where(['content'=>$slug,])->first();
        if($currentSlug)
        {
            $freelancer=User::findOrFail($user);
            if($freelancer)
            {
                $projet=$currentSlug->projet;
                $projet->state=2;
                $projet->freelancer()->associate($freelancer);
                $projet->save();

                return "good";
            }
            else
            {
                abort(404, "cet utilisateur n'existe pas");
            }

            //return view('prestataire.projet.detail',['projet'=>$projet]);
        }
        else
        {
            abort(404, 'The resource you are looking for could not be found');
        }
    }
    public function indexPlateForme($slugPlateforme,Request $request,Input $input)
    {
        $currentPlateforme=null;
        if($request->method()=="GET")
        {
            $tmpSlug=Slug::where('content',$slugPlateforme)->first();
            if($tmpSlug)
            {
                $currentPlateforme=$tmpSlug->plateforme;
            }

        }
        else
        {
            $slug=$input::get('slug');
            $tmpSlug=Slug::findOrFail($slug);
            if($tmpSlug)
            {
                $currentPlateforme=$tmpSlug->plateforme;
            }
        }
        $listeOfTechnologies=Technologie::where('isDeleted',0)->get();
        $listeOfPlat=plateforme::where('isDeleted',0)->get();
        JavaScript::put([
            'listeOfTechnologies' => $listeOfTechnologies,
            'listeOfPlat' => $listeOfPlat
        ]);

        return view('prestataire.plateforme.index',['listeOfTechnologies'=>$listeOfTechnologies,'listeOfPlat'=>$listeOfPlat,'currentPlateforme'=>$currentPlateforme]);
    }
    public function indexTechnoUser($slugPlateforme,$slugTechno,Request $request,Input $input)
    {

        $currentPlateforme=null;
        $currentTechnologie=null;
        if($request->method()=="GET")
        {
            $tmpSlug=Slug::where('content',$slugPlateforme)->first();
            if($tmpSlug)
            {
                $currentPlateforme=$tmpSlug->plateforme;
            }
            $tmpSlug=Slug::where('content',$slugTechno)->first();
            if($tmpSlug)
            {
                $currentTechnologie=$tmpSlug->technologie;
            }

        }
        else
        {
            $slug=$input::get('slugPlat');
            $tmpSlug=Slug::findOrFail($slug);
            if($tmpSlug)
            {
                $currentPlateforme=$tmpSlug->plateforme;
            }
            $slug=$input::get('slugTechno');
            $tmpSlug=Slug::findOrFail($slug);
            if($tmpSlug)
            {
                $currentTechnologie=$tmpSlug->technologie;
            }
        }
        $listeOfTechnologies=Technologie::where('isDeleted',0)->get();
        $listeOfPlat=plateforme::where('isDeleted',0)->get();
        JavaScript::put([
            'listeOfTechnologies' => $listeOfTechnologies,
            'listeOfPlat' => $listeOfPlat
        ]);
        return view('prestataire.technologies.index',['listeOfTechnologies'=>$listeOfTechnologies,'listeOfPlat'=>$listeOfPlat,"currentPlateforme"=>$currentPlateforme,"currentTechnologie"=>$currentTechnologie]);
    }
    public function searchUser(Input $input)
    {
        $slugPlat=$input->get('slugPlat');
        $slugTechno=$input->get('slugTechno');
        dd($slugPlat);
        if($slugPlat!=0)
        {
            if($slugTechno!=0)
            {

            }
        }
        else
        {
            if($slugTechno!=0)
            {
            }
        }
    }
    public function inscription(Input $input,Request $request)
    {
        if($request->getMethod()=="GET")
        {
            return view('prestataire.register');
        }
        else
        {
            $isError=0;
            $type=1;
            $nom=$input->get('nom');
            $prenom=$input->get('prenom');
            $email=$input->get('email');
            $login=$input->get('login');
            $password=$input->get('password');
            $passwordConf=$input->get('passwordConf');
            $condition=$input->get('condition');
            $tabError=array("","","","","","","");
            if($nom=="")
            {
                $tabError[0]="veuillez remplir ce champs";
                $isError++;
            }
            if($prenom=="")
            {
                $tabError[6]="veuillez remplir ce champs";
                $isError++;
            }
            if($email=="")
            {
                $tabError[1]="veuillez remplir ce champs";
                $isError++;
            }
            else
            {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $tabError[1]="adresse mail invalide ";
                    $isError++;
                }
            }
            if($login=="")
            {
                $tabError[2]="veuillez remplir ce champs";
                $isError++;
            }
            if($password=="")
            {
                $tabError[3]="veuillez remplir ce champs";
                $isError++;
            }
            else
            {
                if($passwordConf=="")
                {
                    $tabError[4]="veuillez remplir ce champs";
                    $isError++;
                }
                else
                {
                    if(trim($password)!=trim($passwordConf))
                    {
                        $tabError[4]="les deux mots de passe ne sont pas identiques";
                        $isError++;
                    }
                }
            }
            if(!$condition==1)
            {
                $tabError[5]="veuillez cocher cette case";
                $isError++;
            }

            $user=User::where('email',$email)->first();
            if($user!=null)
            {
                $tabError[1]="l'adresse est déjà enregistrée avec un compte. veuillez vous connecter";
                $isError++;
            }
            $user=User::where('login',$login)->first();
            if($user!=null)
            {
                $tabError[2]="ce login est déjà utilisé";
                $isError++;
            }
            if($isError!=0)
            {
                return view('prestataire.register',["tabError"=>$tabError,"type"=>$type,"nom"=>$nom,"email"=>$email,"login"=>$login,"condition"=>$condition]);
            }
            $prestataire=new Prestataire();
            $prestataire->type=$type;
            $user=new User();
            $user->name=$nom;
            $user->prenom=$prenom;
            $user->email=$email;
            $user->login=trim($login);
            $user->phone='';
            $user->active=1;
            $user->password=Hash::make($password);
            $user->save();
            $prestataire->user()->associate($user);
            $prestataire->save();
            $folder='uploads/prest/'.$prestataire->id;
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
                mkdir($folder.'/pictures', 0777, true);
                mkdir($folder.'/videos', 0777, true);
                mkdir($folder.'/files', 0777, true);
            }
            $validation=new Validation();
            $validation->key=hash('ripemd160',$email."free".$login);
            $validation->isValidate=0;
            $validation->type=$type;
            $user->validationKey()->save($validation);
            $link="http://192.168.1.26:8000/valider-compte/".$validation->key;
            #$this->registerhtml_email($email,$nom,$link);
            return view('prestataire.after-register',["login"=>$user->login]);
        }

    }
    public function sendMessageText(Input $input,Request $request)
    {
       $idOffre=$input->get('idOffre');
       $mess=$input->get('message');
        if(Auth::check())
        {
           $user=Auth::user();
           $offre=Offre::findOrFail($idOffre);

           if($offre)
           {
               $message=new Message();
               $message->message=$mess;
               $message->isReaded=0;
               $user->sendMessage()->save($message);
               $offre->user->receiveMessage()->save($message);
               $offre->messages()->save($message);
               return '{"code":200,"message":"votre message a été envoyé avec succès!"}';
           }


        }
    }


    public function registerhtml_email($var,$name,$link){
        $data = array('name'=>$name,"link"=>$link);
        Mail::send('registermail', $data, function($message)  use ($var){
            $message->to($var, 'Tutorials Point')->subject
            ('Teranga-freelance');
            $message->from('yavouckolye@gmail.com','Teranga-freelance');
        });
    }
    public function restoreHtml_email($var,$name,$link){
        $data = array('name'=>$name,"link"=>$link);
        Mail::send('prestataire.restoremail', $data, function($message)  use ($var){
            $message->to($var, 'Tutorials Point')->subject
            ('Teranga-freelance');
            $message->from('yavouckolye@gmail.com','Teranga-freelance');
        });
    }
    public function test(){
        $name='youri yav';
        return view('registermail',['name'=>$name]);
    }
public  function validerCompte($key)
{
    $validation=Validation::where(['key'=>$key,'isValidate'=>0])->first();
    if($validation)
    {

        $validation->user->active=1;
        $validation->user->save();
        $validation->isValidate=1;
        $validation->save();
        return redirect()->route('seConnecter',['act'=>$validation->user->login]);
    }
    else
    {
        abort(404, 'The resource you are looking for could not be found');
    }

}
public  function seConnecter(Input $input,Request $request,$act=1)
{
    //à revoir
    //$next=$input->get('next');
    $next= $request->input('next');
    if($request->getMethod()=="GET")
    {
        $name = $request->input('act');
        if($name!=null)
        {
            JavaScript::put([
                'Usrelogin' => $name
            ]);
            return view('prestataire.login',["login"=>$name]);
        }
        if($next!=null)
        {
            return view('prestataire.login',["next"=>$next]);
        }
        return view('prestataire.login');
    }
    else
    {
        $isError=0;
        $email=$input->get('email');
        $password=$input->get('password');
        $tabError=array("","");
        $error="";
        $res=null;
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $user=User::where(['email'=>$email])-> first();
            if($user)
            {
                if($user->active==1)
                {
                    $res=Auth::attempt(['email'=>$email,'password'=>$password]);
                    if ($res)
                    {
                        if($next!=null)
                        {
                            return redirect($next);
                        }
                        return redirect()->route('monCompte');
                    }
                    else
                    {
                        $error="login ou mot de passe incorrect";
                    }
                }
                else
                {
                    $error="votre compte n'est pas encore active.veuillez consulter votre boite mail pour activer votre compte";
                }
            }
            {
                $error="login ou mot de passe incorrect";
            }
        }
        else
        {
            $user=User::where(['login'=>$email])-> first();
            if($user)
            {
                if($user->active==1)
                {
                    $res=Auth::attempt(['email'=>$user->email,'password'=>$password]);
                    if ($res)
                    {
                        if($next!=null)
                        {
                            return redirect($next);
                        }
                        return redirect()->route('monCompte');
                    }
                    else
                    {
                        $error="login ou mot de passe incorrect";
                    }
                }
                else
                {
                    $error="votre compte n'est pas encore active.veuillez consulter votre boite mail pour activer votre compte";
                }
            }
            else
            {
                $error="login ou mot de passe incorrect";
            }
        }
        if($res==null ||$res==false)
        {
            if($next!=null)
            {

                return view('prestataire.login',["next"=>$next,'error'=>$error,'login'=>$email]);
            }
            return view('prestataire.login',['error'=>$error,'login'=>$email]);
        }

    }
}
public function seDeconnecter()
{
    if(Auth::check())
    {
        Auth::logout();
    }
    return redirect()->route("indexPrestataire");
}
public function reinitialiserCompte(Input $input,Request $request)
{
    $login=$input->get('loginRenit');
    if(filter_var($login, FILTER_VALIDATE_EMAIL))
    {
        $user=User::where(['email'=>$login])-> first();
        if($user)
        {
            $validation=new Validation();
            $validation->key=hash('ripemd160',$user->email."free_val_".count($user->validationKey).$login);
            $validation->isValidate=0;
            $validation->type=1;
            $user->validationKey()->save($validation);
            $link="http://127.0.0.1:8000/restaurer-compte/".$validation->key;
            $this->restoreHtml_email($user->email,$user->login,$link);
            return  '{"code":200,"message":"Un mail de restauration vous été envoyer via votre adresse email. Veuillez consulter votre boite mail pour continuer"}';
            /*if($user->active==1)
            {
            }
            else
            {
            }*/
        }
        else
        {
            return  '{"code":404,"message":"ce compte n\'existe pas"}';
        }
    }
    else
    {
        $user=User::where(['login'=>$login])-> first();
        if($user)
        {
            $validation=new Validation();
            $validation->key=hash('ripemd160',$user->email."free_val_".count($user->validationKey).$login);
            $validation->isValidate=0;
            $validation->type=2;
            $user->validationKey()->save($validation);
            $link="http://127.0.0.1:8000/restaurer-compte/".$validation->key;
            $this->restoreHtml_email($user->email,$user->login,$link);
            return  '{"code":200,"message":"Un mail de restauration vous été envoyer via votre adresse email. Veuillez consulter votre boite mail pour continuer"}';
            /*if($user->active==1)
            {
            }
            else
            {
            }*/
        }
        else
        {
            return  '{"code":404,"message":"ce compte n\'existe pas"}';
        }
    }

}
public function  restaurerCompte(Input $input,Request $request,$key)
{
    if($request->getMethod()=="GET")
    {
        $validation=Validation::where(['key'=>$key,'isValidate'=>0])->first();
        if($validation)
        {
            return view('prestataire.restore_password',["validationkey"=>$key]);
        }
        else
        {
            abort(404, 'The resource you are looking for could not be found');
        }
    }
    else
    {
        $key=$input->get('validationkey');
        $password=$input->get('password');
        $passwordConf=$input->get('passwordConf');
        $validation=Validation::where(['key'=>$key])->first();
        if($passwordConf!=$password)
        {
            return view('prestataire.restore_password',["validationkey"=>$key,"error"=>"les deux mot de passe ne sont pas identiques"]);
        }
        $validation->user->active=1;
        $validation->isValidate=1;
        $validation->save();

        $validation->user->password=Hash::make($password);
        $validation->user->save();
        Auth::attempt(['email'=>$validation->user->email,'password'=>$password]);
        return redirect()->route('indexPrestataire');
    }
}
public function monCompte()
{
    return view('prestataire.moncompte.index');
}
public function mesProjets(Input $input,Request $request)
{
    $new=$input->get('new');
    $projets=Auth::user()->projets;
    $listeOfPlat=plateforme::where('isDeleted',0)->get();
    if($new)
    {

        //dd($listeOfPlat->last()->created_at);
        //dd(Carbon::now()->diffInSeconds($listeOfPlat->last()->created_at)); // 0);

        return view('prestataire.moncompte.projet',["listeOfPlat"=>$listeOfPlat,"message"=>"Félicitations! <br> votre projet a été créée avec succès! vous serez notifier à chaque fois qu'un freelance vous fait un dévis","projets"=>$projets]);
    }
    return view('prestataire.moncompte.projet',["listeOfPlat"=>$listeOfPlat,"projets"=>$projets]);
}
public function mesCompetences()
{
    $listeLangue=Langue::where('isDeleted',0)->get();
    $listeOfPlat=plateforme::where('isDeleted',0)->get();
    $listeUserTechno=Auth::user()->technologies;
    $listeUserLangue=Auth::user()->langues;
    $listeOfTechnologies=Technologie::where('isDeleted',0)->get();
    JavaScript::put([
        'listeUserLangue' => $listeUserLangue,
        'listeLangue' => $listeLangue,
        'listeUserTechno' => $listeUserTechno,
        'listeOfPlat' => $listeOfPlat,
        'listeOfTechnologies' => $listeOfTechnologies
    ]);
    return view('prestataire.moncompte.mesCompetences',["listeLangue"=>$listeLangue,"listeOfPlat"=>$listeOfPlat]);
}
public function updateImageProfil(Input $input,Request $request)
{
    $profil=$input->get('profil');
    $user=Auth::user();
    $data = base64_decode(explode(',',$profil)[1]);
    $nameOfFile='profil_'.$user->login.'_'.$user->id.'.png';
    $folder='uploads/prest/'.$user->prestataire->id;
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
        mkdir($folder.'/pictures', 0777, true);
        mkdir($folder.'/videos', 0777, true);
        mkdir($folder.'/files', 0777, true);
    }
    file_put_contents($folder.'/pictures/'.$nameOfFile,$data);
    $fichier=Photo::create(['libelle'=>$nameOfFile,'url'=>$folder.'/pictures/'.$nameOfFile]);
    if($user->profil)
    {
        $user->profil()->delete();
        $user->save();
    }
    $user->profil()->save($fichier);
    return $profil;
}
public function updateName(Input $input,Request $request)
{
    $name=$input->get('name');
    $idPrestataire=$input->get('idPrestataire');
    $user=User::findOrFail($idPrestataire);
    $user->name=$name;
    $user->save();
    return $name;
}
public function updatePrenom(Input $input,Request $request)
{
    $name=$input->get('name');
    $idPrestataire=$input->get('idPrestataire');
    $user=User::findOrFail($idPrestataire);
    $user->prenom=$name;
    $user->save();
    return $name;
}
public function updatePhone(Input $input,Request $request)
{
    $name=$input->get('name');
    $idPrestataire=$input->get('idPrestataire');
    $user=User::findOrFail($idPrestataire);
    $user->phone=$name;
    $user->save();
    return $name;
}
public function updateTechnologies(Input $input,Request $request)
{
    $technologies=$input->get('technologies');
    $idPrestataire=$input->get('idPrestataire');
    $user=User::findOrFail($idPrestataire);
    $user->technologies()->detach();
    foreach ($technologies as $techno)
    {
        //$currentTechno=Technologie::findOrFail($techno);
        $user->technologies()->attach($techno);
    }
    $listeUserTechno=Auth::user()->technologies;
    $res="[";
    $tmp=0;
    foreach ($listeUserTechno as $techno)
    {
        $tmp++;
        $res.='{"id":'.$techno->id.',"libelle":"'.$techno->libelle.'"}';
        if($tmp!=count($listeUserTechno))
        {
            $res.=",";
        }

    }
    $res.="]";
    return $res;
}
public function updateLangues(Input $input,Request $request)
{
    $langues=$input->get('langues');
    $idPrestataire=$input->get('idPrestataire');
    $user=User::findOrFail($idPrestataire);
    $user->langues()->detach();
    foreach ($langues as $langue)
    {
        //$currentTechno=Technologie::findOrFail($techno);
        $user->langues()->attach($langue);
    }
    $listeLangue=Auth::user()->langues;
    $res="[";
    $tmp=0;
    foreach ($listeLangue as $langue)
    {
        $tmp++;
        $res.='{"id":'.$langue->id.',"libelle":"'.$langue->libelle.'"}';
        if($tmp!=count($listeLangue))
        {
            $res.=",";
        }
    }
    $res.="]";
    return $res;
}
public function updateDescription(Input $input,Request $request)
{
    $name=$input->get('name');
    $idPrestataire=$input->get('idPrestataire');
    $user=User::findOrFail($idPrestataire);
    $user->prestataire->description=$name;
    $user->prestataire->save();
    $user->save();
    return $name;
}
    public function updatePassword(Input $input,Request $request)
    {
        $oldPass=$input->get('oldPass');
        $newPass=$input->get('newPass');
        $idPrestataire=$input->get('idPrestataire');
        $user=User::findOrFail($idPrestataire);
        if(!Hash::check($oldPass, $user->password))
        {
            abort(401, 'Ancien mot de passe incorrect');
        }
        else
        {

        }
        $user->password=Hash::make($newPass);
        $user->save();
        if(Auth::check())
        {
            Auth::logout();
        }
        return $oldPass;
    }
    public function nouveauProjet(Input $input,Request $request)
    {
        $listeOfPlat=plateforme::where('isDeleted',0)->get();
        $listeBudget=Budget::where('isDeleted',0)->get();
        $listeTypeDemarrage=DemarrageProjet::where('isDeleted',0)->get();
        if($request->getMethod()=="GET")
        {
            return view('prestataire.projet.nouveau',["listeOfPlat"=>$listeOfPlat,"listeBudget"=>$listeBudget,"listeTypeDemarrage"=>$listeTypeDemarrage]);
        }
        else
        {
            $titre=$input->get('titre');
            $description=$input->get('description');
            $descrip=$input->get('descrip');
            $budget=$input->get('budget');
            $demarrage=$input->get('demarrage');
            $budget=Budget::findOrFail($budget);
            $demarrage=DemarrageProjet::findOrFail($demarrage);
            $projet=new Projet();
            $projet->state=0;
            $projet->nbrVue=0;
            $projet->description=$descrip;
            $projet->titre=$titre;
            $projet->save();
            $projet->budget()->associate($budget);
            $projet->demarrage()->associate($demarrage);
            $projet->user()->associate(Auth::user());
            $projet->competences()->save(Auth::user());

            $slug="";
            $libelle2=str_replace('&',' ',$titre);
            $libelle2=str_replace('/',' ',$libelle2);
            $cpt=0;
            do
            {
                if($cpt==0)
                {
                    $libelle2=$libelle2.' '.count(Auth::user()->projets).''.Auth::user()->id.' ';
                    $slug=str_slug($libelle2, "-");
                }
                else
                {
                    $slug=str_slug($libelle2."-$cpt", "-");
                }
                $tmpSlug=Slug::where('content',$slug)->first();
                $cpt++;
            }while($tmpSlug!=null);
            $slugObject=Slug::create(['content'=>$slug]);
            $projet->slug()->save($slugObject);
            $projet->save();
            foreach ($description as $techno)
            {
                $projet->competences()->attach($techno);
            }
            $projet->save();
            return redirect()->route('mesProjets',["new"=>"1"]);
        }

    }
    public function getProjetDuree(Projet $projet)
    {
        $duree=(Carbon::now()->diffInMinutes($projet->created_at)); // 0);
        return $duree;
    }
    public function nouvelleOffre(Input $input,Request $request)
    {
        $user=Auth::user();
        $idProjet=$input->get('idProjet');
        $idPrestataire=$input->get('idPrestataire');
        $montant=$input->get('montant');
        $duree=$input->get('duree');
        $description="";
        if($input->get('description')!="")
        {
            $description=$input->get('description');
        }
        else
        {
            $description="";
        }
        $projet=Projet::findOrFail($idProjet);
        $tmpOffre=Offre::where(['projet_id'=>$projet->id,'user_id'=>$user->id])->first();
        if($tmpOffre)
        {
            return '{"code":202,"message":"vous avez déjà fais une offre sur ce projet\n veuillez patienter le temps ce client vous reponde"}';
        }
        else
        {
            $offre=new Offre();
            $offre->prix=$montant;
            $offre->duree=$duree;
            $offre->description=$description;
            $offre->state=0;
            $user->projets()->save($offre);
            $projet->offres()->save($offre);

            $notification=new Notification();
            $notification->libelle="Nouvelle offre de ".$user->login;
            $notification->message=$user->login." vous a fait une offre par rapport au projet ".$projet->titre;
            $notification->type=2;
            $notification->url="/projets/".$projet->slug->content."/offres/".$offre->id;
            $projet->user->notifications()->save($notification);
            return '{"code":200,"message":"vore offre a été envoyé avec succès"}';

        }


    }
    public function detailMonProjet($slug)
    {
        $currentSlug=Slug::where(['content'=>$slug,])->first();
        if($currentSlug)
        {
            $projet=$currentSlug->projet;
            if($projet->user->id==Auth::user()->id)
            {
                return view('prestataire.moncompte.detail_projet',['projet'=>$projet]);
            }
            abort(404, 'The resource you are looking for could not be found');
        }
        else
        {
            abort(404, 'The resource you are looking for could not be found');
        }
    }
    public function detailOffre($slug,$idOffre)
    {
        $currentSlug=Slug::where(['content'=>$slug,])->first();
        if($currentSlug)
        {
            $projet=$currentSlug->projet;
            if($projet->user->id==Auth::user()->id)
            {
                $offre=$projet->offres()->where('id',$idOffre)->first();
                if($offre)
                {
                    $user=Auth::user();
                    $offre->state=1;
                    $offre->save();
                    $notification=new Notification();
                    $notification->libelle="offre pris en compte";
                    $notification->message="votre offre a été vue par le client";
                    $notification->type=3;
                    $notification->url="/projets/".$projet->slug->content;
                    $offre->user->notifications()->save($notification);
                    $notification->save();
                    return view('prestataire.moncompte.detail_offre',['projet'=>$projet,'offre'=>$offre]);
                }
                abort(404, 'The resource you are looking for could not be found');
            }
            else
            {
                abort(404, 'The resource you are looking for could not be found');
            }
        }
        else
        {
            abort(404, 'The resource you are looking for could not be found');
        }
    }
    public function conversation(Input $input,Request $request,$slug)
    {
        $idProjet=$input->get('idProjet');
        $idSender=$input->get('user');
        $currentSlug=Slug::where(['content'=>$slug,])->first();
        JavaScript::put([
            'isConversation' => 1
        ]);
        if($currentSlug)
        {
            $projet=$currentSlug->projet;
            $offres=$projet->offres;
            $message=array();
            $users=array();
            foreach ($offres as $of)
            {
                $ckeck=false;
                foreach ($users as $user)
                {
                    if($user->id==$of->user->id)
                    {
                        $ckeck=true;
                    }
                }
                if($ckeck==false)
                {
                    array_push($users,$of->user);
                }

            }
            //dd($users);
            $messagesNonLus=Message::where('receiver_id',Auth::user()->id)->where('isReaded',0)->get();

            if($projet->user->id==Auth::user()->id)
            {
                if($idSender)
                {
                    $selected=User::findOrFail($idSender);
                    if($selected)
                    {
                        return view('prestataire.moncompte.conversation',['projet'=>$projet,"users"=>$users,"selected"=>$selected,"isConversation"=>1,"messagesNonLus"=>$messagesNonLus]);
                    }
                    else
                    {
                        abort(404, 'The resource you are looking for could not be found');
                    }
                }
                return view('prestataire.moncompte.conversation',['projet'=>$projet,"users"=>$users,"isConversation"=>1,"messagesNonLus"=>$messagesNonLus]);
            }
            else
            {
                $users=array($projet->user);
                $selected=$projet->user;
                $offre=$projet->offres()->where('user_id',Auth::user()->id)->first();
                //array_push($users,$of->user);
                return view('prestataire.moncompte.conversation',['projet'=>$projet,"users"=>$users,"selected"=>$selected,"offre"=>$offre,"isConversation"=>1,"messagesNonLus"=>$messagesNonLus]);
            }
        }
        abort(404, 'The resource you are looking for could not be found');
    }
    public function loadMessage(Input $input,Request $request,$slug,$id_prestataire)
    {
        $currentSlug=Slug::where(['content'=>$slug,])->first();
        if($currentSlug)
        {
            if($currentSlug->projet->user->id == Auth::user()->id)
            {
                $offre=$currentSlug->projet->offres()->where("user_id",$id_prestataire)->first();
            }
            else
            {
                $offre=$currentSlug->projet->offres()->where("user_id",Auth::user()->id)->first();
            }
            return $offre->messages()->orderBy('id', 'ASC')->get();
        }
        else
        {
            abort(404, 'The resource you are looking for could not be found');
        }
    }
    public function loadLastMessage(Input $input,Request $request,$slug,$id_prestataire,$lastMessageId)
    {
        $currentSlug=Slug::where(['content'=>$slug,])->first();
        if($currentSlug)
        {
            if($currentSlug->projet->user->id == Auth::user()->id)
            {
                $offre=$currentSlug->projet->offres()->where("user_id",$id_prestataire)->first();
            }
            else
            {
                $offre=$currentSlug->projet->offres()->where("user_id",Auth::user()->id)->first();
            }
            return $offre->messages()->where('receiver_id','=',Auth::user()->id)->where('id','>',$lastMessageId)->orderBy('id', 'ASC')->get();
        }
        else
        {
            abort(404, 'The resource you are looking for could not be found');
        }
    }
    public function chattMessage(Input $input,Request $request)
    {
        $idReceiver=$input->get('idReceiver');
        $idProjet=$input->get('idProjet');
        $mess=$input->get('message');
        $projet=Projet::findOrFail($idProjet);
        $receiver=User::findOrFail($idReceiver);
        if(Auth::check() && $receiver)
        {
            $user=Auth::user();

            $message=new Message();
            $message->message=$mess;
            $message->isReaded=0;
            $user->sendMessage()->save($message);
            if($projet->user->id == Auth::user()->id)
            {
                $tmpOffre=Offre::where(['projet_id'=>$projet->id,'user_id'=>$receiver->id])->first();
                $tmpOffre->user->receiveMessage()->save($message);
            }
            else
            {
                $tmpOffre=Offre::where(['projet_id'=>$projet->id,'user_id'=>Auth::user()->id])->first();
                $projet->user->receiveMessage()->save($message);
            }

            $tmpOffre->messages()->save($message);
            return '{"code":200,"message":"votre message a été envoyé avec succès!"}';
        }
        abort(404, 'The resource you are looking for could not be found');
    }
    public function updateNotifMessage(Input $input,Request $request,$lastNotificationId,$lastMessageId)
    {
        if($request->isXmlHttpRequest())
        {
            if(Auth::check())
            {
                $user = Auth::user();
                //$massages=Message::where('receiver_id',$user->id)->where('isReaded',0)->where('id','>',$lastMessageId)->get();
                //$notification=Notification::where('user_id',$user->id)->where('isReaded',0)->where('id','>',$lastNotificationId)->get();
                $messages=Message::where('receiver_id',$user->id)->where('isReaded',0)->get();
                $notifications=Notification::where('user_id',$user->id)->where('isReaded',0)->get();
                $listMessage=array();
                $listNotification=array();
                $listNotification="[";
                $cpt=0;
                foreach ($notifications as $notif)
                {
                    $cpt++;
                    $listNotification.='{';
                    $listNotification.='"libelle":"'.$notif->libelle.'",';
                    $listNotification.='"url":"'.$notif->url.'"';
                    $listNotification.='}';
                    if($cpt!=count($notifications))
                    {
                        $listNotification.=',';
                    }
                    $notif->isReaded=1;
                   $notif->save();
                }
                $listNotification.="]";

                $listMessage="[";
                $cpt=0;
                foreach ($messages as $message)
                {
                    $cpt++;
                    $listMessage.='{';
                    $listMessage.='"slug":"'.$message->offre->projet->slug->content.'",';
                    $listMessage.='"id":"'.$message->sender->id.'",';
                    $listMessage.='"idMessage":"'.$message->id.'",';
                    $listMessage.='"id_receiver":"'.$message->receiver->id.'",';
                    if($message->sender->profil)
                    {
                        $listMessage.='"profil":"'.$message->sender->profil->url.'",';
                    }
                    else
                    {
                        $listMessage.='"profil":"img/avatar.png",';

                    }
                    $listMessage.='"login":"'.$message->sender->login.'",';
                    $listMessage.='"date":"'.getDureeFromCarbone($message->created_at).'",';
                    $listMessage.='"content":"'.$message->message.'"';
                    $listMessage.='}';
                    if($cpt!=count($messages))
                    {
                        $listMessage.=',';
                    }
                    $message->isReaded=1;
                    $message->save();
                }
                $listMessage.="]";
                return '{"messages":'.$listMessage.',"notifications":'.$listNotification.'}';
            }
            abort(404, 'The resource you are looking for could not be found');
        }
        abort(404, 'The resource you are looking for could not be found');
    }
    public function abonnement(Input $input,Request $request)
    {
        $listeOffre=Formule::all();
        JavaScript::put([
            'listeOffre' => $listeOffre,
        ]);

        return view('prestataire.abonnement',["listeOffre"=>$listeOffre]);
    }
    public function nouveauAbonnement(Input $input,Request $request)
    {
        $user = Auth::user();
        $idFormule=$input->get('idFormule');
        $quantite=$input->get('quantite');
        $formule=Formule::findOrFail($idFormule);
        $commande=new Commande();
        $commande->libelle=$formule->libelle." (".$formule->prix." Fcfa)";
        $commande->montant_ht=$formule->prix*$quantite;
        $commande->montant_ttc=$formule->prix*$quantite;
        $commande->statut=0;
        $user->commandes()->save($commande);
        $ligne=new LigneCommande();
        $ligne->libelle=$commande->libelle;
        $ligne->prix=$formule->prix;
        $ligne->quantite=$quantite;
        $commande->lignes()->save($ligne);
        $numero="";
        $limit=0;
        if(strlen($commande->id)==1)
        {
            $limit = 5;
        }
        if(strlen($commande->id)==2)
        {
            $limit = 4;
        }
        if(strlen($commande->id)==3)
        {
            $limit = 3;
        }
        if(strlen($commande->id)==4)
        {
            $limit = 2;
        }
        if(strlen($commande->id)==5)
        {
            $limit = 1;
        }
        while(strlen($numero)<$limit)
        {
            $tmp=rand(1,9);
            $numero.=$tmp;
        }
        $commande->numero=$commande->id."".$numero;
        $commande->save();
        return $commande->numero;
    }
    function detailCommande(Input $input,Request $request,$numero)
    {
        $commande=Commande::where("numero",$numero)->first();
        if($commande)
        {
            return view('prestataire.detailCommande',["commande"=>$commande]);
        }
        abort(404, 'The resource you are looking for could not be found');
    }
    function ajouterSite(Input $input,Request $request,$numero)
    {
        $commande=Commande::where("numero",$numero)->first();
        if($commande)
        {
            return view('prestataire.detailCommande',["commande"=>$commande]);
        }
        abort(404, 'The resource you are looking for could not be found');
    }
}
