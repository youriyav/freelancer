<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Commande;
use App\DemarrageProjet;
use App\DescriptionFormule;
use App\Formule;
use App\FormuleDescriptionValue;
use App\Langue;
use App\Photo;
use App\plateforme;
use App\Projet;
use App\Slug;
use App\Technologie;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use JavaScript;


class AdminController extends Controller
{
    // login method
    public function __construct()
    {
        $listesPlateforme=plateforme::where('isDeleted',0)->get();
        $listesTechnologie=Technologie::where('isDeleted',0)->get();
        $GlobalNbrBudget=Budget::where('isDeleted',0)->get();
        $GlobalNbrFormule=Formule::where('isDeleted',0)->get();
        $GlobalNbrDescriptFormule=DescriptionFormule::where('isDeleted',0)->get();
        $GlobalNbrDescriptLangue=Langue::where('isDeleted',0)->get();
        $GlobalNbrDemarrage=DemarrageProjet::where('isDeleted',0)->get();
        $GlobalNbrProjets=Projet::all();
        $GlobalNbrCommande=Commande::all();
        View::share([
            'GlobalNbrPlateForme'=> count($listesPlateforme),
            'GlobalNbrTechnologies'=>count($listesTechnologie),
            'GlobalNbrBudget'=>count($GlobalNbrBudget),
            'GlobalNbrFormule'=>count($GlobalNbrFormule),
            'GlobalNbrDescriptFormule'=>count($GlobalNbrDescriptFormule),
            'GlobalNbrDescriptLangue'=>count($GlobalNbrDescriptLangue),
            'GlobalNbrDemarrage'=>count($GlobalNbrDemarrage),
            'GlobalNbrProjets'=>count($GlobalNbrProjets),
            'GlobalNbrCommande'=>count($GlobalNbrCommande)
        ]);
        //$this->middleware('AuthAdmin');
    }


    public function loginAdmin(Request $request,Input $input)
    {
        $next=$input->get('next');
        $login=$input->get('login');
        if($request->getMethod()=="GET")
        {
            if ($login)
            {
                return view('admin.login',['next'=>$next,'login'=>$login,'error'=>"login ou mot de passe incorrect"]);
            }
            return view('admin.login',['next'=>$next]);
        }
        else
        {
            $isEmail=true;
            $login=$input->get('login');
            $password=$input->get('password');
            if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
                $isEmail=false;
            }
            if($isEmail)
            {
                $res=Auth::attempt(['email'=>$login,'password'=>$password]);
            }
            else
            {
                $user=User::where('login',$login)-> first();
                $res=null;
                if($user)
                {
                    $res=Auth::attempt(['email'=>$user->email,'password'=>$password]);
                }

            }
            if($res)
            {
                //$projets=Projet::whereDate('created_at', DB::raw('CURDATE()'))->get();
                if($next!=null)
                {
                    return redirect($next);
                }
                return redirect()->route('indexAdmin');
            }
            else
            {
                return redirect()->route('loginAdmin',['login'=>/*'login ou mot de passe incorrect'*/$login]);
                //return view('admin.login',['error'=>'login ou mot de passe incorrect']);
            }
        }
    }
    public function index(Request $request,Input $input)
    {
        $projets=Projet::whereDate('created_at', DB::raw('CURDATE()'))->get();
        $commandes=Commande::where('statut',0)->get();
        return view('admin.index',["projets"=>$projets,"commandes"=>$commandes]);
    }
    // logout method
    public function logout()
    {
        if(Auth::check())
        {
            Auth::logout();
        }
        return redirect()->route("loginAdmin");
    }

    #-------------------------------- plateforme ----------------------------#
    public  function plateforme()
    {
        $listes=plateforme::where('isDeleted',0)->get();
        return view('admin.plateforme.index',compact('listes'));
    }
    public function  creerPlateforme(Request $request,Input $input)
    {
        if($request->getMethod()=="GET")
        {
            return view('admin.plateforme.creer');
        }
        else
        {
            $libelle=$input->get('libelle');
            $description=$input->get('description');
            $file=$request->file('logo');
            if($libelle!="")
            {
                #$plateforme=plateforme::where('libelle',$libelle)->first();
                $plateforme=plateforme::where(['libelle'=>$libelle,'isDeleted'=>0])->first();
                if($plateforme==null)
                {
                    $plateforme=new plateforme();
                    $plateforme->libelle=$libelle;
                    if($description!=null)
                    {
                        $plateforme->description=$description;
                    }
                    $plateforme->save();
                    $cpt=0;
                    $slug="";
                    $libelle2=str_replace('&',' ',$libelle);
                    $libelle2=str_replace('/',' ',$libelle2);
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
                    $plateforme->slug()->save($slugObject);
                    if($file)
                    {
                        $nameOfFile='plateforme_0'.$plateforme->id.'.'.$file->getClientOriginalExtension();//'drapeau_'.$libelle.'_'.$pays->id+'.'+$file->getClientOriginalExtension();
                        $destinationPath = 'uploads/plateformes';
                        $file->move($destinationPath,$nameOfFile);
                        $fichier=Photo::create(['libelle'=>$nameOfFile,'url'=>$destinationPath.'/'.$nameOfFile]);
                        $plateforme->logo()->save($fichier);
                    }
                    $next=$input->get('next');
                    if($next!=null)
                    {
                        return view('admin.plateforme.creer',["message"=>"Plateforme créée avec succès!"]);
                    }
                    else
                    {
                        return redirect()->route("indexPlateformeAdmin");
                    }
                }
                else
                {
                    return view('admin.plateforme.creer',["errorLibelle"=>"Cette plateforme existe déjà","libelle"=>$libelle]);
                }

            }
            else
            {
                return view('admin.plateforme.creer',["errorLibelle"=>"Veuillez remplir ce champs"]);
            }

        }
    }
    public function editerPlateforme($id,Request $request,Input $input)
    {
        $plateforme=plateforme::findOrFail($id);
        if($request->getMethod()=="GET")
        {
            return view('admin.plateforme.editer',["plateforme"=>$plateforme]);
        }
        else
        {
            $libelle=$input->get('libelle');
            $libelle2=str_replace('&',' ',$libelle);
            $libelle2=str_replace('/',' ',$libelle2);
            $description=$input->get('description');
            $file=$request->file('logo');
            if($libelle!="")
            {
                if($libelle!=$plateforme->libelle)
                {
                    $plateforme->libelle=$libelle;
                    $cpt=0;
                    $slug="";
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
                    if($plateforme->slug)
                    {
                        $plateforme->slug->delete();
                    }
                    $slugObject=Slug::create(['content'=>$slug]);
                    $plateforme->slug()->save($slugObject);
                }
                if($description!=null)
                {
                    $plateforme->description=$description;
                }
                $plateforme->save();
                if($file)
                {
                    $oldFichier=$plateforme->logo();
                    if($oldFichier)
                    {
                        $oldFichier->delete();
                    }
                    $nameOfFile='plateforme_0'.$plateforme->id.'.'.$file->getClientOriginalExtension();//'drapeau_'.$libelle.'_'.$pays->id+'.'+$file->getClientOriginalExtension();
                    $destinationPath = 'uploads/plateformes';
                    $file->move($destinationPath,$nameOfFile);
                    $fichier=Photo::create(['libelle'=>$nameOfFile,'url'=>$destinationPath.'/'.$nameOfFile]);
                    $plateforme->logo()->save($fichier);
                }

                return redirect()->route("indexPlateformeAdmin");
            }
            else
            {
                return view('admin.plateforme.creer',["errorLibelle"=>"Veuillez remplir ce champs"]);
            }

        }

    }
    public function supprimerPlateforme($id)
    {
        $plateforme=plateforme::findOrFail($id);
        $plateforme->isDeleted=1;
        $plateforme->save();
        return redirect()->route("indexPlateformeAdmin");
    }
    #-------------------------------- end plateforme --------------------------#


    #--------------------------------- technologies ---------------------------#
    public function techologies()
    {
        $listes=Technologie::where('isDeleted',0)->paginate(5);;
        return view('admin.technologies.index',compact('listes'));
    }
    public function  creerTechnologie(Request $request,Input $input)
    {
        $listes=plateforme::where('isDeleted',0)->get();

        if($request->getMethod()=="GET")
        {
            return view('admin.technologies.creer',compact('listes'));
        }
        else
        {
            $isError=0;
            $libelle=$input->get('libelle');
            $description=$input->get('description');
            $plateforme=$input->get('plateforme');
            $errorDescript="";
            $errorLibelle="";
            if($libelle==null)
            {
                $isError++;
                $errorLibelle="veuillez remplir ce champs";
            }
            if($plateforme=="0")
            {
                $isError++;
                $errorDescript="veuillez choisir une plateforme";
            }

            if($isError==0)
            {
                #$plateforme=plateforme::where('libelle',$libelle)->first();
                $technologie=Technologie::where(['libelle'=>$libelle,'isDeleted'=>0])->first();
                if($technologie==null)
                {
                    $plate=plateforme::findOrFail($plateforme);
                    $technologie= new Technologie();
                    $technologie->libelle=$libelle;
                    if($description!=null)
                    {
                        $technologie->description=$description;
                    }

                    $plate->technologies()->save($technologie);
                    $cpt=0;
                    $slug="";
                    $libelle2=str_replace('&',' ',$libelle);
                    $libelle2=str_replace('/',' ',$libelle2);
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
                    $technologie->slug()->save($slugObject);

                    $next=$input->get('next');
                    if($next!=null)
                    {
                        return view('admin.technologies.creer',compact('listes'));
                    }
                    else
                    {
                        return redirect()->route("indextechologiesAdmin");
                    }
                }
                else
                {
                    return view('admin.technologies.creer',["errorLibelle"=>"Cette technologie existe déjà","errorDescript"=>$errorDescript,"listes"=>$listes,"plateforme"=>$plateforme,"libelle"=>$libelle]);
                }
            }
            else
            {
                return view('admin.technologies.creer',["errorLibelle"=>$errorLibelle,"errorDescript"=>$errorDescript,"listes"=>$listes,"plateforme"=>$plateforme,"libelle"=>$libelle]);
            }

        }
    }

    public function  editerTechnologie($id,Request $request,Input $input)
    {
        $technologie=Technologie::findOrFail($id);
        $listes=plateforme::where('isDeleted',0)->get();
        if($request->getMethod()=="GET")
        {
            return view('admin.technologies.editer',['listes'=>$listes,'technologie'=>$technologie]);
        }
        else
        {
            $isError=0;
            $libelle=$input->get('libelle');
            $description=$input->get('description');
            $plateforme=$input->get('plateforme');
            $errorDescript="";
            $errorLibelle="";
            if($libelle==null)
            {
                $isError++;
                $errorLibelle="veuillez remplir ce champs";
            }
            if($plateforme=="0")
            {
                $isError++;
                $errorDescript="veuillez choisir une plateforme";
            }
            if($isError==0)
            {
                #$plateforme=plateforme::where('libelle',$libelle)->first();

                $plate=plateforme::findOrFail($plateforme);
                if($technologie->libelle!=$libelle)
                {
                    $technologie->libelle=$libelle;
                    $cpt=0;
                    $slug="";
                    $libelle2=str_replace('&',' ',$libelle);
                    $libelle2=str_replace('/',' ',$libelle2);
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
                    if($technologie->slug)
                    {
                        $technologie->slug->delete();
                    }
                    $technologie->slug()->save($slugObject);
                }
                if($description!=null)
                {
                    $technologie->description=$description;
                }
                $plate->technologies()->save($technologie);
                return redirect()->route("indextechologiesAdmin");

            }
            else
            {
                return view('admin.technologies.creer',["errorLibelle"=>$errorLibelle,"errorDescript"=>$errorDescript,"listes"=>$listes,"plateforme"=>$plateforme,"libelle"=>$libelle]);
            }

        }
    }
    public function supprimerTechnologie($id)
    {
        $technologie=Technologie::findOrFail($id);
        $technologie->isDeleted=1;
        $technologie->save();
        return redirect()->route("indextechologiesAdmin");
    }
    #-------------------------------- end technologie -------------------------#




    #--------------------------------- BUDGET ---------------------------#
    public function budget()
    {
        $listes=Budget::where('isDeleted',0)->get();
        return view('admin.budget.index',compact('listes'));
    }
    public function  creerBudget(Request $request,Input $input)
    {
        if($request->getMethod()=="GET")
        {
            return view('admin.budget.creer');
        }
        else
        {
            $libelle=$input->get('libelle');
            if($libelle!=null)
            {
                $budget=Budget::where(['libelle'=>$libelle,'isDeleted'=>0])->first();
                if($budget==null)
                {
                    $budget= new Budget();
                    $budget->libelle=$libelle;
                    $budget->save();
                    $next=$input->get('next');
                    if($next!=null)
                    {
                        return view('admin.budget.creer',["message"=>"Budget créé avec succès!"]);
                    }
                    else
                    {
                        return redirect()->route("indexBudgetAdmin");
                    }
                }
                else
                {
                    return view('admin.budget.creer',["errorLibelle"=>"Cet budget existe déjà","libelle"=>$libelle]);
                }

            }
            else
            {
                return view('admin.technologies.creer',["errorLibelle"=>"veuiller remplir ce champs"]);
            }
        }
    }

    public function  editerBudget($id,Request $request,Input $input)
    {
        $budget=Budget::findOrFail($id);
        if($request->getMethod()=="GET")
        {
            return view('admin.budget.editer',['budget'=>$budget]);
        }
        else
        {
            $libelle=$input->get('libelle');
            if($libelle!=null)
            {
                $budget->libelle=$libelle;
                $budget->save();
                return redirect()->route("indexBudgetAdmin");
            }
            else
            {
                return view('admin.budget.editer',["errorLibelle"=>"veuillez remplir ce champs",'budget'=>$libelle]);
            }

        }
    }
    public function supprimerBudget($id)
    {
        $budget=Budget::findOrFail($id);
        $budget->isDeleted=1;
        $budget->save();
        return redirect()->route("indexBudgetAdmin");
    }
    #-------------------------------- end BUDGET -------------------------#
    #-------------------------------- FORMULE -------------------------#
    public function formule()
    {
        $listes=Formule::where('isDeleted',0)->get();
        return view('admin.formule.index',compact('listes'));
    }
    public function creerFormule(Request $request,Input $input)
    {
        if($request->getMethod()=="GET")
        {
            $listes=DescriptionFormule::all();
            JavaScript::put([
                'listes' => $listes
            ]);
            return view('admin.formule.creer',compact('listes'));
        }
        else
        {
            $descriptions=$input->get('description');
            $libelle=$input->get('libelle');
            $color=$input->get('color');
            $prix=$input->get('prix');
            $type=$input->get('type');
            $next=$input->get('next');
            $formule=new Formule();
            $formule->libelle=$libelle;
            $formule->prix=$prix;
            $formule->type=$type;
            $formule->couleur=$color;
            $formule->isDeleted=0;
            $formule->isActivated=0;
            $formule->save();
            foreach ($descriptions as $descript)
            {
                $currentDescript=DescriptionFormule::findOrFail($descript);
                $formule->descriptions()->attach($descript);
            }

            if($next!=null)
            {
                return view('admin.formule.creer',["message"=>"Budget créé avec succès!"]);
            }
            else
            {
                return redirect()->route("indexFormuleAdmin");
            }

        }


    }
    public function editerFormule($id,Request $request,Input $input)
    {
        $formule=Formule::findOrFail($id);
        $libelle=$formule->libelle;
        $prix=$formule->prix;
        $color=$formule->couleur;
        $listes=Formule::where('isDeleted',0)->get();
        if($request->getMethod()=="GET")
        {
            $listes=DescriptionFormule::all();
            return view('admin.formule.editer',['listes'=>$listes,'libelle'=>$libelle,'prix'=>$prix,'color'=>$color,'formule'=>$formule]);
        }
        else
        {
            $descriptions=$input->get('description');
            $libelle=$input->get('libelle');
            $color=$input->get('color');
            $prix=$input->get('prix');
            $next=$input->get('next');

            $formule->libelle=$libelle;
            $formule->prix=$prix;
            $formule->couleur=$color;
            $formule->isDeleted=0;
            $formule->isActivated=0;
            $formule->save();
            $formule->descriptions()->detach();
            foreach ($descriptions as $descript)
            {
                $currentDescript=DescriptionFormule::findOrFail($descript);
                $formule->descriptions()->attach($descript);
            }
            return redirect()->route("indexFormuleAdmin");
        }


    }
    public function supprimerFormule($id)
    {
        $formule=Formule::findOrFail($id);
        $formule->isDeleted=1;
        $formule->save();
        return redirect()->route("indexF");
    }
#------------------------------------------------------------------ end FORMULE -------------------------------------------#
#----------------------------------------------------------------- LANGUES ---------------------------------------------------#
    public function indexLangue()
    {
        $listes=Langue::where('isDeleted',0)->get();
        return view('admin.langue.index',compact('listes'));
    }
    public function creerLangue(Request $request,Input $input)
    {
        if($request->getMethod()=="GET")
        {
            return view('admin.langue.creer');
        }
        else
        {


            $libelle=$input->get('libelle');
            $next=$input->get('next');

            $langue=Langue::where(["libelle"=>$libelle,"isDeleted"=>0])->first();
            if($langue)
            {
                return view('admin.langue.creer',["errorLibelle"=>"cette langue exite déjà","libelle"=>$libelle]);
            }

            $langue=new Langue();
            $langue->libelle=$libelle;
            $langue->isDeleted=0;
            $langue->save();
            if($next!=null)
            {
                return view('admin.langue.creer',["message"=>"langue créée avec succès!"]);
            }
            else
            {
                return redirect()->route("indexLangue");
            }

        }


    }
    public function editerLangue($id,Request $request,Input $input)
    {
        $langue=Langue::findOrFail($id);
        $libelle=$langue->libelle;

        if($request->getMethod()=="GET")
        {
            $listes=DescriptionFormule::all();
            return view('admin.langue.editer',['libelle'=>$libelle]);
        }
        else
        {

            $libelle=$input->get('libelle');


            $langue->libelle=$libelle;

            $langue->save();
            return redirect()->route("indexLangue");
        }


    }
    public function supprimerLangue($id)
    {
        $langue=Langue::findOrFail($id);
        $langue->isDeleted=1;
        $langue->save();
        return redirect()->route("indexLangue");
    }
    #-------------------------------- END LANGUE -------------------------#
    ##----------------------------------------------------------------- DEMARRAGE ---------------------------------------------------#
    public function indexDemarrage()
    {
        $listes=DemarrageProjet::where('isDeleted',0)->get();
        return view('admin.demarrage_projet.index',compact('listes'));
    }
    public function creerDemarrageProjet(Request $request,Input $input)
    {
        if($request->getMethod()=="GET")
        {
            return view('admin.demarrage_projet.creer');
        }
        else
        {
            $libelle=$input->get('libelle');
            $next=$input->get('next');

            $demarrage=DemarrageProjet::where(["libelle"=>$libelle,"isDeleted"=>0])->first();
            if($demarrage)
            {
                return view('admin.demarrage_projet.creer',["errorLibelle"=>"ce type exite déjà","libelle"=>$libelle]);
            }

            $demarrage=new DemarrageProjet();
            $demarrage->libelle=$libelle;
            $demarrage->isDeleted=0;
            $demarrage->save();
            if($next!=null)
            {
                return view('admin.demarrage_projet.creer',["message"=>"type créé avec succès!"]);
            }
            else
            {
                return redirect()->route("indexDemarrage");
            }

        }


    }
    public function editerdemarrageProjet($id,Request $request,Input $input)
    {
        $demarrage=DemarrageProjet::findOrFail($id);
        $libelle=$demarrage->libelle;

        if($request->getMethod()=="GET")
        {
            return view('admin.demarrage_projet.editer',['libelle'=>$libelle]);
        }
        else
        {

            $libelle=$input->get('libelle');


            $demarrage->libelle=$libelle;

            $demarrage->save();
            return redirect()->route("indexDemarrage");
        }


    }
    public function supprimerdemarrageProjet($id)
    {
        $demarrage=DemarrageProjet::findOrFail($id);
        $demarrage->isDeleted=1;
        $demarrage->save();
        return redirect()->route("indexDemarrage");
    }
    #-------------------------------- END DEMARRAGE -------------------------#
    #-------------------------------- DESCRIPTION_FORMULE -------------------------#
    public function descriptFormule()
    {
        $formules=Formule::all();
        $listes=DescriptionFormule::orderBy('position', 'ASC')->where('isDeleted',0)->get();
        return view('admin.descriptionFormule.index',["formules"=>$formules,"listes"=>$listes]);
    }
    public function creerDescriptFormule(Request $request,Input $input)
    {
        if($request->getMethod()=="GET")
        {
            $formule=Formule::all();
            return view('admin.descriptionFormule.creer',["formule"=>$formule]);
        }
        else
        {
            $formule=Formule::all();
            $libelle=$input->get('libelle');
            $type=$input->get('type');
            $isError=0;
            $tabError=array();
            if($libelle=="")
            {
                $isError++;
                $tabError[0]="Veuillez remplir ce champs";
            }
            if($isError==0)
            {
                $listes=DescriptionFormule::all();
                $descriptio=new DescriptionFormule();
                $descriptio->libelle=$libelle;
                $descriptio->type=$type;
                $descriptio->position=count($listes)+1;
                $descriptio->isDeleted=0;
                $descriptio->save();
                $next=$input->get('next');
                if($next!=null)
                {
                    return view('admin.descriptionFormule.creer',["message"=>"Plateforme créée avec succès!"]);
                }
                else
                {
                    return redirect()->route("descriptFormule");
                }
            }
            else
            {
                return view('admin.descriptionFormule.creer',["tabError"=>$tabError,"valeur"=>$valeur,"libelle"=>$libelle]);
            }
        }

    }
    public function supprimerDescriptionFormule($id)
    {
        $descritions=DescriptionFormule::findOrFail($id);
        $descritions->delete();
        return redirect()->route("descriptFormule");
    }
    public function editerDescriptionFormule($id,Request $request,Input $input)
    {
        $descrition=DescriptionFormule::findOrFail($id);
        $formule=Formule::all();
        if($request->getMethod()=="GET")
        {
            return view('admin.descriptionFormule.editer',['descritions'=>$descrition,'formule'=>$formule]);
        }
        else
        {
            $libelle=$input->get('libelle');
            $type=$input->get('type');
            $isError=0;
            $tabError=array("");
            if($libelle=="")
            {
                $isError++;
                $tabError[0]="Veuillez remplir ce champs";
            }
            if($isError!=0)
            {
                return view('admin.descriptionFormule.editer',['descritions'=>$descrition,"tabError"=>$tabError,"libelle"=>$libelle]);
            }
            $descrition->libelle=$libelle;
            $descrition->type=$type;
            $descrition->save();

            return redirect()->route("descriptFormule");
        }

    }
    public function updateDescriptFormuleValue(Input $input)
    {
        $type=$input->get('type');
        $idFormue=$input->get('idFormue');
        $idDescript=$input->get('idDescript');
        $value=$input->get('value');
        $descrition=DescriptionFormule::findOrFail($idDescript);
        $formule=Formule::findOrFail($idFormue);
        if($type==1)
        {
            $formDescriptValu=new FormuleDescriptionValue();
        }
        else
        {
            $formDescriptValu=FormuleDescriptionValue::where("description_formule_id",$idDescript)->where("formule_id",$idFormue)->first();
        }
        $formDescriptValu->value=$value;
        if($type==1)
        {
            $descrition->formuleDescripValue()->save($formDescriptValu);
            $formule->formuleDescripValue()->save($formDescriptValu);
            $descrition->hasValue=1;
            $descrition->save();
        }
        $formDescriptValu->save();
        return $formDescriptValu->id;
    }
    public function updateDescriptPosition(Input $input)
    {
        try
        {
            $descrition=DescriptionFormule::findOrFail($id);
            $listes=DescriptionFormule::orderBy('position', 'ASC')->where('isDeleted',0)->get();
            if($descrition)
            {
                $oldPosition=$descrition->position;
                $check=true;
                //down
                if($type==1)
                {
                    $i=0;
                    do
                    {
                        if($listes[$i]->id==$id)
                        {
                            $check=false;
                            if($i+1<count($listes))
                            {
                                $nextDescription=$listes[$i+1];
                                $new=$nextDescription->position;
                            }
                        }
                        $i=$i+1;
                    }while($i<count($listes) and $check==true);

                }
                //up
                if($type==2)
                {

                    $i=0;
                    do
                    {
                        if($listes[$i]->id==$id)
                        {
                            $check=false;
                            if($i!=0)
                            {
                                $nextDescription=$listes[$i-1];
                                $new=$nextDescription->position;
                            }
                        }
                        $i=$i+1;
                    }while($i<count($listes) and $check==true);
                }
                if ($nextDescription)
                {
                    $descrition->position=$nextDescription->position;
                    $nextDescription->position=$oldPosition;
                    $descrition->save();
                    $nextDescription->save();
                    return "{\"new\":$new,\"old\":$oldPosition}";
                }
                else
                {
                    return response('cant change position', 403);
                }

            }
        }
        catch (\Exception $e)
        {
            return response('not found item', 404);
        }


    }

    #-------------------------------- end DESCRIPTION_FORMULE -------------------------#
    #-------------------------------- PROJET -------------------------#
    public function indexProjet(Request $request,Input $input,$jour)
    {
        $listeOfTechnologies=Technologie::where('isDeleted',0)->get();
        $listeOfPlat=plateforme::where('isDeleted',0)->get();
        if($jour=="today")
        {
            $projets=Projet::where('state',0)->paginate(10);
            //$projets=Projet::whereDate('created_at', DB::raw('CURDATE()'))->paginate(10);
            //dd($projets);
        }

        return view('admin.projet.index',['projets'=>$projets,"listeOfTechnologies"=>$listeOfTechnologies,"listeOfPlat"=>$listeOfPlat]);
    }
    public function indexCommande(Request $request,Input $input,$jour)
    {
        if($jour=="today")
        {
            $commandes=Commande::where('statut',0)->paginate(10);
            //$projets=Projet::whereDate('created_at', DB::raw('CURDATE()'))->paginate(10);
            //dd($projets);
        }

        return view('admin.commandes.index',['commandes'=>$commandes]);
    }
    public function validerCommande($id)
    {
        $commandes=Commande::where('statut',0)->paginate(10);
        //$projets=Projet::whereDate('created_at', DB::raw('CURDATE()'))->paginate(10);
        //dd($projets);
        return view('admin.commandes.index',['commandes'=>$commandes]);
    }
    public function detailProjet(Request $request,Input $input,$id)
    {
        // dd($request);
        $projet=Projet::findOrFail($id);
        if($projet)
        {
            return view('admin.projet.detail',['projet'=>$projet]);
        }

    }
    public function ValiderProjet(Request $request,Input $input,$id)
    {
        // dd($request);
        $projet=Projet::findOrFail($id);

        if($projet)
        {
            $projet->state=1;
            $projet->save();
            //$this->validateProjectEmail($projet->user->email,$projet->user->name,"http://127.0.0.1:8000/mes-projets",$projet->titre);
        }
        return redirect()->route('indexProjet',["jour"=>"today"]);

    }
    public function supprimerProjet(Request $request,Input $input,$id)
    {
        // dd($request);
        $projet=Projet::findOrFail($id);

        if($projet)
        {
            $projet->state=2;
            $projet->save();
        }
        $this->modererProjectEmail($projet->user->email,$projet->user->name,"http://127.0.0.1:8000/mes-projets",$projet->titre);
        return redirect()->route('indexProjet',["jour"=>"today"]);

    }
    #-------------------------------- end PROJET -------------------------#
    public function validateProjectEmail($var,$name,$link,$titre){
        $data = array('name'=>$name,"link"=>$link,"titre"=>$titre);
        Mail::send('admin.mail.validation', $data, function($message)  use ($var){
            $message->to($var, 'Tutorials Point')->subject
            ('Teranga-freelance');
            $message->from('yavouckolye@gmail.com','Teranga-freelance');
        });
    }
    public function modererProjectEmail($var,$name,$link,$titre){
        $data = array('name'=>$name,"link"=>$link,"titre"=>$titre);
        Mail::send('admin.mail.moderation', $data, function($message)  use ($var){
            $message->to($var, 'Tutorials Point')->subject
            ('Teranga-freelance');
            $message->from('yavouckolye@gmail.com','Teranga-freelance');
        });
    }
}
