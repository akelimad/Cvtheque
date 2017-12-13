<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;

class SkillController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function addSkill(Request $request){
        $skill = new Skill();
        $skill->title = $request->title;
        $skill->percentage = $request->percentage;
        $skill->cv_id = $request->cv_id;
        $skill->save();
        return Response()->json(array(
            'status' => true,
            'id'     => $skill->id
        ));
    }

    public function updateSkill(Request $request){
    	$skill = Skill::find($request->id);
        $skill->title = $request->title;
        $skill->percentage = $request->percentage;
        $skill->cv_id = $request->cv_id;

        $skill->save();
        return Response()->json(array(
            'status' => true
        ));
    }

    public function deleteSkill($id){
    	$skill = Skill::find($id);
        $skill->delete();
        return Response()->json(array(
            'status' => true
        ));
    }
}
