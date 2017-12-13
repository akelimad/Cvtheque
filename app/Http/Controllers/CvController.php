<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cv; 
use App\Experience; 
use App\Formation; 
use App\Project; 
use App\Skill; 
use Auth;// pour pouvoir envoyer l user_id a la table cvs
use App\Http\Requests\cvRequest; //injecter notre request validation 
use App\Http\UploadedFile; //

class CvController extends Controller
{
    //redirect user to login if not logged in
    public function __construct(){
        $this->middleware('auth');
    }
	//listing of Cv
    public function index(){
        //$listcv=Cv::where('user_id', Auth::user()->id )->get();
        $listcv=Auth::user()->cvs;
        //cv.index signifie la vue index.blade qui se trouve dans le dossier cv
    	return view('cv.index',['cvs'=>$listcv]);
    }
    //form de creation de cv
    public function create(){
        //cv.create signifie la vue create.blade qui se trouve dans le dossier cv
    	return view('cv.create');
    }

    //enregistrer un cv
    public function store(cvRequest $request){
    	$cv = new Cv();
        $cv->titre = $request->input("titre");
        $cv->description = $request->input("description");
        $cv->user_id = Auth::user()->id;
        $cv->image=$request->image->store('images'); // image c est le nom du dossier qui va stocker image
        $cv->save();
        session()->flash("success", "le C.V a bien été sauvegardé.");
        return redirect('cvs');
    }

    //get cv et edit
    public function edit($id){
    	$cv=Cv::find($id);
        //cv.edit signifie la vue edit.blade qui se trouve dans le dossier cv
        $this->authorize('update', $cv);
        return view('cv.edit', ['cv'=>$cv]);
    }

    //get details of cv
    public function show($id){
        return view('cv.show', ['id'=>$id]);
    }

    //update cv
    public function update(cvRequest $request, $id){
    	$cv=Cv::find($id);
        $cv->titre = $request->input("titre");
        $cv->description = $request->input("description");
        $cv->save();
        session()->flash("success", "le C.V a bien été actualisé.");
        return redirect('cvs');
    }

    //delete cv
    public function destroy(Request $request, $id){
    	$cv=Cv::find($id);
        $cv->delete();
        session()->flash("success", "le C.V a bien été supprimé.");
        return redirect('cvs');
    }

    public function getData($id){
        $cv= Cv::find($id);
        $formations= $cv->formations()->orderBy('start', 'desc')->get();
        $experiences= $cv->experiences()->orderBy('start', 'desc')->get();
        $projects   = $cv->projects()->orderBy('updated_at', 'desc')->get();
        $skills   = $cv->skills()->orderBy('updated_at', 'desc')->get();
        return Response()->json([
            'formations' => $formations,
            'experiences' => $experiences,
            'projects'    => $projects,
            'skills'    => $skills
        ]);
    }

}
