<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Experience; //notre model cv
use App\Cv; //notre model cv 

class ExperienceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function addExperience(Request $request){
        $experience = new Experience();
        $experience->title = $request->title;
        $experience->description = $request->description;
        $experience->start = $request->start;
        $experience->end = $request->end;
        $experience->cv_id = $request->cv_id;
        $experience->save();
        return Response()->json(array(
            'status' => true,
            'id'     => $experience->id
        ));
    }

    public function updateExperience(Request $request){
    	$experience = Experience::find($request->id);
    	$experience->title = $request->title;
        $experience->description = $request->description;
        $experience->start = $request->start;
        $experience->end = $request->end;
        $experience->cv_id = $request->cv_id;

        $experience->save();
        return Response()->json(array(
            'status' => true
        ));
    }

    public function deleteExperience($id){
    	$experience = Experience::find($id);
        $experience->delete();
        return Response()->json(array(
            'status' => true
        ));
    }
}
