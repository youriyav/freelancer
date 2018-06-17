<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Langue;
use App\Message;
use App\Notification;
use App\Photo;
use App\plateforme;
use App\Prestataire;
use App\Slug;
use App\Technologie;
use App\User;
use App\Validation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use JavaScript;

class AgenceController extends Controller
{
    //
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
    public function nouvelleAgence(Input $input,Request $request)
    {
        if($request->getMethod()=="GET")
        {
            return view('agence.register');
        }
        else
        {
            $isError=0;
            $type=1;
            $raisonSocial=trim($input->get('raisonSocial'));
            $email=trim($input->get('email'));
            $numero=trim($input->get('numero'));
            $bPostal=trim($input->get('bPostal'));
            $login=trim($input->get('login'));
            $password=trim($input->get('password'));
            $passwordConf=trim($input->get('passwordConf'));
            $condition=$input->get('condition');

            $tabError=array("","","","","","","");
            if($raisonSocial=="")
            {
                $tabError[0]="veuillez remplir ce champs";
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
            if($numero=="")
            {
                $tabError[2]="veuillez remplir ce champs";
                $isError++;
            }

            if($login=="")
            {
                $tabError[3]="veuillez remplir ce champs";
                $isError++;
            }
            if($password=="")
            {
                $tabError[4]="veuillez remplir ce champs";
                $isError++;
            }
            else
            {
                if($passwordConf=="")
                {
                    $tabError[5]="veuillez remplir ce champs";
                    $isError++;
                }
                else
                {
                    if(trim($password)!=trim($passwordConf))
                    {
                        $tabError[5]="les deux mots de passe ne sont pas identiques";
                        $isError++;
                    }
                }
            }
            if(!$condition==1)
            {
                $tabError[6]="veuillez cocher cette case";
                $isError++;
            }

            $user=User::where('email',$email)->first();
            if($user!=null)
            {
                $tabError[1]="l'adresse est déjà enregistrée avec un compte.";
                $isError++;
            }
            $user=User::where('login',$login)->first();
            if($user!=null)
            {
                $tabError[3]="ce login est déjà utilisé";
                $isError++;
            }
            if($isError!=0)
            {
                return view('agence.register',["tabError"=>$tabError,"raisonSocial"=>$raisonSocial,"email"=>$email,"bPostal"=>$bPostal,"numero"=>$numero,"login"=>$login,"condition"=>$condition]);
            }

            $agence=new Agence();
            $user=new User();
            $user->name=$raisonSocial;
            $user->prenom=$raisonSocial;
            $user->email=$email;
            $user->login=$login;
            $user->phone=$numero;
            $user->active=1;
            $user->isAgencyAdmin=1;
            $user->password=Hash::make($password);
            $user->save();
            $agence->raisonSocial=$raisonSocial;
            $agence->email=$email;
            $agence->boitePostal=$bPostal;
            $agence->numero=$numero;

            $slug="";
            $libelle2=str_replace('&',' ',$raisonSocial);
            $libelle2=str_replace('/',' ',$libelle2);
            $cpt=0;
            do
            {
                if($cpt==0)
                {
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
            $agence->save();
            $agence->slug()->save($slugObject);
            $agence->admin()->save($user);
            $folder='uploads/ag/'.$agence->slug->content;
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
                mkdir($folder.'/pictures', 0777, true);
                mkdir($folder.'/videos', 0777, true);
                mkdir($folder.'/files', 0777, true);
            }
            $validation=new Validation();
            $validation->key=hash('ripemd160',$email."free".$agence->slug->content);
            $validation->isValidate=0;
            $validation->type=$type;
            $user->validationKey()->save($validation);
            $link="http://192.168.1.26:8000/valider-compte/".$validation->key;
            #$this->registerhtml_email($email,$nom,$link);
            return redirect()->route('AfterCreation',["login"=>$agence->raisonSocial]);
        }

    }
    public  function AfterCreation(Input $input,Request $request)
    {
        $name=$request->input('login');
        $agences=Agence::where("raisonSocial",$name)->get();
        $nbr=count($agences)-1;
        $agence=$agences[$nbr];
        if(!$agence)
        {
            abort(404, 'The resource you are looking for could not be found');
        }
        $duree=(Carbon::now()->diffInSeconds($agence->created_at)); // 0);
        if ($duree<30)
        {
            return view('agence.after-register',["login"=>$name]);
        }
        else
        {
            return redirect()->route('indexPrestataire');
        }

    }
    public  function indexAgence(Input $input,Request $request)
    {
        $agence=Auth::user()->agence;
        return view('agence.monagence.index',["agence"=>$agence]);
    }

    public function updatePhone(Input $input,Request $request)
    {
        $value=$input->get('value');
        $agence=Auth::user()->agence;
        $agence->numero=$value;
        $agence->save();
        return $value;
    }
    public function updateSlogan(Input $input,Request $request)
    {
        $value=$input->get('value');
        $agence=Auth::user()->agence;
        $agence->slogan=$value;
        $agence->save();
        return $value;
    }
    public function updateBoitePostale(Input $input,Request $request)
    {
        $value=$input->get('value');
        $agence=Auth::user()->agence;
        $agence->boitePostal=$value;
        $agence->save();
        return $value;
    }
    public function updateDescription(Input $input,Request $request)
    {
        $value=$input->get('value');
        $agence=Auth::user()->agence;
        $agence->description=$value;
        $agence->save();
        return $value;
    }
    public function updateAdresse(Input $input,Request $request)
    {
        $value=$input->get('value');
        $agence=Auth::user()->agence;
        $agence->adresse=$value;
        $agence->save();
        return $value;
    }
    public function updatePassword(Input $input,Request $request)
    {
        $oldPass=trim($input->get('oldPass'));
        $newPass=trim($input->get('newPass'));
        $user=Auth::user();
        if(!Hash::check($oldPass, $user->password))
        {
            abort(401, 'Ancien mot de passe incorrect');
        }
        $user->password=Hash::make($newPass);
        $user->save();
        if(Auth::check())
        {
            Auth::logout();
        }
        return $oldPass;
    }
    public function updateGpsCoordonne(Input $input,Request $request)
    {
        $lng=trim($input->get('lng'));
        $lat=trim($input->get('lat'));
        $agence=Auth::user()->agence;
        $agence->longitude=$lng;
        $agence->latitude=$lat;
        $agence->save();
        return $lat;
    }
    public function updateLogo(Input $input,Request $request)
    {
        $agence=Auth::user()->agence;
        $profil=$input->get('profil');
        $user=Auth::user();
        $data = base64_decode(explode(',',$profil)[1]);
        $nameOfFile='logo_'.$agence->slug->content.'.png';
        $folder='uploads/ag/'.$agence->slug->content;
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
            mkdir($folder.'/pictures', 0777, true);
            mkdir($folder.'/videos', 0777, true);
            mkdir($folder.'/files', 0777, true);
        }
        file_put_contents($folder.'/pictures/'.$nameOfFile,$data);
        $fichier=Photo::create(['libelle'=>$nameOfFile,'url'=>$folder.'/pictures/'.$nameOfFile]);

        if($agence->logo)
        {
            $agence->logo()->delete();
            $agence->save();
        }
        $agence->logo()->save($fichier);
        return $profil;
    }
    public function nosServices()
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
        return view('agence.monagence.nosServices',["listeLangue"=>$listeLangue,"listeOfPlat"=>$listeOfPlat]);
    }
    public function nosProjets(Input $input,Request $request)
    {
        $new=$input->get('new');
        $projets=Auth::user()->projets;
        $listeOfPlat=plateforme::where('isDeleted',0)->get();
        if($new)
        {

            //dd($listeOfPlat->last()->created_at);
            //dd(Carbon::now()->diffInSeconds($listeOfPlat->last()->created_at)); // 0);

            return view('agence.monagence.projet',["listeOfPlat"=>$listeOfPlat,"message"=>"Félicitations! <br> votre projet a été créée avec succès! vous serez notifier à chaque fois qu'un freelance vous fait un dévis","projets"=>$projets]);
        }
        return view('agence.monagence.projet',["listeOfPlat"=>$listeOfPlat,"projets"=>$projets]);
    }


}
