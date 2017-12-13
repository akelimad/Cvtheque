<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formation; 

class FormationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function addFormation(Request $request){
        $formation = new Formation();
        $formation->title = $request->title;
        $formation->description = $request->description;
        $formation->start = $request->start;
        $formation->end = $request->end;
        $formation->cv_id = $request->cv_id;
        $formation->save();
        return Response()->json(array(
            'status' => true,
            'id'     => $formation->id
        ));
    }

    public function updateFormation(Request $request){
    	$formation = Formation::find($request->id);
    	$formation->title = $request->title;
        $formation->description = $request->description;
        $formation->start = $request->start;
        $formation->end = $request->end;
        $formation->cv_id = $request->cv_id;

        $formation->save();
        return Response()->json(array(
            'status' => true
        ));
    }

    public function deleteFormation($id){
    	$formation = Formation::find($id);
        $formation->delete();
        return Response()->json(array(
            'status' => true
        ));
    }
}
