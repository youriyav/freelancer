<?php

namespace App\Http\Controllers;

use App\Prestataire;
use App\User;
use App\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

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
}
